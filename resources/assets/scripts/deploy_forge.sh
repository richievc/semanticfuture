#!/usr/bin/env bash

set -Eeuo pipefail

SITE_DOMAIN="${SITE_DOMAIN:-samfut.com}"
SITE_PATH="${SITE_PATH:-/home/forge/samfut.com}"
DEPLOY_BRANCH="${DEPLOY_BRANCH:-main}"

if [[ -L "$SITE_PATH" ]]; then
    echo "[ERROR] $SITE_PATH is a symbolic link, indicating a Forge zero-downtime site."
    echo "Deploy with the Forge dashboard or Forge CLI so release activation and shared paths are handled safely."
    exit 2
fi

cd "$SITE_PATH"

if [[ ! -d .git ]]; then
    echo "[ERROR] $SITE_PATH is not a standard Git deployment directory."
    exit 2
fi

if [[ -n "$(git status --porcelain --untracked-files=no)" ]]; then
    echo "[ERROR] The server working tree has tracked changes. Refusing to overwrite them."
    exit 2
fi

PHP_BIN="${PHP_BIN:-php8.3}"
if ! command -v "$PHP_BIN" >/dev/null 2>&1; then
    PHP_BIN=php
fi

COMPOSER_BIN="${COMPOSER_BIN:-composer}"

exec 9>storage/framework/deploy.lock
if ! flock -n 9; then
    echo "[ERROR] Another deployment is already running."
    exit 2
fi

MAINTENANCE_ENABLED=0

restore_application() {
    if [[ "$MAINTENANCE_ENABLED" == "1" ]]; then
        "$PHP_BIN" artisan up || true
    fi
}

trap restore_application EXIT

echo "Deploying $SITE_DOMAIN from origin/$DEPLOY_BRANCH..."

"$PHP_BIN" artisan down --retry=60
MAINTENANCE_ENABLED=1

git fetch origin "$DEPLOY_BRANCH"
git merge --ff-only "origin/$DEPLOY_BRANCH"

"$COMPOSER_BIN" install --no-dev --no-interaction --prefer-dist --optimize-autoloader

npm ci
npm run build

"$PHP_BIN" artisan storage:link
"$PHP_BIN" artisan migrate --force
"$PHP_BIN" artisan optimize
"$PHP_BIN" artisan queue:restart
"$PHP_BIN" artisan up
MAINTENANCE_ENABLED=0

curl --fail --silent --show-error "https://$SITE_DOMAIN/up" >/dev/null

echo "[OK] Deployment completed and the health check passed."
