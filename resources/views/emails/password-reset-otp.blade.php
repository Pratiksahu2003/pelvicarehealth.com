<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP - Pelvicare</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9fafb;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: auto;
            height: 60px;
            margin: 0 auto 20px;
            display: block;
        }
        .logo img {
            height: 60px;
            width: auto;
            max-width: 200px;
        }
        .logo-fallback {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ec4899, #db2777);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .logo-fallback svg {
            width: 30px;
            height: 30px;
            color: white;
        }
        h1 {
            color: #111827;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .otp-box {
            background: linear-gradient(135deg, #fce7f3, #fdf2f8);
            border: 2px dashed #ec4899;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #ec4899;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            margin: 10px 0;
        }
        .info-box {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            color: #92400e;
            font-size: 14px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('images/pelvicarehealth_logo.png') }}" alt="Pelvicare Health" style="height: 60px; width: auto; max-width: 200px;">
            </div>
            <div class="logo-fallback">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1>Password Reset Request</h1>
            <p class="subtitle">Hello {{ $userName }},</p>
        </div>

        <p>We received a request to reset your password for your Pelvicare account. Use the OTP below to verify your identity:</p>

        <div class="otp-box">
            <p style="margin: 0 0 10px 0; color: #6b7280; font-size: 14px;">Your OTP Code</p>
            <div class="otp-code">{{ $otp }}</div>
            <p style="margin: 10px 0 0 0; color: #6b7280; font-size: 12px;">This code will expire in 10 minutes</p>
        </div>

        <div class="info-box">
            <p><strong>⚠️ Security Notice:</strong> If you didn't request this password reset, please ignore this email. Your account remains secure.</p>
        </div>

        <p style="margin-top: 30px; color: #6b7280; font-size: 14px;">
            For security reasons, this OTP is valid for only 10 minutes. After that, you'll need to request a new one.
        </p>

        <div class="footer">
            <p>This is an automated email from Pelvicare Health Care.</p>
            <p style="margin-top: 10px;">© {{ date('Y') }} Pelvicare. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
