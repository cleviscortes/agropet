<?php
// Configurações
$to = "contato@agropetmontanha.com.br"; // E-mail de destino (alterar para o real)
$subject = "Novo contato pelo site da Agropet";

// Verifica se foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $telefone = strip_tags(trim($_POST["telefone"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensagem = strip_tags(trim($_POST["mensagem"]));

    // Validação básica
    if (empty($nome) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status = "error";
        $feedback = "Por favor, preencha todos os campos corretamente.";
    } else {
        // Monta o corpo do email
        $email_content = "Nome: $nome\n";
        $email_content .= "Telefone: $telefone\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Mensagem:\n$mensagem\n";

        $headers = "From: $nome <$email>";

        // Tenta enviar (requer servidor SMTP configurado)
        // mail($to, $subject, $email_content, $headers);

        // Simulação de sucesso para este ambiente de desenvolvimento
        $status = "success";
        $feedback = "Mensagem enviada com sucesso. Em breve entraremos em contato.";
    }
} else {
    // Acesso direto não permitido
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Envio - Agropet</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(135deg, #FFF8E1 0%, #FFFFFF 100%);
            text-align: center;
        }

        .status-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 20px;
        }

        .icon-status {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .success {
            color: #2E7D32;
        }

        .error {
            color: #d32f2f;
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        p {
            margin-bottom: 30px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="status-card">
        <?php if ($status == 'success'): ?>
            <div class="icon-status success">✓</div>
            <h1>Obrigado,
                <?php echo $nome; ?>!
            </h1>
            <p>
                <?php echo $feedback; ?>
            </p>
        <?php else: ?>
            <div class="icon-status error">!</div>
            <h1>Ops!</h1>
            <p>
                <?php echo $feedback; ?>
            </p>
        <?php endif; ?>

        <a href="index.html" class="btn-primary">Voltar ao Site</a>
    </div>

    <script>
        // Redireciona automaticamente após 5 segundos se for sucesso
        <?php if ($status == 'success'): ?>
                setTimeout(function () {
                    window.location.href = 'index.html';
                }, 5000);
        <?php endif; ?>
    </script>
</body>

</html>