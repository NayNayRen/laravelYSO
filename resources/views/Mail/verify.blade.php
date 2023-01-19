<!doctype html>

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

</html>
