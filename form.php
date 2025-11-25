<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LUCEM — Formulário de Bem-Estar</title>
 <link rel="stylesheet" href="darkmode.css">
  <style>
  :root {
    --bg: #f9efe4;
    --menu: #ffffff;
    --texto: #5b3a70;
    --roxo: #9b6bc2;
    --roxo-escuro: #4d2f68;
    --hover: #e7d3f5;
    --degrade: linear-gradient(135deg, #d1b3f1, #a57cd3, #8a68b0);
      background-color: var(--menu);
  }

  body {
    margin: 0;
    font-family: "Inter", sans-serif;
    background-color: var(--bg);
    color: var(--texto);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 40px 20px;
  }

  h1 {
    color: var(--roxo-escuro);
    text-align: center;
  }

  p {
    text-align: center;
    max-width: 600px;
    margin-bottom: 30px;
  }

  form {
    background-color: var(--menu);
    border: 3px solid var(--roxo);
    border-radius: 28px;
    padding: 40px 50px;
    width: 100%;
    max-width: 620px;
    box-shadow: 0 10px 30px rgba(155, 107, 194, 0.25);
    overflow: hidden;
  }

  label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
    color: var(--roxo-escuro);
  }

  select,
  input[type="text"] {
    margin-bottom: 25px;
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1.8px solid var(--roxo);
    font-size: 1rem;
    color: var(--texto);
    background-color: var(--bege);
    transition: 0.3s;
  }

  select:focus,
  input[type="text"]:focus {
    border-color: var(--roxo-escuro);
    box-shadow: 0 0 6px rgba(155, 107, 194, 0.4);
    outline: none;
  }

  .checkboxes {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin: 15px 0 30px 0;
  }

  .checkbox-item {
    display: flex;
    align-items: center;
    background-color: var(--hover);
    border: 1.8px solid var(--roxo);
    border-radius: 12px;
    padding: 12px 14px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .checkbox-item:hover {
    background-color: var(--bege);
    transform: scale(1.02);
  }

  .checkbox-item input {
    accent-color: var(--roxo);
    margin-right: 12px;
  }

  .btn-container {
    display: flex;
    justify-content: space-between;
    gap: 15px;
  }

  .btn {
    flex: 1;
    background: var(--degrade);
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 30px;
    font-size: 1rem;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
  }

  .btn:hover {
    transform: scale(1.04);
  }

  .alerta {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: var(--menu);
    border: 3px solid var(--roxo);
    border-radius: 25px;
    padding: 35px 25px;
    width: 90%;
    max-width: 440px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
  }

  .alerta.show {
    display: block;
    animation: fadeIn 0.5s forwards;
  }

  .fechar, .pular {
      border: none;
      padding: 10px 22px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      font-size: 0.95rem;
    }

    .fechar {
      background-color: var(--roxo);
      color: white;
    }

    .fechar:hover {
      background-color: var(--roxo-escuro);
      transform: scale(1.05);
    }

    .pular {
      background-color: var(--hover);
      color: var(--roxo-escuro);
    }

    .pular:hover {
      background-color: var(--bege);
      transform: scale(1.05);
    }

  @keyframes fadeIn {
    from { opacity: 0; transform: translate(-50%, -48%); }
    to { opacity: 1; transform: translate(-50%, -50%); }
  }

  .extra-form,
  .outro-input {
    opacity: 0;
    max-height: 0;
    overflow: hidden;
    transform: translateY(-10px);
    transition: all 0.4s ease;
  }

  .extra-form.show,
  .outro-input.show {
    opacity: 1;
    max-height: 200px;
    transform: translateY(0);
    margin-top: 10px;
    overflow: visible;
  }

  .extra-form select,
  #outroInput input[type="text"] {
    height: 47px;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1.8px solid var(--roxo);
    font-size: 1rem;
    color: var(--texto);
    background-color: var(--bege);
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 25px;
  }


form {
  background: rgba(255, 255, 255, 0.4); 
  backdrop-filter: blur(12px);
  border: 2px solid rgba(155, 107, 194, 0.3);
  border-radius: 20px;
  box-shadow: 0 25px 50px rgba(155, 107, 194, 0.25);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  padding: 30px;
}

form:hover {
  transform: translateY(-6px);
  box-shadow: 0 30px 60px rgba(155, 107, 194, 0.35);
}


body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: transparent;
}
/* Botão Voltar ao Site */
.btn-voltar {
  position: absolute;
  top: 25px;
  left: 35px;
  background: rgba(255, 255, 255, 0.3);
  color: var(--roxo-escuro);
  font-weight: 600;
  text-decoration: none;
  padding: 10px 18px;
  border-radius: 25px;
  border: 2px solid rgba(155, 107, 194, 0.4);
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
}

.btn-voltar:hover {
  background: rgba(155, 107, 194, 0.25);
  color: var(--roxo);
  transform: translateX(-4px);
}

