<?php

// Conecta ao banco de dados
$connection = mysqli_connect("localhost", "id22261045_fusca", "Rededi360@", "id22261045_banco");

// Verifica se a conexão foi bem-sucedida
if (mysqli_connect_errno()) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$temperatura = $umidade = $inc_code = $pwm_lamp = $pwm_fan = "";
// Obtém os dados do POST
$temperatura = $_POST['temperatura'];
$umidade = $_POST['umidade'];
$inc_code = $_POST['inc_code'];
$pwm_lamp = $_POST['pwm_lamp'];
$pwm_fan = $_POST['pwm_fan'];

// Imprime os valores das variáveis para fins de depuração
error_log("temperatura: $temperatura, umidade: $umidade, inc_code: $inc_code, pwm_lamp: $pwm_lamp, pwm_fan: $pwm_fan");

// Prepara a consulta SQL
$sql = "INSERT INTO dados (inc_code, temperatura, umidade, pwm_lamp, pwm_fan) VALUES ('" . $inc_code . "', '" . $temperatura . "', '" . $umidade . "', '" . $pwm_lamp . "', '" . $pwm_fan . "')";

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} 
else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();

?>