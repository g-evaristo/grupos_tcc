<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Grupos de TCC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    html, body {
      min-height: 100vh;
      overflow-x: hidden;
      overflow-y: auto;
      color: #0a2342;
      position: relative;
    }

    /* ======= ANIMAÇÃO DE FUNDO (WAVES) ======= */
    section {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: -3;
    }

    section .wave {
      position: absolute;
      left: 0;
      width: 100%;
      height: 100%;
      background: #4973ff;
      box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.5);
      transition: 0.5s;
    }

    section .wave span {
      position: absolute;
      width: 325vh;
      height: 325vh;
      top: 0;
      left: 50%;
      transform: translate(-50%, -75%);
    }

    section .wave span:nth-child(1) {
      border-radius: 45%;
      background: rgba(20, 20, 20, 1);
      animation: animate 5s linear infinite;
    }

    section .wave span:nth-child(2) {
      border-radius: 40%;
      background: rgba(20, 20, 20, 0.5);
      animation: animate 10s linear infinite;
    }

    section .wave span:nth-child(3) {
      border-radius: 42.5%;
      background: rgba(20, 20, 20, 0.5);
      animation: animate 15s linear infinite;
    }

    @keyframes animate {
      0% { transform: translate(-50%, -75%) rotate(0deg); }
      100% { transform: translate(-50%, -75%) rotate(360deg); }
    }

    /* ======= CONTAINER ======= */
    .container {
      position: relative;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
      width: 100%;
      max-width: 950px;
      padding: 40px 50px;
      margin: 80px auto;
      z-index: 5;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: scale(0.98);}
      to {opacity: 1; transform: scale(1);}
    }

    h1 {
      text-align: center;
      color: #0a2342;
      margin-bottom: 20px;
    }

    p {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
      font-size: 14px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    label {
      font-size: 14px;
      color: #0a2342;
      font-weight: 600;
    }

    input[type="text"], input[type="date"], select {
      width: 100%;
      padding: 10px 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 14px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus, select:focus {
      border-color: #0E4194;
      box-shadow: 0 0 8px rgba(0,191,255,0.3);
      outline: none;
    }

    .students {
      margin-top: 10px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .student-row {
      display: flex;
      gap: 12px;
    }

    .student-row > div {
      flex: 1;
    }

    button {
      background: linear-gradient(90deg, #0072ff, #00d4ff);
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      padding: 14px;
      cursor: pointer;
      transition: 0.3s ease;
      margin-top: 10px;
    }

    button:hover {
      background: linear-gradient(90deg, #0E4194, #0072ff);
      transform: scale(1.02);
    }

    .footer {
      text-align: center;
      font-size: 12px;
      color: #777;
      margin-top: 25px;
    }

    @media (max-width: 700px) {
      .student-row { flex-direction: column; }
      .container { padding: 25px; margin: 30px auto; }
    }

    .logo-senai{
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 40%;
    }
  </style>
</head>
<body>
  <!-- Fundo animado (WAVES) -->
  <section>
    <div class="wave">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </section>

  <!-- Conteúdo principal -->
  <div class="container">
    <a href="index.php"><button>Voltar</button></a>
    <img class="logo-senai" src="https://upload.wikimedia.org/wikipedia/commons/0/05/SENAI_logo_2024.png" alt="Logo SENAI">
    <h1>Cadastro de Grupo de TCC</h1>
    <p>Preencha os dados do grupo, incluindo o tema, o Product Owner e os integrantes obrigatórios.</p>

    <form method="POST" action="salvar_grupo.php" autocomplete="off">
      <label for="tema">Tema do Grupo</label>
      <input type="text" id="tema" name="tema" required maxlength="255" placeholder="Ex.: Sistema de Controle Industrial">

      <label for="turma">Turma do Grupo</label>
      <select name="turma" id="turma" required>
        <option value="">Selecione...</option>
        <option value="A">A</option>
        <option value="B">B</option>
      </select>

      <label for="po">Product Owner (PO)</label>
      <input type="text" id="po" name="po" required maxlength="255" placeholder="Nome do Product Owner">

      <h3 style="margin-top:15px; color:#0a2342;">Integrantes do Grupo</h3>
      <div class="students">
        <?php
        for($i=1; $i<=6; $i++):
          $required = $i <= 5 ? "required" : "";
          $texto = $i <= 5 ? "Aluno $i " : "Aluno $i  (opcional)";
        ?>
        <div class="student-row">
          <div>
            <label for="nome<?=$i?>"><?=$texto?></label>
            <input type="text" id="nome<?=$i?>" name="aluno_nome<?php echo $i?>" <?=$required?> placeholder="Nome completo">
          </div>
          <div>
            <label for="papel<?=$i?>">Papel</label>
            <select id="papel<?=$i?>" name="aluno_papel<?php echo $i?>" <?=$required?>>
              <option value="">Selecione</option>
              <option value="DBA/PROGRAMADOR FRONT-END">DBA/PROGRAMADOR FRONT-END</option>
              <option value="PROGRAMADOR BACK-END">PROGRAMADOR BACK-END</option>
              <option value="PROGRAMADOR FULL STACK">PROGRAMADOR FULL STACK</option>
            </select>
          </div>
        </div>
        <?php endfor; ?>
      </div>

      <button type="submit">Cadastrar Grupo</button>
    </form>
    <div class="footer">© 2025 SENAI</div>
  </div>
</body>
</html>