/* Ajuste pro formulário flutuar sobre o fundo */
body {
  background: transparent; /* mostra o site de trás */
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

form {
  background: rgba(255, 255, 255, 0.4);
  backdrop-filter: blur(12px);
  border: 2px solid rgba(155, 107, 194, 0.3);
  border-radius: 20px;
  box-shadow: 0 25px 50px rgba(155, 107, 194, 0.25);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  padding: 30px;
  position: relative;
}

form:hover {
  transform: translateY(-6px);
  box-shadow: 0 30px 60px rgba(155, 107, 194, 0.35);
}

</style>
</head>
<body>

  <h1>Agenda</h1>
<!-- Botão Q Volta ao Site,  -->
<a href="index.html" class="btn-voltar">← Voltar ao site</a>

  <form id="formBemEstar">

      <td><label>Nome</label></td>
		  <td><input type = "text" name = "nome" required></td>
		</tr>
	    <tr>
		  <td><label>Telefone/WhatsApp:</label></td>
		  <td><input type = "text" name = "telefone" required></td>
		</tr>
		<tr>  
             <td><label>E-mail</label></td>
		  <td><input type = "text" name = "E-mail" required></td>
		</tr>
	    <tr>
      <label for="estado">Selecione seu Estado:</label><br>

<select id="estado" name="estado">
  <option value="">-- Escolha um Estado --</option>
  <option value="AC">Acre (AC)</option>
  <option value="AL">Alagoas (AL)</option>
  <option value="AP">Amapá (AP)</option>
  <option value="AM">Amazonas (AM)</option>
  <option value="BA">Bahia (BA)</option>
  <option value="CE">Ceará (CE)</option>
  <option value="DF">Distrito Federal (DF)</option>
  <option value="ES">Espírito Santo (ES)</option>
  <option value="GO">Goiás (GO)</option>
  <option value="MA">Maranhão (MA)</option>
  <option value="MT">Mato Grosso (MT)</option>
  <option value="MS">Mato Grosso do Sul (MS)</option>
  <option value="MG">Minas Gerais (MG)</option>
  <option value="PA">Pará (PA)</option>
  <option value="PB">Paraíba (PB)</option>
  <option value="PR">Paraná (PR)</option>
  <option value="PE">Pernambuco (PE)</option>
  <option value="PI">Piauí (PI)</option>
  <option value="RJ">Rio de Janeiro (RJ)</option>
  <option value="RN">Rio Grande do Norte (RN)</option>
  <option value="RS">Rio Grande do Sul (RS)</option>
  <option value="RO">Rondônia (RO)</option>
  <option value="RR">Roraima (RR)</option>
  <option value="SC">Santa Catarina (SC)</option>
  <option value="SP">São Paulo (SP)</option>
  <option value="SE">Sergipe (SE)</option>
  <option value="TO">Tocantins (TO)</option>
</select>


    <label>1. Você já realizou atendimento psicológico anteriormente?</label>
    <select id="diagnostico" required>
      <option value="">Selecione...</option>
      <option value="sim">Sim</option>
      <option value="nao">Não</option>
    </select>

    <label>2. Motivo principal para procurar atendimento:</label>
    <select required>
      <option value="">Selecione...</option>
      <option>Ansiedade</option>
      <option>Depressão</option>
      <option>Estresse</option>
      <option>Autoconhecimento</option>
      <option>Dificuldade no relacionamento</option>
      <option>Problemas familiares</option>
      <option>Transtornos alimentares</option>
      <option>Outro</option>
      <option>Mais de um motivo</option>
      <option></option>
    </select>

    <label>3. Você faz acompanhamento psicológico atualmente?</label>
    <select required>
      <option value="">Selecione...</option>
      <option>Sim, regularmente</option>
      <option>Às vezes</option>
      <option>Não</option>
    </select>

    <label>4. Você já teve crises de pânico ou pensamentos suicidas?</label>
    <select required>
      <option value="">Selecione...</option>
      <option>Sim</option>
      <option>Não</option>
    </select>

    <label>5.Dias disponíveis</label>
    <div class="checkboxes">
      <div class="checkbox-item"><input type="checkbox" id="segunda"><label for="familia">Segunda</label></div>
      <div class="checkbox-item"><input type="checkbox" id="terça"><label for="trabalho">Terça</label></div>
      <div class="checkbox-item"><input type="checkbox" id="quarta"><label for="relacionamentos">Quarta</label></div>
      <div class="checkbox-item"><input type="checkbox" id="quinta"><label for="saude">Quinta</label></div>
      <div class="checkbox-item"><input type="checkbox" id="sexta"><label for="autoestima">Sexta</label></div>
     <div class="checkbox-item"><input type="checkbox" id="sabado"><label for="autoestima">Sábado</label></div>
     <div class="checkbox-item"><input type="checkbox" id="domingo"><label for="autoestima">Domingo</label></div>
    </div>

    <label>6. Preferência de horário</label>
    <select required>
      <option value="">Selecione...</option>
      <option>Manhã</option>
      <option>Tarde</option>
      <option>Noite</option>
    </select>

    <div class="btn-container">
      <button type="button" class="btn" onclick="mostrarAlerta()">Pular formulário ❌</button>
      <button type="submit" class="btn" onclick="continuar(event)">Salvar e Continuar ➜</button>
    </div>
  </form>

  <div class="alerta" id="alerta">
    <h2>Atenção 💜</h2>
    <p>Este formulário é importante para agendar sua consulta com psicólogo.<br>
    <div class="alerta-btns">
      <button class="fechar" onclick="fecharAlerta()">Entendido</button>
      <button class="pular" onclick="irParaAtendimento()"></button>
      
      <script>
  // Salva o dark mode no navegador
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");

    // Se estiver ativo, salva "1". Se não, salva "0".
    if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("darkmode", "1");
    } else {
        localStorage.setItem("darkmode", "0");
    }
}

// Ao carregar qualquer página, aplica o darkmode salvo
document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("darkmode") === "1") {
        document.body.classList.add("dark-mode");
    }
});
</script>
 <script src="darkmode.js"></script>
 
</body>
</html>