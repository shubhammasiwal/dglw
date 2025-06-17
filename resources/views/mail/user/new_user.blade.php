<table width="100%" cellpadding="0" cellspacing="0" style="background: #f4f6f8; padding: 40px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(52,144,220,0.08); overflow: hidden;">
                <tr>
                    <td align="center" style="padding: 32px 0 16px;">
                        <!-- Logo (replace src with your logo) -->
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="120" height="40" style="display:block; margin-bottom: 12px;">
                        <h1 style="font-family: 'Segoe UI', Arial, sans-serif; color: #3490dc; margin: 0;">Welcome to {{ config('app.name') }}!</h1>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 24px 40px 8px; font-family: 'Segoe UI', Arial, sans-serif; color: #333;">
                        <p style="font-size: 18px; margin-bottom: 8px;">Hello <strong>{{ $user->name }}</strong>,</p>
                        <p style="font-size: 16px; margin-bottom: 24px;">We're excited to have you on board. Here are your account details:</p>
                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 24px;">
                            <tr>
                                <td style="font-size: 15px; color: #555; padding: 6px 0;"><strong>Email:</strong></td>
                                <td style="font-size: 15px; color: #555; padding: 6px 0;">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: 15px; color: #555; padding: 6px 0;"><strong>Password:</strong></td>
                                <td style="font-size: 15px; color: #555; padding: 6px 0;">{{ $password }}</td>
                            </tr>
                        </table>
                        <p style="font-size: 15px; color: #777; margin-bottom: 24px;">
                            <em>For your security, please change your password after your first login.</em>
                        </p>
                        <div style="text-align: center; margin-bottom: 32px;">
                            <a href="{{ route('login') }}"
                               style="background: #3490dc; color: #fff; text-decoration: none; padding: 14px 32px; border-radius: 5px; font-size: 16px; font-weight: 600; display: inline-block;">
                                Login to Your Account
                            </a>
                        </div>
                        <hr style="border: none; border-top: 1px solid #e4e9ee; margin: 24px 0;">
                        <p style="font-size: 14px; color: #888;">
                            If you have any questions or need help, just reply to this email or contact our support team.
                        </p>
                        <p style="font-size: 14px; color: #888; margin-bottom: 0;">
                            Thank you,<br>
                            <strong>{{ config('app.name') }} Team</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background: #f4f6f8; color: #bbb; font-size: 12px; padding: 16px;">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
