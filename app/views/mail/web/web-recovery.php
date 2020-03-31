<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\Html;

/**
 * @var \Da\User\Model\User  $user
 * @var \Da\User\Model\Token $token
 */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl([
    'site/reset-password',
    'token' => $user->security_token
]);

if (preg_match('/dashboard/', $resetLink)) {
      $resetLink = preg_replace('/dashboard/', 'dashboard', $resetLink);
}

?>
    <!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>WELCOME</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
        <meta name="format-detection" content="telephone=no" />
        <!--[if !mso]><!-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!--<![endif]-->
        <style type="text/css">
            body {
                -webkit-text-size-adjust: 100% !important;
                -ms-text-size-adjust: 100% !important;
                -webkit-font-smoothing: antialiased !important;
            }

            img {
                border: 0 !important;
                outline: none !important;
            }

            p {
                Margin: 0px !important;
                Padding: 0px !important;
            }

            table {
                border-collapse: collapse;
                mso-table-lspace: 0px;
                mso-table-rspace: 0px;
            }

            td,
            a,
            span {
                border-collapse: collapse;
                mso-line-height-rule: exactly;
            }

            .ExternalClass * {
                line-height: 100%;
            }

            span.MsoHyperlink {
                mso-style-priority: 99;
                color: inherit;
            }

            span.MsoHyperlinkFollowed {
                mso-style-priority: 99;
                color: inherit;
            }
            a.btn:visited {
                color: white;
            }
            a.link{
                color:white;
            }
        </style>
        <style media="only screen and (min-width:481px) and (max-width:599px)" type="text/css">
            @media only screen and (min-width:481px) and (max-width:599px) {
                table[class=em_main_table] {
                    width: 100% !important;
                }
                table[class=em_wrapper] {
                    width: 100% !important;
                }
                td[class=em_hide],
                br[class=em_hide] {
                    display: none !important;
                }
                img[class=em_full_img] {
                    width: 100% !important;
                    height: auto !important;
                }
                td[class=em_align_cent] {
                    text-align: center !important;
                }
                td[class=em_aside] {
                    padding-left: 10px !important;
                    padding-right: 10px !important;
                }
                td[class=em_height] {
                    height: 20px !important;
                }
                td[class=em_font] {
                    font-size: 14px !important;
                }
                td[class=em_align_cent1] {
                    text-align: center !important;
                    padding-bottom: 10px !important;
                }

                a.btn:visited {
                    color: white;
                }
                a.btn:link{
                    color:white;
                }
            }
        </style>
        <style media="only screen and (max-width:480px)" type="text/css">
            @media only screen and (max-width:480px) {
                table[class=em_main_table] {
                    width: 100% !important;
                }
                table[class=em_wrapper] {
                    width: 100% !important;
                }
                td[class=em_hide],
                br[class=em_hide],
                span[class=em_hide] {
                    display: none !important;
                }
                img[class=em_full_img] {
                    width: 100% !important;
                    height: auto !important;
                }
                td[class=em_align_cent] {
                    text-align: center !important;
                }
                td[class=em_align_cent1] {
                    text-align: center !important;
                    padding-bottom: 10px !important;
                }
                td[class=em_height] {
                    height: 20px !important;
                }
                td[class=em_aside] {
                    padding-left: 10px !important;
                    padding-right: 10px !important;
                }
                td[class=em_font] {
                    font-size: 14px !important;
                    line-height: 28px !important;
                }
                span[class=em_br] {
                    display: block !important;
                }
                a.btn:visited {
                    color: white;
                }
                a.btn:link{
                    color:white;
                }
            }
        </style>
    </head>

    <body style="margin:0px; padding:0px;" bgcolor="#ffffff">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
            <!-- === PRE HEADER SECTION=== -->
            <tr>
                <td align="center" valign="top" bgcolor="#30373b">
                    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;">
                        <tr>
                            <td style="line-height:0px; font-size:0px;" width="600" class="em_hide" bgcolor="#30373b"><img src="images/spacer.gif" height="1" width="600" style="max-height:1px; min-height:1px; display:block; width:600px; min-width:600px;" border="0" alt="" /></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_wrapper">
                                    <tr>
                                        <td height="10" class="em_height" style="font-size:1px; line-height:1px;">&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="10" class="em_height" style="font-size:1px; line-height:1px;">&nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- === //PRE HEADER SECTION=== -->
            <!-- === BODY SECTION=== -->
            <tr>
                <td align="center" valign="top" bgcolor="#EAEAEA">
                    <table width="800" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;">
                        <!-- === LOGO SECTION === -->
                        <tr>
                            <td height="40" class="em_height">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="30" class="em_height">&nbsp;</td>
                        </tr>
                        <!-- === //LOGO SECTION === -->
                        <!-- === IMG WITH TEXT AND COUPEN CODE SECTION === -->
                        <tr>
                        <td style="border: 1px solid rgba(101,164,179,.5);background-color: #ffffff;padding: 2rem 1rem;font-family:'Open Sans', Arial, sans-serif; font-size:13px; line-height:22px; color:#797979;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:18px; font-weight:bold; line-height:18px; color:#30373b;">
                                            <?= Yii::t('app', '¡Hola') . ' ' . $user->customer->first_name . '!' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:15px; line-height:22px;">
                                        <?= Yii::t('app', 'Queremos estar seguros que recibirás la atención adecuada; por lo que te solicitamos confirmar tu cuenta y reestablecer tu contraseña.') ?>. <br class="em_hide">
                                    </tr>
                                    <tr>
                                        <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="center">
                                            <a href="<?= $resetLink ?>" class="btn" target="_blank" style="background-color: #feae39;font-family:'Open Sans', Arial, sans-serif;font-size:17px;font-weight:bold;color:#ffffff;display: inline-block;padding: .5rem 1rem;text-decoration: none">
                                                <?= Yii::t('app', 'Restablecer contraseña') ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                    </tr>
                                    <tr style="margin-top: 1.5rem">
                                        <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:15px; line-height:22px;">
                                            <?= Yii::t('app', 'Ahora ya podrás recibir la asesoría personalizada para integrar el viaje a tu medida.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                    </tr>
                                    <tr style="margin-top: .5rem">
                                        <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:15px; line-height:22px;">
                                            <?= Yii::t('app', 'Viaja seguro… viaja en tu idioma.. viaja con.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <img src="https://www.casa_bravo.mx/img/logo.png" width="130" height="40" style="margin-top: 1.5rem" border="0" alt="casa_bravo" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- === //IMG WITH TEXT AND COUPEN CODE SECTION === -->
                        <tr>
                            <td height="40" class="em_height">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="30" class="em_height">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- === //BODY SECTION=== -->
            <!-- === FOOTER SECTION === -->
            <tr>
                <td align="center" valign="top" bgcolor="#30373b" class="em_aside">
                    <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;">
                        <tr>
                            <td height="35" class="em_height">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top" align="center">
                                <table border="0" cellspacing="0" cellpadding="0" align="center">
                                    <tr>
                                        <td valign="top">
                                            <a href="https://www.facebook.com/casa_bravoMx/" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/fb.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Fb" /></a>
                                        </td>
                                        <td width="7">&nbsp;</td>
                                        <td valign="top">
                                            <a href="https://www.instagram.com/casa_bravomx/" target="_blank" style="text-decoration:none;"><img src="https://www.sendwithus.com/assets/img/emailmonks/images/insta.png" width="26" height="26" style="display:block;font-family: Arial, sans-serif; font-size:10px; line-height:18px; color:#feae39; " border="0" alt="Instagram" /></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="22" class="em_height">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789; text-transform:uppercase;">
                                <span style="text-decoration:underline;"><a href="https://casa_bravo.mx/aviso-de-privacidad" target="_blank"
                                    style="text-decoration:underline; color:#848789;"><?= Yii::t('app', 'Aviso de privacidad') ?></a></span> &nbsp;&nbsp;|&nbsp;&nbsp; <span style="text-decoration:underline;"><a href="https://casa_bravo.mx/terminos-y-condiciones"
                                    target="_blank" style="text-decoration:underline; color:#848789;"><?= Yii::t('app', 'Términos y condiciones') ?></a></span><span class="em_hide">
                        </td>
                    </tr>
                    <tr>
                        <td height="10" style="font-size:1px; line-height:1px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center"
                            style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789;text-transform:uppercase;">
                            <?= date('Y') ?> casa_bravo.MX <?= Yii::t('app', 'Derechos reservados') ?>
                        </td>
                    </tr>
                    <tr>
                        <td height="10" style="font-size:1px; line-height:1px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center"
                            style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789;text-transform:uppercase;">
                            <?= Yii::t('app', 'Si no realizó esta solicitud, puede ignorar este correo electrónico') ?>.<span
                                style="text-decoration:underline;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:18px; color:#848789;">
                                <span style="text-decoration:underline;"><a href="#" target="_blank"
                                    style="text-decoration:underline; color:#848789;"><?= Yii::t('app', 'Teléfono') ?>: <i>+52 99 81 06 73 57</i></a></span> &nbsp;&nbsp;|&nbsp;&nbsp; <span style="text-decoration:underline;"><a href="#"
                                    target="_blank" style="text-decoration:underline; color:#848789;"><?= Yii::t('app', 'Correo electrónico') ?>: <i>servicioalcliente@casa_bravo.mx</i></a></span><span class="em_hide">
                        </td>
                    </tr>
                    <tr>
                        <td height="35" class="em_height">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- === //FOOTER SECTION === -->
    </table>
    <div style="display:none; white-space:nowrap; font:20px courier; color:#ffffff; background-color:#ffffff;">&nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp;</div>
</body>

</html>