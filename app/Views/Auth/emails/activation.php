<div class="card">
    <h1 style="text-align: center;">Aktivasi Email Webisite Sipandu</h1>
    <hr>
    <p style="text-align: center;">Pesan ini merupakan pesan verifikasi email dari website <?= site_url() ?>.</p>
    <p style="text-align: center;">Untuk melakukan aktivasi akun, Anda dapan mengeklik tombol di bawah ini.</p>
    <!--Button-->
    <center>
        <table align="center" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center" style="padding: 10px;">
                    <table border="0" class="mobile-button" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="center" bgcolor="#1d71d3" style="background-color: #1d71d3; margin: auto; max-width: 600px; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; padding: 15px 20px; " width="100%">
                                <!--[if mso]>&nbsp;<![endif]-->
                                <a href="<?= url_to('activate-account') . '?token=' . $hash ?>" target="_blank" style="16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #1d71d3; text-decoration: none; border: none; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; display: inline-block;">
                                    <span style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; line-height:1.5em; text-align:center;">Aktivasi Email</span>
                                </a>
                                <!--[if mso]>&nbsp;<![endif]-->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
    <p style="text-align: center;">Anda dapat juga melakukan melakukan aktivasi dengan klik link berikut: <a href="<?= url_to('activate-account') . '?token=' . $hash ?>">Aktivasi Akun</a>.</p>
    <p style="text-align: center;">Jika Anda tidak mendaftakan diri dalam Website ini, Anda dapat mengabaikan pesan ini.</p>
</div>