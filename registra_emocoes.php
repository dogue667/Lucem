<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>LUCEM - Registro de Emoções</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#F9F0E6;
      --card:#FFF2EA;
      --text:#4A3A33;
      --accent:#E3A999;
      font-family:'Poppins',sans-serif;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{
      background:var(--bg);
      color:var(--text);
      display:flex;
      justify-content:center;
      align-items:center;
      min-height:100vh;
    }
    .card{
      display:flex;
      background:var(--card);
      border-radius:20px;
      padding:30px;
      gap:30px;
      box-shadow:0 4px 15px rgba(0,0,0,0.05);
      max-width:1000px;
      width:90%;
    }
    form{flex:1;}
    h2{font-weight:600;margin-bottom:10px;}
    .week{
      display:flex;
      gap:10px;
      margin:20px 0;
    }
    .chip{
      flex:1;
      text-align:center;
      border-radius:12px;
      padding:14px 0;
      cursor:pointer;
      box-shadow:0 2px 0 rgba(0,0,0,0.05);
      font-weight:500;
      transition:transform .2s;
    }
    .chip span{display:block;margin-top:6px;font-weight:600}
    .chip.selected{transform:translateY(-4px);outline:3px solid rgba(0,0,0,0.05)}
    .chip[data-color="#F6D7A8"]{background:#F6D7A8}
    .chip[data-color="#E6C6D0"]{background:#E6C6D0}
    .chip[data-color="#CDE7B8"]{background:#CDE7B8}
    .chip[data-color="#F2B3AE"]{background:#F2B3AE}
    .chip[data-color="#BFD5F0"]{background:#BFD5F0}
    .chip[data-color="#F6EDE6"]{background:#F6EDE6}
    textarea{
      width:100%;
      min-height:80px;
      padding:12px;
      border-radius:10px;
      border:none;
      background:#F6EDE6;
      resize:none;
      font-family:inherit;
      margin:10px 0 20px;
    }
    .factors{
      display:flex;
      gap:14px;
      flex-wrap:wrap;
      margin-bottom:15px;
    }
    .factors label{
      background:#FFF3EE;
      padding:8px 12px;
      border-radius:8px;
      cursor:pointer;
    }
    .btn-save{
      background:#E1A89D;
      color:white;
      border:none;
      padding:10px 20px;
      border-radius:10px;
      cursor:pointer;
      font-weight:500;
    }
    .sidebox{
      flex:0 0 260px;
      padding-left:20px;
      border-left:1px solid rgba(0,0,0,0.05);
    }
    .sidebox h4{
      margin:8px 0 6px;
      font-weight:600;
    }
    .sidebox p{
      margin-bottom:10px;
      font-size:14px;
      line-height:1.4;
    }
    @media(max-width:900px){
      body{align-items:flex-start;padding:30px 0}
      .card{flex-direction:column;width:95%}
      .sidebox{border-left:none;border-top:1px solid rgba(0,0,0,0.1);padding-top:15px}
    }
  </style>
</head>
<body>

<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
  $dir=__DIR__.'/registros';
  if(!is_dir($dir)) mkdir($dir,0755,true);
  $file=$dir.'/registros.txt';
  $emocao=strip_tags($_POST['emocao']??'');
  $descricao=strip_tags($_POST['descricao']??'');
  $fatores=$_POST['fatores']??[];
  $fatores=array_map('strip_tags',$fatores);
  $entry="---\nData: ".date('Y-m-d H:i:s')."\nEmoção: ".($emocao?:'Não informada')."\nDescrição:\n".($descricao?:'—')."\n\nFatores:\n".(count($fatores)?('- '.implode("\n- ",$fatores)):"—")."\n---\n\n";
  file_put_contents($file,$entry,FILE_APPEND|LOCK_EX);
  echo "<script>alert('Registro salvo com sucesso!');</script>";
}
?>

<div class="card">
  <form method="post">
    <h2>Seu Mapa Emocional da Semana</h2>
    <div class="week">
      <div class="chip" data-emotion="Calmo" data-color="#F6D7A8">Seg<br><span>Calmo</span></div>
      <div class="chip" data-emotion="Triste" data-color="#E6C6D0">Ter<br><span>Triste</span></div>
      <div class="chip" data-emotion="Grato" data-color="#CDE7B8">Qua<br><span>Grato</span></div>
      <div class="chip" data-emotion="Ansioso" data-color="#F2B3AE">Qui<br><span>Ansioso</span></div>
      <div class="chip" data-emotion="Feliz" data-color="#BFD5F0">Sex<br><span>Feliz</span></div>
      <div class="chip" data-emotion="" data-color="#F6EDE6">Sáb<br><span>—</span></div>
    </div>

    <h3>Descreva seu dia em palavras</h3>
    <input type="hidden" name="emocao" id="emocaoInput">
    <textarea name="descricao" placeholder="Descreva seu dia em palavras"></textarea>

    <h3>O que ajudou ou piorou seu humor?</h3>
    <div class="factors">
      <label><input type="checkbox" name="fatores[]" value="Amigos"> Amigos</label>
      <label><input type="checkbox" name="fatores[]" value="Trabalho"> Trabalho</label>
      <label><input type="checkbox" name="fatores[]" value="Sono"> Sono</label>
      <label><input type="checkbox" name="fatores[]" value="Alimentação"> Alimentação</label>
    </div>

    <button type="submit" class="btn-save">Salvar registro</button>
  </form>

  <div class="sidebox">
    <h4>Resumo da Semana</h4>
    <p>Você se sentiu mais calmo(a) em 3 dias</p>

    <h4>Sugestão Lucem</h4>
    <p>Experimente o exercício de respiração 4x4 hoje.</p>

    <h4>Sugestão Lucem</h4>
    <p>Ouça uma meditação guiada de 1 minuto.</p>
  </div>
</div>

<script>
  const chips=document.querySelectorAll('.chip');
  const emocaoInput=document.getElementById('emocaoInput');
  chips.forEach(c=>{
    c.addEventListener('click',()=>{
      chips.forEach(x=>x.classList.remove('selected'));
      c.classList.add('selected');
      emocaoInput.value=c.dataset.emotion||'';
    });
  });
</script>

</body>
</html>
