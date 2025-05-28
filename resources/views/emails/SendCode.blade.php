<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Perfil Aprovado</title>
</head>

<body style="margin:0; padding:0;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"
        style="font-family: Montserrat, Arial, sans-serif;line-height: 23px;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0"
                    style="background-color:#000000; background: linear-gradient(180deg, #000 45.21%, #4D182E 115.7%); color:#ffffff; text-align:center;">

                    <!-- LOGO -->
                    <tr>
                        <td style="padding-bottom: 20px;padding-top: 40px;">
                             <img src="https://hoominterativa.com.br/_system/loveprive/build/client/images/logo-header.png"
                                alt="LovePrive" style="display:block; margin: 0 auto; max-width:290px;">
                        </td>
                    </tr>

                    <!-- TÍTULO -->
                    <tr>
                        <td style="padding: 30px 0;">
                            <h1 style="font-size: 26px; margin: 0; color:#F14C90; font-weight: bold;">Perfil Aprovado
                            </h1>
                            <h2 style="font-size: 24px; margin: 5px 0 0 0; color:#ffffff; font-weight: bold;">com
                                Sucesso!</h2>
                        </td>
                    </tr>

                    <!-- TEXTO PRINCIPAL -->
                    <tr>
                        <td style="padding: 20px 0;">
                            <p style="font-size: 16px; color: #ffffff; margin: 0 0 40px 0;">
                                <b>
                                Parabéns, seu perfil passou na análise da nossa equipe,<br>
                                Agora Você poderá entrar na sua área em nossa plataforma.
                                </b>
                            </p>
                            <p style="font-size: 16px; color: #dddddd; margin: 10px 0 0 0;">
                                Acesse nossa plataforma através do link abaixo e informe as<br>
                                credenciais informadas neste e-mail.
                            </p>
                        </td>
                    </tr>

                    <!-- BOTÃO -->
                    <tr>
                        <td style="padding: 20px 0;">
                            <a href="https://hoominterativa.com.br/_system/loveprive/acompanhante" target="_blank"
                                style="display:inline-block; padding: 12px 25px; background-color:#F14C90; color:#ffffff; text-decoration:none; border-radius:20px; font-size:16px;">
                                Área Acompanhantes
                            </a>
                        </td>
                    </tr>

                    <!-- CREDENCIAIS -->
                    <tr>
                        <td align="left"
                            style="padding: 30px 20px 10px 20px; color: #F14C90; font-weight: bold; font-size: 16px;">
                            Credenciais de Acesso
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 20px 20px 20px;">
                            <table width="100%" cellspacing="0" cellpadding="10"
                                style="background-color:#F14C90; border-radius:10px;">
                                <tr>
                                    <td align="left" style="color: #ffffff; font-size: 14px;">
                                        Usuário: <span style="font-weight: bold;">{{ $companion->email }}</span><br>
                                        Senha: <span style="font-weight: bold;">{{ $password }}</span>
                                    </td>
                                </tr>
                            </table>
                            <p style="font-size: 12px; color: #cccccc; margin-top: 10px;">
                                Para sua segurança, recomendamos alterar a senha no primeiro acesso à plataforma!
                            </p>
                        </td>
                    </tr>

                    <!-- RODAPE COM ICONES -->
                    <tr>
                        <td style="padding: 15px 0 15px 0;background-color:#000000;">
                            <table border="0" cellspacing="0" cellpadding="10" align="center">
                                <tr>
                                    <td>
                                        <a href="">
                                            <img src="https://hoominterativa.com.br/newsletters/loveprive/instagram.png" alt="Instagram" width="30" style="display:block;">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="">
                                            <img src="https://hoominterativa.com.br/newsletters/loveprive/youtube.png" alt="YouTube" width="30" style="display:block;">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="">
                                            <img src="https://hoominterativa.com.br/newsletters/loveprive/linkedin.png" alt="LinkedIn" width="30" style="display:block;">
                                        </a>
                                    </td>
                                    <td>
                                        <a href=""> 
                                            <img src="https://hoominterativa.com.br/newsletters/loveprive/tiktok.png" alt="TikTok" width="30" style="display:block;">
                                        </a>    
                                    </td>
                                    <td>
                                        <a href="">
                                            <img src="https://hoominterativa.com.br/newsletters/loveprive/twitter.png" alt="LovePrive" width="30" style="display:block;">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>