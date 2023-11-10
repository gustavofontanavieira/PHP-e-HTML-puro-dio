<?php 
    define('HOST', '127.0.0.1');
    define('PORT', '3306');
    define('DBNAME', 'cadastroPhp');
    define('USER', 'root');
    define('PASSWORD', '');
    
    try {
        $dsn = new PDO("mysql:host=". HOST . ";port=".PORT.";dbname=" . DBNAME .";user=" . USER . ";password=" . PASSWORD);

    } catch (PDOException $e) {
        echo 'A conexão falhou e retornou a seguinte mensagem de erro: ' .$e->getMessage();
    }

    $scriptInsercao = $dsn->prepare("INSERT INTO cliente(nome_cliente, cpf_cliente, email_cliente, data_nascimento_cliente) values (?, ?, ?, ?)");
    $insert = $scriptInsercao->execute([$_POST['nome_cliente'], $_POST['cpf_cliente'],  $_POST["email_cliente"],  $_POST["data_nascimento_cliente"]]);

    if($insert){
        /* echo $insert;
        echo "Dados inseridos com sucesso"; */
    }else {
        echo "não deu certo";
    }

    $scriptSelecao = $dsn->query("SELECT * FROM cliente");
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <style>
        body{
            background-color:rgb(140, 57, 150);
        }

        h2{
            color: yellowgreen;
        }

        .list{
            background-color: blueviolet;
            margin: 0 auto;
            margin-top: 3rem;
            width: 50vw;
        }
        strong{
            color: rgb(255, 255, 10)
        }

    </style>
</head>
<body>
    <form action="GET">
        <?php while ($row = $scriptSelecao->fetch(PDO::FETCH_ASSOC)): ?>
    </form>
    
    <div class="list">
        <h2><strong>Nome:</strong> <?php echo $row['nome_cliente']?></h2>
        <h2><strong>CPF:</strong> <?php echo $row['cpf_cliente']?></h2>
        <h2><strong>Email:</strong> <?php echo $row['email_cliente']?></h2>
        <h2><strong>Data de Nascimento:</strong> <?php echo $row['data_nascimento_cliente']?></h2>
    </div>
  

    <?php endwhile ?>
</body>
</html>