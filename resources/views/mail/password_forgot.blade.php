@extends('mail.layout')

@section('content')
    <table cellpadding="0" cellspacing="0" class="es-content" align="center"
           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
        <tr>
            <td align="center" style="padding:0;Margin:0">
                <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                    <tr>
                        <td align="left"
                            style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                            <table cellpadding="0" cellspacing="0" width="100%"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                <tr>
                                    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                        <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr>
                                                <td align="left" style="padding:0;Margin:0"><h2
                                                        style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#333333">
                                                        <span style="color:#FF0000">H</span>ello</h2>
                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                        <br></p>
                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333;font-size:16px">
                                                        You are receiving this email because we received a password
                                                        reset request for your account.</p></td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding:0;Margin:0;padding-top:20px">
                                                    <!--[if mso]><a href="{{ $url }}" target="_blank" hidden>
                                                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                                                     xmlns:w="urn:schemas-microsoft-com:office:word"
                                                                     esdevVmlButton href="https://link.html"
                                                                     style="height:36px; v-text-anchor:middle; width:163px"
                                                                     arcsize="14%" stroke="f" fillcolor="#f6cd46">
                                                            <w:anchorlock></w:anchorlock>
                                                            <center
                                                                style='color:#000000; font-family:"open sans", "helvetica neue", helvetica, arial, sans-serif; font-size:12px; font-weight:400; line-height:12px;  mso-text-raise:1px'>
                                                                Reset Password
                                                            </center>
                                                        </v:roundrect>
                                                    </a>
                                                    <![endif]--><!--[if !mso]><!-- --><span
                                                        class="msohide es-button-border"
                                                        style="border-style:solid;border-color:#2cb543;background:#f6cd46;border-width:0px;display:inline-block;border-radius:5px;width:auto;mso-hide:all"><a
                                                            href="{{ $url }}" class="es-button es-button-1"
                                                            target="_blank"
                                                            style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#000000;font-size:14px;border-style:solid;border-color:#f6cd46;border-width:10px 30px;display:inline-block;background:#f6cd46;border-radius:5px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-weight:normal;font-style:normal;line-height:17px;width:auto;text-align:center">Reset Password</a></span>
                                                    <!--<![endif]--></td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="padding:0;Margin:0;padding-top:20px"><p
                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333;font-size:16px">
                                                        This password reset link will expire in <span
                                                            style="color:#FF0000">60 minutes</span>.</p>
                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#333333;font-size:16px">
                                                        If you did not request a password reset, no further action is
                                                        required.</p></td>
                                            </tr>
                                            <tr>
                                                <td align="center"
                                                    style="padding:0;Margin:0;padding-top:30px;padding-bottom:30px;font-size:0">
                                                    <table border="0" width="100%" height="100%" cellpadding="0"
                                                           cellspacing="0" role="presentation"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                        <tr>
                                                            <td style="padding:0;Margin:0;border-bottom:1px solid #cccccc;background:unset;height:1px;width:100%;margin:0px"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="padding:0;Margin:0;padding-bottom:25px"><p
                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                        If you're having trouble clicking the "Reset Password" button,
                                                        copy and paste the URL below into your web browser:&nbsp;<a
                                                            href="{{ $url }}"
                                                            target="_blank"
                                                            style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#ea2226;font-size:14px">{{ $url }}</a>
                                                    </p></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
