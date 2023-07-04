{{-- EMAIL FOR VERIFYING FIRST TIME USER --}}
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title>SOS Marketing</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="SOS Marketing Email Forms">
    <meta name="keywords" content="SOS Marketing">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if mso]>
<noscript>
<xml>
<o:OfficeDocumentSettings>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml>
</noscript>
<![endif]-->
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        /* #center-container {
            border: solid 1px #000;
        } */

        #code {
            margin-bottom: 5px;
        }

        #code,
        #code-header {
            font-size: 20px;
            text-align: center;
        }

        #disclaimer {
            font-size: 16px;
            padding: 5px 10px;
        }

        #header-logo {
            font-size: 28px;
        }

        #main-card {
            width: 400px;
        }

        @media (max-width:400px) {
            #center-container {
                width: 100%;
            }

            #code {
                margin-bottom: 15px !important;
            }

            #code,
            #code-header {
                font-size: 26px !important
            }

            #disclaimer {
                font-size: 20px !important;
                padding: 10px 15px !important;
            }

            #header-logo {
                font-size: 32px !important;
            }

            #main-card {
                width: 90%;
            }

            #social-media-container img {
                height: 45px !important;
                width: 45px !important;
            }
        }
    </style>

</head>

<body style="margin:0; padding:0;">
    {{-- ENTIRE CONTAINER --}}
    <table role="presentation"
        style="width:100%; height:100%; border-collapse:collapse; border:0;border-spacing:0; background:#fff;">
        <tr>
            <td align="center" style="padding:0;">
                {{-- CENTER CONTAINER --}}
                <table role="presentation" id="center-container"
                    style="width:600px; height:100%; border-collapse:collapse; border-spacing:0; font-family: 'Roboto', sans-serif; padding:0;">
                    <tr>
                        <td align="center" style="padding:0;">
                            {{-- LOGO CONTAINER --}}
                            <a href={{ route('deals.index') }} id="header-logo"
                                style="margin: 20px auto 20px auto; background-color: #000; padding: 10px 15px; border-radius:5px; display:block; color:#fff; text-decoration:none;">
                                <span>
                                    Y<span style="color:#808080">our</span>S<span
                                        style="color:#808080">ocial</span>O<span style="color:#808080">ffers</span><span
                                        style="background-color:#e6331f; padding:2px;">.com</span>
                                </span>
                            </a>
                            <h1 style="color:#000; font-size:30px; margin:0; padding:0;">- User Verification -
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0;">
                            {{-- MAIN CARD --}}
                            <table role="presentation" id="main-card"
                                style="background-color: #fff;
                                border-collapse: collapse;
                                border-radius: 5px;
                                border-spacing: 0;
                                border: 0;
                                margin: 10px auto 20px auto;
                                max-height: auto;
                                min-height: 325px;
                                padding: 0;">
                                <tr>
                                    <td>
                                        <h2
                                            style="color:#e6331f; font-size:26px; margin:0; padding:0; text-align:center;">
                                            Welcome To YSO</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        {{-- VERIFICATION CODE --}}
                                        <p id="code-header" style="color:#000; margin-bottom:5px; padding:5px;">
                                            Your Email Verification Code Is :</p>
                                        <p id="code"
                                            style="background-color:#a9a9a9; border-radius:5px; color:#000; padding:10px 5px;">
                                            {{ $data['code'] }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{-- USAGE INSTRUCTIONS --}}
                                        <p id="disclaimer"
                                            style="background-color:#DCDCDC; border-radius:5px; color:#000; font-style:italic; margin-bottom:10px;">
                                            Use
                                            the code above to
                                            finish registration. Once registered, simply log in to start saving and
                                            sharing.</p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        {{-- FOOTER --}}
                        <td align="center" style="padding:0;">
                            {{-- SOCIAL MEDIA BLOCK --}}
                            <div id="social-media-container"
                                style="
                                background-color:#000; border-top-left-radius:5px; border-top-right-radius:5px;
                                padding:10px 10px 0 10px;">
                                <a href="mailto: Support@YourSocialOffers.com"
                                    style="margin:0 10px; text-decoration:none;">
                                    <img src="{{ asset('img/social/mail.png') }}" alt="Email Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="https://www.facebook.com/yoursocialoffers/?ref=py_c"
                                    style="margin:0 10px; text-decoration:none;">
                                    <img src="{{ asset('img/social/facebook.png') }}" alt="Facebook Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="https://twitter.com/ysoffers" style="margin:0 10px; text-decoration:none;">
                                    <img src="{{ asset('img/social/twitter.png') }}" alt="Twitter Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="https://www.instagram.com/yoursocialoffers/"
                                    style="margin:0 10px; text-decoration:none;">
                                    <img src="{{ asset('img/social/instagram.png') }}" alt="Instagram Link"
                                        width="40" height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="https://www.youtube.com/channel/UCWH7dsxheL2ZOTrpfNiVBAA"
                                    style="margin:0 10px; text-decoration:none;">
                                    <img src="{{ asset('img/social/youtube.png') }}" alt="YouTube Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="#" style="margin:0 10px; text-decoration:none;">
                                    <img src="{{ asset('img/social/linkedin.png') }}" alt="LinkedIn Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                            </div>
                            {{-- DISCLAIMER --}}
                            <p
                                style="text-align:center; color:#fff; padding:20px; background-color:#000; margin: 0 0 10px 0; font-size:16px; border-bottom-left-radius:5px; border-bottom-right-radius:5px;">
                                &copy; Copyright January 2021, <a href="https://pennexx.net/">PENNEXX</a>. All rights
                                reserved. YourSocialOffers (YSO) is a subsidiary of <a
                                    href="https://pennexx.net">pennexx.net</a> listed on
                                OTC Markets as
                                <a href="https://www.otcmarkets.com/stock/PNNX/overview">PNNX</a>
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
