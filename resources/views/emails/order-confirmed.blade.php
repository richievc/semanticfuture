<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order confirmed</title>
</head>
<body style="margin:0; padding:0; background-color:#0b1120; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#0b1120; padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width:520px; background-color:#111c34; border:1px solid rgba(255,255,255,0.08); border-radius:16px; overflow:hidden;">
                    <tr>
                        <td style="padding:28px 32px; border-bottom:1px solid rgba(255,255,255,0.06);">
                            <span style="font-size:15px; font-weight:700; color:#ffffff; letter-spacing:0.02em;">
                                Semantic<span style="color:#F0A93A;">Future</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 4px; font-size:12px; font-weight:600; letter-spacing:0.08em; text-transform:uppercase; color:#F0A93A;">Order confirmed</p>
                            <h1 style="margin:0 0 16px; font-size:22px; line-height:1.3; color:#ffffff;">Thanks for your order — your download is ready.</h1>

                            <p style="margin:0 0 20px; font-size:14px; line-height:1.6; color:#b9c2d9;">
                                Your purchase of <strong style="color:#ffffff;">{{ $order->items->first()?->product_title_snapshot }}</strong> is confirmed. You can download your PDF immediately using the button below.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#0d1526; border:1px solid rgba(255,255,255,0.08); border-radius:10px; margin-bottom:24px;">
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="font-size:13px; color:#8a93ab; padding:4px 0;">Order reference</td>
                                                <td style="font-size:13px; color:#ffffff; text-align:right; font-family: 'Courier New', monospace;">{{ $order->order_number }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:13px; color:#8a93ab; padding:4px 0;">Book</td>
                                                <td style="font-size:13px; color:#ffffff; text-align:right;">{{ $order->items->first()?->product_title_snapshot }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:13px; color:#8a93ab; padding:4px 0;">Amount paid</td>
                                                <td style="font-size:13px; color:#ffffff; text-align:right;">{{ $order->currency }} {{ number_format((float) $order->total, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:13px; color:#8a93ab; padding:4px 0;">Date</td>
                                                <td style="font-size:13px; color:#ffffff; text-align:right;">{{ optional($order->paid_at)->format('M j, Y') }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 0 24px;">
                                <tr>
                                    <td style="border-radius:10px; background-color:#F0A93A;">
                                        <a href="{{ $downloadUrl }}" style="display:inline-block; padding:13px 26px; font-size:14px; font-weight:700; color:#101E42; text-decoration:none;">
                                            Download the E-book (PDF)
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 6px; font-size:13px; font-weight:600; color:#ffffff;">Download instructions</p>
                            <ul style="margin:0 0 24px; padding-left:18px; font-size:13px; line-height:1.7; color:#b9c2d9;">
                                <li>This link works for the next 7 days and is tied to your order — please don't share it.</li>
                                <li>You can also download from <strong style="color:#ffffff;">My Downloads</strong> in your account at any time.</li>
                                <li>You're allowed up to {{ $access->download_limit }} downloads on this purchase.</li>
                            </ul>

                            <p style="margin:0; font-size:12px; line-height:1.6; color:#6b7488;">
                                Trouble with your download? Reply to this email or contact us from the website and we'll sort it out.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 32px; border-top:1px solid rgba(255,255,255,0.06);">
                            <p style="margin:0; font-size:11px; color:#5b6479;">© {{ now()->year }} SemanticFuture. This is a transactional email related to your purchase.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
