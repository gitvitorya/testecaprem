<?php
  $payload = json_decode(file_get_contents("php://input"), true);
  $nome = $payload['nome'];
  $email = $payload['email'];
  $mensagem = $payload['mensagem'];

  $emailRegex = "/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/";
  $emailValido = preg_match($emailRegex, $email);

  if (!$emailValido) {
    echo "O e-mail inserido é inválido.";
    exit();
  }

  $nomeValido = strlen($nome) >= 3;

  if (!$nomeValido) {
      echo "O nome precisa ter pelo menos 3 caracteres.";
      exit();
    }

  $mensagemValida = strlen($mensagem) > 0;

  if (!$mensagemValida) {
      echo "A mensagem não pode estar vazia.";
      exit();
    }

  $data_envio = date('d/m/Y');
  $hora_envio = date('H:i:s');
  
  $arquivo = "
    <html>
      <p><b>Nome: </b>$nome</p>
      <p><b>E-mail: </b>$email</p>
      <p><b>Mensagem: </b>$mensagem</p>
      <p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
    </html>
  ";
  
  $destino = "candidosilvavitorya@gmail.com";
  $assunto = "Contato";

  $headers  = "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
  $headers .= "From: $nome <$email>";

  //Enviar
  mail($destino, $assunto, $arquivo, $headers);
  
  echo "E-mail enviado com sucesso!";
  exit();
?>
