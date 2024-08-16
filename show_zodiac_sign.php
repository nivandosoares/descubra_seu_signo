<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function converteData($data, $ano) {
    list($dia, $mes) = explode('/', $data);
    return DateTime::createFromFormat('d/m/Y', "$dia/$mes/$ano");
}

function carregarSignosDoXML($arquivo) {
    $xml = simplexml_load_file($arquivo);
    $signos = [];
    foreach ($xml->signo as $signo) {
        $signos[] = (object) [
            'signoNome' => (string) $signo->signoNome,
            'dataInicio' => (string) $signo->dataInicio,
            'dataFim' => (string) $signo->dataFim,
            'descricao' => (string) $signo->descricao
        ];
    }
    return $signos;
}

$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = date('2024'); 

$data_nascimento = DateTime::createFromFormat('d/m/Y', "$dia/$mes/$ano");

if (!$data_nascimento) {
    die("Data de nascimento inválida: $dia/$mes/$ano");
}

$signos = carregarSignosDoXML('signos.xml');

$signo_usuario = null;

foreach ($signos as $signo) {
    $dataInicio = converteData($signo->dataInicio, $ano);
    $dataFim = converteData($signo->dataFim, $ano);

    if ($dataInicio > $dataFim) {
        // Caso especial para signos que passam pelo ano novo
        if ($data_nascimento >= $dataInicio || $data_nascimento <= converteData($signo->dataFim, $ano + 1)) {
            $signo_usuario = $signo;
            break;
        }
    } else {
        if ($data_nascimento >= $dataInicio && $data_nascimento <= $dataFim) {
            $signo_usuario = $signo;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Signo</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f7f7f7;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }
        .btn-primary {
            border-radius: 30px;
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
        }
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php if ($signo_usuario): ?>
            <div class="card">
                <div class="card-header text-center">
                    <h2><?php echo $signo_usuario->signoNome; ?></h2>
                </div>
                <div class="card-body">
                    <p><strong>Descrição:</strong> <?php echo $signo_usuario->descricao; ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center" role="alert">
                Signo não encontrado para a data de nascimento fornecida.
            </div>
        <?php endif; ?>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-primary">Voltar à Página Inicial</a>
        </div>
    </div>
</body>
</html>
