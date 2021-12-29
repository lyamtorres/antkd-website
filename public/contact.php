<?php 
    $msg = '';
    $msgClass = '';

    // Check for submit
    if(filter_has_var(INPUT_POST, 'submit')) {
        // Get form data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message= htmlspecialchars($_POST['message']);

        // Check required fields
        if(!empty($name) && !empty($email) && !empty($message)) {
            // Passed
            // Check email
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $msg = 'Por favor usar una dirección de correo valida';
                $msgClass = 'alert-danger';
            } else {
                // Passed
                // Recipient email
                $toEmail = 'lyamtorres@icloud.com';
                $subject = 'Solicitud de contacto de '.$name;
                $body = '<h2>Solicitud de contacto</h2>
                    <h4>Name</h4><p>.$name</p>
                    <h4>Email</h4><p>.$email</p>
                    <h4>Message</h4><p>.$message</p>
                ';

                // Email headers
                $headers = "MIME-Version: 1.0"."\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

                // Additional Headers
                $headers .= "From: " .$name. "<".$email.">". "\r\n";

                if(mail($toEmail, $subject, $body, $headers)) {
                    // Email sent
                    $msg = 'Tu correo ha sido enviado';
                    $msgClass = 'alert-success';
                } else {
                    // Failed
                    $msg = 'Tu correo no ha podido ser enviado';
                    $msgClass = 'alert-danger';
                }
            }
        } else {
            // Failed
            $msg = 'Por favor llenar todos los campos';
            $msgClass = 'alert-danger';
        }
    }
?>
<?php include '../templates/header.php'; ?>
<section class="main-title">
    <div class="container">
        <h1>Contáctanos</h1>
    </div>
</section>
<section class="contact">
    <?php if($msg != ''): ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="name">Nombre</label><br />
                <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>"><br />
            </div>
            <div class="form-group">
                <label for="email">Dirección de correo</label><br />
                <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>"><br />
            </div>
            <div class="form-group">
                <label for="message">Mensaje</label><br />
                <textarea name="message" class="form-control" cols="30" rows="10"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea><br />
            </div>  
            <button type="submit" name="submit">Enviar</button>
        </form>
    </div>
</section>
<?php include '../templates/footer.php'; ?>