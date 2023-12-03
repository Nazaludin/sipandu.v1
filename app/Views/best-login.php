<!DOCTYPE HTML>
<HTML>

<HEAD>
    <TITLE>Best Authentication</TITLE>
</HEAD>

<BODY>
    <form id="form-login" action="http://best-bapelkes.jogjaprov.go.id/login/index.php" method="post" target="hidden-form">
        <input hidden type="text" id="username" name="username" value="<?= $email; ?>">
        <input hidden type="password" id="password" name="password" value="<?= $password; ?>">
        <input type="submit" value="Access To Moodle" onclick="submitRedirectSipandu()">
    </form>
</BODY>
<script>
    function submitRedirectSipandu() {
        const form = document.getElementById('form-login');
        form.target = '_blank';

        form.submit();
        form.target = 'hidden-form';

        const redirectURL = '<?= base_url(); ?>';
        setTimeout(function() {
            window.location.href = redirectURL; // Melakukan redirect ke halaman Sipandu setelah 2 detik
        }, 2000);
    }
</script>

</HTML>