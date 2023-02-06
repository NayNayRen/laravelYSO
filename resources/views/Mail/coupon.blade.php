{{-- EMAIL FOR USERS COUPON --}}
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title>SOS Marketing</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="SOS Marketing Email Forms">
    <meta name="keywords" content="SOS Marketing">
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

        #bottom-disclaimer {
            font-size: 16px;
            margin: 0 0 10px 0;
            padding: 0 10px 5px 10px;
        }

        #discount,
        #name {
            font-size: 20px;
        }

        #header-logo {
            font-size: 28px;
        }

        #main-card {
            width: 400px;
        }

        #main-card a {
            font-size: 18px;
        }

        #top-disclaimer {
            font-size: 16px;
            margin: 5px 0 0 0;
            padding: 5px 10px 0 10px;
        }

        @media (max-width:400px) {
            #bottom-disclaimer {
                font-size: 20px !important;
                margin: 0 0 15px 0 !important;
                padding: 0 15px 10px 15px !important;
            }

            #center-container {
                width: 100%;
            }

            #discount,
            #name {
                font-size: 26px !important;
            }

            #header-logo {
                font-size: 32px !important;
            }

            #main-card {
                width: 90%;
            }

            #main-card a {
                font-size: 24px !important;
            }

            #social-media-container img {
                height: 45px !important;
                width: 45px !important;
            }

            #top-disclaimer {
                font-size: 20px !important;
                margin: 15px 0 0 0 !important;
                padding: 10px 15px 0 15px !important;
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
                    style="width:600px; height:100%; border-collapse:collapse; border-spacing:0; text-align:left; font-family: 'Roboto', sans-serif; padding:0;">
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
                            <h1 style="color:#000; font-size:30px; margin:0; padding:0; ">- Your Coupon -
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
                                min-height: 525px;
                                padding: 0;">
                                <tr>
                                    <td style="padding:0;">
                                        {{-- DEAL PICTURE --}}
                                        <img src="{{ $data['picture_url'] }}" alt="{{ $data['name'] }}" width="100%"
                                            height="auto"
                                            style="
                                            background-color:#fff;
                                            border-radius: 5px;
                                            color:#000;
                                            margin-bottom: 5px;
                                            display:block;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        {{-- DISCOUNT/LOCATION --}}
                                        <p id="discount"
                                            style="font-weight:bold; padding:5px; margin-bottom:10px; max-height:125px; overflow-y:scroll;">
                                            {{ $data['location'] }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        {{-- DEAL NAME --}}
                                        <p id="name"
                                            style="color:#808080; margin-bottom:15px; max-height:125px; overflow-y:scroll; padding:5px;">
                                            {{ $data['name'] }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        {{-- EXPIRATION --}}
                                        <p id="top-disclaimer"
                                            style="background-color:#DCDCDC;
                                            border-top-left-radius:5px; border-top-right-radius:5px; color:#000; font-style:italic;">
                                            Coupon Will Expire
                                            After 24 Hours On:
                                            <span style="color: #e6331f; display:block;">{{ $data['expiry'] }}</span>
                                        </p>
                                        {{-- PROMO --}}
                                        <p id="bottom-disclaimer"
                                            style="background-color:#DCDCDC;
                                            border-bottom-left-radius:5px; border-bottom-right-radius:5px;color:#000; font-style:italic;">
                                            Share This
                                            Offer
                                            With Friends & Receive: <span style="color: #e6331f; display:block;">$3.00
                                                off.</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        {{-- GET DEAL BUTTON --}}
                                        <a href="{{ route('deals.show', $data['id']) }}"
                                            style="background-color: #e6331f; display:block; border-radius:5px; color:#fff; margin:10px auto; padding:10px 0; text-align:center; width:100%; text-decoration:none;">Get
                                            Deal Now!
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        {{-- FOOTER --}}
                        <td align="center" style="padding:0;">
                            {{-- SOCIAL MEDIA BLOCK --}}
                            <div
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
                                        width="40" height="40" style="height:40px; margin:0 10px; width:40px;">
                                </a>
                                <a href="https://www.youtube.com/channel/UCWH7dsxheL2ZOTrpfNiVBAA"
                                    style="margin:0 10px; text-decoration:none;">
                                    <img src="{{ asset('img/social/youtube.png') }}" alt="YouTube Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="#" style="margin:0 10px; text-decoration:none;">
                                    <img src="{{ asset('img/social/linkedin.png') }}" alt="LinkedIn Link"
                                        width="40" height="40" style="height:40px; width:40px;">
                                </a>
                            </div>
                            {{-- DISCLAIMER --}}
                            <p
                                style="text-align:center; color:#fff; padding:20px; background-color:#000; margin: 0 0 10px 0; font-size:16px; border-bottom-left-radius:5px; border-bottom-right-radius:5px;">
                                &copy; Copyright January 2023, <a href="https://pennexx.net/">PENNEXX</a>. All rights
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
