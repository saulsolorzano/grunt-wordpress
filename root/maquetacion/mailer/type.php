<!DOCTYPE html>
<?php
$color = '#1A243C';
$color_links = '#C22D54';
$color_texto = '#4f4f4f';
$color_title = '#FFFFFF';
$logo = 'http://sandbox.dev/contacto-reactor/img/logo-reactor-newsletter.png';
$asunto = '[asunto] - [titulo]';
$title = 'Reactor';
$campos = array(
    array(
        'tipo' => 'normal',
        'label' => 'Nombre',
        'tag' => '[nombre]'
    ),
    array(
        'tipo' => 'link',
        'label' => 'Correo',
        'tag' => '[correo]'
    ),
    array(
        'tipo' => 'normal',
        'label' => 'Mensaje',
        'tag' => '[mensaje]'
    ),
    array(
        'tipo' => 'normal',
        'label' => 'Asunto',
        'tag' => '[asunto]'
    )
);
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Newsletter</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
        <style>
            #outlook a { padding:0; }
            body{ width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; }
            table {border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}
            table td {border-collapse: collapse;}
            h1, h2, h3, h4, h5, h6, p{ margin:0; padding: 0; }
            /* End reset */

            #mailContainer { 
                max-width:600px; 
            }
            .text {
                font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;
                padding: 0;
                text-transform:none;
            }
            .appleLinks a {
                color: <?php echo $color_links; ?> !important;
                text-decoration: underline !important;
            }
            .appleBlack a {
                color: <?php echo $color_texto; ?> !important;
                text-decoration: underline !important;
            }
            .space {
                display: none !important;
            }
            @media screen and (max-width:600px){
                .full-size {
                    width: 100% !important;
                }
                .header {
                    height: 97px !important;
                    display: block !important;
                }
                .block {
                    display: block !important;
                }
                .title {
                    text-align: center !important;
                }
                .hide {
                    display: none !important;
                }
                .body {
                    width: 90% !important;
                }
                .space {
                    display: block !important;
                    width: 5% !important;
                }
                .space-in {
                    display: block !important;
                }
                .no-mobile {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="#FFFFFF" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;width: 100% !important;">
        <center>
            <table class="full-size" width="100%" height="100%" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                <tbody>
                    <tr>
                        <td align="center" style="background:<?php echo $color?>;" colspan="3">
                            <table class="full-size header" width="600" height="60" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tbody class="full-size block">
                                    <tr width="600" class="full-size block">
                                        <td class="space-in no-mobile" width="20">
                                            <span style="font-size:24px;line-height:24px;">&nbsp;</span>
                                        </td>
                                        <td width="432" align="center" class="text full-size title block" style="font-size:22px;line-height:28px;font-weight:bold;color:<?php echo $color_title; ?>; text-align:left;">
                                            <p>
                                                <?php echo $title; ?>
                                            </p>
                                        </td>
                                        <td width="128" align="center" class="full-size block">
                                            <img src="<?php echo $logo; ?>" alt="<?php echo $title; ?>">
                                        </td>
                                        <td class="space-in no-mobile" width="20">
                                            <span style="font-size:24px;line-height:24px;">&nbsp;</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr height="24" width="560">
                        <td align="center" colspan="3">
                            <span style="font-size:24px;line-height:24px;">&nbsp;</span>
                        </td>
                    </tr>
                    <tr class="full-size">
                        <td class="space" align="center" width="30">
                            <span style="font-size:24px;line-height:24px;">&nbsp;</span>
                        </td>
                        <td align="center" class="body">
                            <table class="full-size" width="560" height="60" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border:1px solid #e5e5e5;">
                                <tbody>
                                    <tr height="64" style="background-color:#f1f1f1;" bgcolor="#f1f1f1">
                                        <td class="full-size" width="560" align="center" colspan="3">
                                            <table class="full-size" width="560" height="60" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-bottom:1px solid #e5e5e5;">
                                                <tbody>
                                                    <tr height="19">
                                                        <td align="center" colspan="3">
                                                            <span style="font-size:19px;line-height:19px;">&nbsp;</span>
                                                        </td>
                                                    </tr>
                                                    <tr height="26">
                                                        <td width="30">
                                                            <span style="font-size:19px;line-height:19px;">&nbsp;</span>
                                                        </td>
                                                        <td align="center" class="text title" style="font-size:22px;line-height:26px;font-weight:bold;color:<?php echo $color_texto; ?>;text-align:left;">
                                                            <p>
                                                                <?php echo $asunto; ?>
                                                            </p>
                                                        </td>
                                                        <td width="30">
                                                            <span style="font-size:19px;line-height:19px;">&nbsp;</span>
                                                        </td>
                                                    </tr>
                                                    <tr height="19">
                                                        <td align="center" colspan="3">
                                                            <span style="font-size:19px;line-height:19px;">&nbsp;</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr height="24" align="center">
                                        <td width="20" class="space-in">
                                            <span style="font-size:19px;line-height:19px;">&nbsp;</span>
                                        </td>
                                        <td class="full-size" width="520" align="center">
                                            <table class="full-size" width="520" height="60" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                <tbody>
                                                    <?php foreach ($campos as $campo) : ?>
                                                        <tr height="60">
                                                            <td class="hide" width="30" style="border-bottom:1px solid #e5e5e5;">
                                                                <span style="font-size:19px;line-height:19px;">&nbsp;</span>
                                                            </td>
                                                            <td class="full-size" align="center" width="440" style="border-bottom:1px solid #e5e5e5;">
                                                                <table class="full-size" width="440" height="60" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                        <tr height="22">
                                                                            <td align="center">
                                                                                <span style="font-size:22px;line-height:22px;">&nbsp;</span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center" width="130" class="text" style="font-size:16px;line-height:16px;font-weight:bold;color:<?php echo $color_texto; ?>; text-align:left;">
                                                                                <p>
                                                                                    <?php echo $campo['label']; ?>
                                                                                </p>
                                                                            </td>
                                                                            <td align="center" width="310" class="text" style="font-size:14px;line-height:16px;color:<?php echo $color_texto; ?>;text-align:left;">
                                                                                <?php if ( $campo['tipo'] == 'link' ) : ?>
                                                                                    <div class="appleLinks">
                                                                                        <a href="mailto:<?php echo $campo['tag']; ?>" style="color:<?php echo $color_links; ?>;display:inline-block;-webkit-text-size-adjust:none;text-decoration:underline;"><?php echo $campo['tag']; ?></a>
                                                                                    </div>
                                                                                <?php else : ?>
                                                                                <p>
                                                                                    <?php echo $campo['tag']; ?>
                                                                                </p>
                                                                                <?php endif; ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr height="22">
                                                                            <td align="center">
                                                                                <span style="font-size:22px;line-height:22px;">&nbsp;</span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                            <td class="hide" width="30" style="border-bottom:1px solid #e5e5e5;">
                                                                <span style="font-size:19px;line-height:19px;">&nbsp;</span>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="20" class="space-in">
                                            <span style="font-size:19px;line-height:19px;">&nbsp;</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="space" align="center" width="30">
                            <span style="font-size:24px;line-height:24px;">&nbsp;</span>
                        </td>
                    </tr>
                    <tr height="20" width="560">
                        <td align="center" colspan="3">
                            <span style="font-size:20px;line-height:20px;">&nbsp;</span>
                        </td>
                    </tr>
                    <tr height="10" width="560" class="full-size">
                        <td align="center" colspan="3">
                            <table class="full-size" width="560" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                <tbody>
                                    <tr width="560">
                                        <td class="full-size block title" width="280" style="font-size:10px;line-height:12px;;color:<?php echo $color_texto; ?>;text-align:left;">
                                            <p class="text appleBlack">
                                                <!-- 15 de abril, 2016 | 23:44 -->
                                            </p><!-- /.text -->
                                        </td>
                                        <td class="space full-size block" height="10">
                                            <span style="font-size:10px;line-height:10px;">&nbsp;</span>
                                        </td>
                                        <td class="full-size block title" width="280" style="font-size:10px;line-height:10px;;color:<?php echo $color_texto; ?>;text-align:right; vertical-align:center;">
                                            <p class="text" style="margin-right:5px;display:inline-block;">
                                                Dessarrollado por
                                                <a href="#" title="Desarrollado por reactor" style="display:inline-block; height:10px;" height="10">
                                                    <img src="http://newsletters.reactor.cl/reactor/img/reactor.png" alt="Reactor Logo" height="10" style="height:10px;">
                                                </a>
                                            </p><!-- /.text -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr height="20" width="560">
                        <td align="center">
                            <span style="font-size:20px;line-height:20px;">&nbsp;</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </body>
</html>