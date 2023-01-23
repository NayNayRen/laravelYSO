{{-- <!doctype html>

<head>
    <title>SOS Marketing</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SOS Marketing Email Forms">
    <meta name="keywords" content="SOS Marketing">
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0"
    style="font: 14px/20px Helvetica, Arial, sans-serif;margin: 0;padding: 75px 0 0 0;text-align: center;-webkit-text-size-adjust: none;background-color: #ffffff;">
    <center>
        <table border="0" cellpadding="20" cellspacing="0" height="100%" width="100%" id="bodyTable"
            style="background-color: #ffffff;">
            <tr>
                <td align="center" valign="top">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="max-width: 600px;border-radius: 6px;background-color: none;" id="templateContainer"
                        class="rounded6">
                        <tr>
                            <td align="center" valign="top">
                                <!-- // BEGIN HEADER -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                    style="max-width:600px">
                                    <tr>
                                        <td style="text-align: center;">
                                            <img src="{{ asset('img/yso-logo2.svg') }}" alt="logo"
                                                style="margin: auto; margin-bottom: 20px; width:320px; background-color: #000; padding: 10px 15px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">
                                            <h1
                                                style="font-size: 28px;line-height: 110%;margin-bottom: 20px;margin-top: 0;padding: 0;">
                                                <div style="text-align: center;"> Verification Code</div>
                                            </h1>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="card card--favourite"
                                                style="
                                                        -ms-flex-direction: column;
                                                        -ms-flex-pack: justify;
                                                        -webkit-box-direction: normal;
                                                        -webkit-box-orient: vertical;
                                                        -webkit-box-pack: justify;
                                                        background-color: #fff;
                                                        border-radius: 5px;
                                                        display: -ms-flexbox;
                                                        display: -webkit-box;
                                                        display: flex;
                                                        flex-direction: column;
                                                        font-family: 'Roboto', sans-serif;
                                                        height: 400px;
                                                        justify-content: space-between;
                                                        margin: 5px 10px;
                                                        padding: 5px;
                                                        width: 325px;
                                                        margin: auto;
                                                    ">
                                                <div>
                                                    <span class="card-discount" style="font-size: 16px;">Your Email
                                                        Verification Code is : {{ $data['code'] }}</span><br>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- END HEADER \\ -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html> --}}
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

        #header-logo {
            font-size: 28px;
        }

        #main-card {
            -ms-flex-direction: column;
            -ms-flex-pack: justify;
            -webkit-box-direction: normal;
            -webkit-box-orient: vertical;
            -webkit-box-pack: justify;
            background-color: #fff;
            border-collapse: collapse;
            border-radius: 5px;
            border-spacing: 0;
            border: 0;
            display: table;
            flex-direction: column;
            justify-content: space-between;
            margin: 10px auto 20px auto;
            max-height: auto;
            min-height: 300px;
            padding: 0;
            width: 400px;
        }

        #main-card p {
            font-size: 20px;
            text-align: center;
        }

        @media (max-width:400px) {
            #center-container {
                width: 100%;
            }

            #header-logo {
                font-size: 30px;
            }

            #main-card {
                width: 90%;
            }

            #main-card p {
                font-size: 26px !important;
            }
        }
    </style>

</head>

<body style="margin:0; padding:0;">
    {{-- ENTIRE CONTAINER --}}
    <table role="presentation"
        style="width:100%; height:100%; border-collapse:collapse; border:0;border-spacing:0; background:#fff;">
        <tr>
            {{-- CENTER CONTAINER --}}
            <td align="center" style="padding:0;">
                <table role="presentation" id="center-container"
                    style="width:600px; height:100%; border-collapse:collapse; border-spacing:0; font-family: 'Roboto', sans-serif; padding:0;">
                    <tr>
                        {{-- LOGO CONTAINER --}}
                        <td align="center" style="padding:0;">
                            <a href={{ route('deals.index') }} id="header-logo"
                                style="margin: 20px auto 20px auto; background-color: #000; padding: 10px 15px; border-radius:5px; display:block; color:#fff; text-decoration:none;">
                                <span>
                                    Y<span style="color:#808080">our</span>S<span
                                        style="color:#808080">ocial</span>O<span style="color:#808080">ffers</span><span
                                        style="background-color:#e6331f; padding:2px;">.com</span>
                                </span>
                            </a>
                            <h1 style="color:#000; font-size:30px; margin:0; padding:0;">- Verification Code -
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0;">
                            {{-- MAIN CARD --}}
                            <table role="presentation" id="main-card">
                                <tr>
                                    <td>
                                        <h2
                                            style="color:#e6331f; font-size:26px; margin:0; padding:0; text-align:center;">
                                            Welcome To YSO</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        <p style="color:#808080; margin-bottom:5px; padding:5px;">
                                            Your Email Verification Code Is :</p>
                                        <p
                                            style="background-color:#000; border-radius:5px; color:#fff; margin-bottom:5px; padding:5px;">
                                            {{ $data['code'] }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#808080; padding:5px; margin-bottom:5px;">Use
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
                        <td style="padding:0;">
                            {{-- SOCIAL MEDIA BLOCK --}}
                            <div
                                style="
                                -ms-flex-align:center;
                                -ms-flex-direction:row;
                                -ms-flex-pack:distribute;
                                -webkit-box-align:center;
                                -webkit-box-direction:normal;
                                -webkit-box-orient:horizontal;
                                align-items:center;
                                background-color:#000;
                                border-top-left-radius:5px; border-top-right-radius:5px;
                                display:-ms-flexbox;
                                display:-webkit-box;
                                display:flex;
                                flex-direction:row;
                                justify-content:space-around;
                                padding:10px 10px 0 10px;">
                                <a href="mailto: Support@YourSocialOffers.com">
                                    <img src="{{ asset('img/social/mail.png') }}" alt="Email Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="https://www.facebook.com/yoursocialoffers/?ref=py_c">
                                    <img src="{{ asset('img/social/facebook.png') }}" alt="Facebook Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="https://twitter.com/ysoffers">
                                    <img src="{{ asset('img/social/twitter.png') }}" alt="Twitter Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="https://www.instagram.com/yoursocialoffers/">
                                    <img src="{{ asset('img/social/instagram.png') }}" alt="Instagram Link"
                                        width="40" height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="https://www.youtube.com/channel/UCWH7dsxheL2ZOTrpfNiVBAA">
                                    <img src="{{ asset('img/social/youtube.png') }}" alt="YouTube Link" width="40"
                                        height="40" style="height:40px; width:40px;">
                                </a>
                                <a href="#">
                                    <img src="{{ asset('img/social/linkedin.png') }}" alt="LinkedIn Link" width="40"
                                        height="40" style="height:40px; width:40px;">
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
