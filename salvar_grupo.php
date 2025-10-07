<?php
include 'conexao.php';

if(isset($_POST["tema"]) && isset($_POST["po"])){
    $sql_grupo = "INSERT INTO GRUPO (GRUPO_TEMA, GRUPO_TURMA, GRUPO_PO, GRUPO_DATA_CADASTRO) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql_grupo);
    $stmt->bind_param("sss", $_POST["tema"], $_POST["turma"], $_POST["po"]);
    $stmt->execute();

    $grupo_id = $stmt->insert_id;
  
    $sql_aluno1 = "INSERT INTO ALUNO (ALUNO_NOME, ALUNO_PAPEL, ALUNO_FK_GRUPO_ID) VALUES (?, ?, ?)";
    $stmt1 = $conn->prepare($sql_aluno1);
    $stmt1->bind_param("sss",$_POST["aluno_nome1"],$_POST["aluno_papel1"],$grupo_id);
    $stmt1->execute();

    $sql_aluno2 = "INSERT INTO ALUNO (ALUNO_NOME, ALUNO_PAPEL, ALUNO_FK_GRUPO_ID) VALUES (?, ?, ?)";
    $stmt2 = $conn->prepare($sql_aluno2);
    $stmt2->bind_param("sss",$_POST["aluno_nome2"],$_POST["aluno_papel2"],$grupo_id);
    $stmt2->execute();

    $sql_aluno3 = "INSERT INTO ALUNO (ALUNO_NOME, ALUNO_PAPEL, ALUNO_FK_GRUPO_ID) VALUES (?, ?, ?)";
    $stmt3 = $conn->prepare($sql_aluno3);
    $stmt3->bind_param("sss",$_POST["aluno_nome3"],$_POST["aluno_papel3"],$grupo_id);
    $stmt3->execute();

    $sql_aluno4 = "INSERT INTO ALUNO (ALUNO_NOME, ALUNO_PAPEL, ALUNO_FK_GRUPO_ID) VALUES (?, ?, ?)";
    $stmt4 = $conn->prepare($sql_aluno4);
    $stmt4->bind_param("sss",$_POST["aluno_nome4"],$_POST["aluno_papel4"],$grupo_id);
    $stmt4->execute();

    $sql_aluno5 = "INSERT INTO ALUNO (ALUNO_NOME, ALUNO_PAPEL, ALUNO_FK_GRUPO_ID) VALUES (?, ?, ?)";
    $stmt5 = $conn->prepare($sql_aluno5);
    $stmt5->bind_param("sss",$_POST["aluno_nome5"],$_POST["aluno_papel5"],$grupo_id);
    $stmt5->execute();

    if(isset($_POST["aluno_nome6"])){
        $sql_aluno6 = "INSERT INTO ALUNO (ALUNO_NOME, ALUNO_PAPEL, ALUNO_FK_GRUPO_ID) VALUES (?, ?, ?)";
        $stmt6 = $conn->prepare($sql_aluno6);
        $stmt6->bind_param("sss",$_POST["aluno_nome6"],$_POST["aluno_papel6"],$grupo_id);
        $stmt6->execute();
    }

    header("Location: index.php");
} 

?>
