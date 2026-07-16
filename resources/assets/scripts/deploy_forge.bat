@echo off
setlocal EnableExtensions EnableDelayedExpansion

set "SITE_DOMAIN=samfut.com"
set "SERVER_IP=50.116.57.251"
set "SITE_PATH=/home/forge/samfut.com"
set "SSH_KEY=%SAMFUT_SSH_KEY%"
set "FROM_HOOK=%~1"
set "DRY_RUN=0"

if /I "%~1"=="--dry-run" set "DRY_RUN=1"

echo =====================================
echo   Deploy samfut.com to Laravel Forge
echo =====================================
echo.

if /I "%FROM_HOOK%"=="--from-hook" (
    echo Called from post-commit hook.
    echo.
)

for /f "delims=" %%i in ('git symbolic-ref --short HEAD 2^>nul') do set "CURRENT_BRANCH=%%i"

if not defined CURRENT_BRANCH (
    echo [ERROR] Could not determine the current Git branch.
    goto :failed
)

echo Current branch: !CURRENT_BRANCH!

if /I not "!CURRENT_BRANCH!"=="main" (
    echo [ERROR] Production deployments are only allowed from main.
    goto :failed
)

git diff --quiet
if errorlevel 1 (
    echo [ERROR] The working tree has unstaged changes. Commit or stash them first.
    goto :failed
)

git diff --cached --quiet
if errorlevel 1 (
    echo [ERROR] The working tree has staged but uncommitted changes.
    goto :failed
)

echo Checking origin/main...
git fetch origin main --quiet
if errorlevel 1 (
    echo [ERROR] Could not fetch origin/main.
    goto :failed
)

for /f "delims=" %%i in ('git rev-parse HEAD') do set "LOCAL_SHA=%%i"
for /f "delims=" %%i in ('git rev-parse origin/main') do set "REMOTE_SHA=%%i"

if /I not "!LOCAL_SHA!"=="!REMOTE_SHA!" (
    echo [ERROR] Local main and origin/main do not match.
    echo Push or pull the repository before deploying production.
    goto :failed
)

if /I not "%FROM_HOOK%"=="--from-hook" (
    if "!DRY_RUN!"=="1" goto :dry_run
    echo.
    set /p "CONFIRM=Deploy origin/main to production at %SITE_DOMAIN%? (y/N): "
    if /I not "!CONFIRM!"=="y" (
        echo Deployment cancelled.
        goto :end
    )
)

:dry_run
if "%DRY_RUN%"=="1" (
    echo.
    echo [OK] Dry run passed. Branch, working tree, and origin/main are ready.
    set "EXIT_CODE=0"
    goto :finish
)

echo.
echo Starting deployment to %SITE_DOMAIN%...
echo.

where forge >nul 2>&1
if not errorlevel 1 (
    echo Using Forge CLI...
    forge deploy %SITE_DOMAIN%
    if not errorlevel 1 goto :success
    echo [WARN] Forge CLI deployment failed. Trying SSH fallback.
    echo.
)

if defined SSH_KEY (
    if not exist "!SSH_KEY!" (
        echo [WARN] SAMFUT_SSH_KEY does not exist: !SSH_KEY!
        goto :manual
    )
)

echo Attempting SSH deployment...
if defined SSH_KEY (echo Key: !SSH_KEY!) else (echo Key: SSH agent/default identity)
echo Server: forge@%SERVER_IP%
echo.

if defined SSH_KEY (
    ssh -i "!SSH_KEY!" forge@%SERVER_IP% "cd %SITE_PATH% && bash resources/assets/scripts/deploy_forge.sh"
) else (
    ssh forge@%SERVER_IP% "cd %SITE_PATH% && bash resources/assets/scripts/deploy_forge.sh"
)
set "SSH_EXIT=!ERRORLEVEL!"

if "!SSH_EXIT!"=="0" goto :success

echo.
echo [ERROR] SSH deployment failed with exit code !SSH_EXIT!.
goto :manual

:manual
echo.
echo ========================================
echo   Manual deployment required
echo ========================================
echo.
echo Use the Laravel Forge dashboard:
echo   1. Open https://forge.laravel.com
echo   2. Select %SITE_DOMAIN%
echo   3. Click Deploy Now
echo.
echo If this is a standard, non-zero-downtime site, you may inspect it over SSH:
echo   ssh forge@%SERVER_IP%
echo   cd %SITE_PATH%
echo   bash resources/assets/scripts/deploy_forge.sh
echo.
echo For a zero-downtime Forge site, deploy through Forge CLI or the dashboard.
goto :failed

:success
echo.
echo ========================================
echo   Deployment triggered successfully
echo ========================================
echo.
echo Site: https://%SITE_DOMAIN%
echo Health: https://%SITE_DOMAIN%/up
echo.
echo Verify the storefront, checkout, queue worker, PayPal webhook, and a purchased download.
echo Server logs: tail -f %SITE_PATH%/storage/logs/laravel.log
set "EXIT_CODE=0"
goto :finish

:failed
set "EXIT_CODE=1"
goto :finish

:end
set "EXIT_CODE=0"

:finish
echo.
if /I not "%FROM_HOOK%"=="--from-hook" if "%DRY_RUN%"=="0" pause
exit /b %EXIT_CODE%
