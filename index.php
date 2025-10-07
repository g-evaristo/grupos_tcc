<?php
include 'conexao.php';

$sql = "SELECT      G.GRUPO_ID,
                    G.GRUPO_TEMA, 
                    G.GRUPO_TURMA,
                    G.GRUPO_PO, 
                    G.GRUPO_DATA_CADASTRO,
                    GROUP_CONCAT(CONCAT(A.ALUNO_NOME, ' (', A.ALUNO_PAPEL, ')') SEPARATOR ', ') AS INTEGRANTES
        FROM        GRUPO G
        LEFT JOIN   ALUNO A ON G.GRUPO_ID = A.ALUNO_FK_GRUPO_ID AND A.ALUNO_NOME IS NOT NULL AND A.ALUNO_NOME <> ''
        GROUP BY    G.GRUPO_ID
        ORDER BY    G.GRUPO_DATA_CADASTRO";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Grupos de TCC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap");
    * {margin:0;padding:0;box-sizing:border-box;font-family:"Poppins",sans-serif;}
    html,body{min-height:100vh;overflow-x:hidden;color:#0a2342;position:relative;}
    section{position:fixed;top:0;left:0;width:100%;height:100vh;overflow:hidden;display:flex;justify-content:center;align-items:center;z-index:-3;}
    section .wave{position:absolute;left:0;width:100%;height:100%;background:#4973ff;box-shadow: inset 0 0 50px rgba(0,0,0,0.5);transition:0.5s;}
    section .wave span{position:absolute;width:325vh;height:325vh;top:0;left:50%;transform:translate(-50%,-75%);}
    section .wave span:nth-child(1){border-radius:45%;background:rgba(20,20,20,1);animation:animate 5s linear infinite;}
    section .wave span:nth-child(2){border-radius:40%;background:rgba(20,20,20,0.5);animation:animate 10s linear infinite;}
    section .wave span:nth-child(3){border-radius:42.5%;background:rgba(20,20,20,0.5);animation:animate 15s linear infinite;}
    @keyframes animate {0% {transform:translate(-50%,-75%) rotate(0deg);} 100% {transform:translate(-50%,-75%) rotate(360deg);}}
    
    .container{position:relative;background:#fff;border-radius:16px;box-shadow:0 10px 40px rgba(0,0,0,0.3);width:100%;max-width:1000px;padding:40px 50px;margin:80px auto;z-index:5;animation:fadeIn 1s ease;}
    @keyframes fadeIn{from{opacity:0;transform:scale(0.98);}to{opacity:1;transform:scale(1);}}
    h1{text-align:center;color:#0a2342;margin-bottom:20px;}
    p{text-align:center;color:#333;margin-bottom:25px;font-size:14px;}
    
    /* Cards ocupando uma linha cada */
    .cards{display:grid;grid-template-columns:1fr;gap:20px;margin-top:30px;}
    .card{background:#f5f5f5;padding:20px;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.2);transition:0.3s;text-align:left;}
    .card:hover{transform:scale(1.03);box-shadow:0 6px 20px rgba(0,0,0,0.3);}
    .card h2{margin-bottom:10px;color:#0E4194;font-size:18px;text-align:left;}
    .card p{margin-bottom:6px;font-size:14px;color:#333;text-align:left;}
    .card ul{margin-top:4px;padding-left:20px;} /* lista de integrantes */
    .btn-cadastrar{display:block;width:220px;margin:20px auto 0;background:linear-gradient(90deg,#0072ff,#00d4ff);color:#fff;font-weight:600;border:none;border-radius:10px;padding:12px;text-align:center;text-decoration:none;transition:0.3s;}
    .btn-cadastrar:hover{background:linear-gradient(90deg,#0E4194,#0072ff);transform:scale(1.02);}
    .footer{text-align:center;font-size:12px;color:#777;margin-top:25px;}
    .logo-senai{display:block;margin-left:auto;margin-right:auto;width:40%;}
    @media(max-width:700px){.container{padding:25px;margin:30px auto;}}
  </style>
</head>
<body>
  <section>
    <div class="wave">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </section>

  <div class="container">
    <img class="logo-senai" src="https://upload.wikimedia.org/wikipedia/commons/0/05/SENAI_logo_2024.png" alt="Logo SENAI">
    <h1>Grupos de TCC</h1>
    <p>Visualize os grupos cadastrados ou cadastre um novo grupo.</p>

    <a href="cadastrar_grupo.php" class="btn-cadastrar">Cadastrar Novo Grupo</a>

    <div class="cards">
      <?php
      if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          echo '<div class="card">';
          echo '<h2>'.$row['GRUPO_TEMA'].'</h2>';
          echo '<p><strong>Turma:</strong> '.$row['GRUPO_TURMA'].'</p>';
          echo '<p><strong>PO:</strong> '.$row['GRUPO_PO'].'</p>';
          echo '<p><strong>Data:</strong> '.date("d/m/Y H:i:s", strtotime($row['GRUPO_DATA_CADASTRO'])).'</p>';
          
          if($row['INTEGRANTES']){
              $integrantes = explode(', ', $row['INTEGRANTES']);
              echo '<p><strong>Integrantes:</strong></p>';
              echo '<ul>';
              foreach($integrantes as $aluno){
                  echo '<li>'.$aluno.'</li>';
              }
              echo '</ul>';
          } else {
              echo '<p><strong>Integrantes:</strong> Sem integrantes cadastrados</p>';
          }

          echo '</div>';
        }
      } else {
        echo '<p style="text-align:center;color:#555;">Nenhum grupo cadastrado.</p>';
      }
      ?>
    </div>

    <div class="footer">© 2025 SENAI</div>
  </div>
</body>
</html>
