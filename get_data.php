<?php
// Conecta ao banco de dados
$connection = mysqli_connect("localhost", "id22261045_fusca", "Rededi360@", "id22261045_banco");

// Obtém o inc_code da URL
$inc_code = $_GET['inc_code'];

// Faz a consulta ao banco de dados
$limit = $_GET['limit'];
$query = "SELECT temperatura, umidade, pwm_fan, pwm_lamp, timestamp FROM dados WHERE inc_code = '$inc_code' ORDER BY timestamp DESC LIMIT $limit";
$result = mysqli_query($connection, $query);

// Cria um array para armazenar os resultados
$data = array();

// Loop pelos resultados e adiciona ao array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Fecha a conexão
mysqli_close($connection);

// Retorna os dados em formato JSON
$jsonData = json_encode($data);
echo $jsonData;
?>