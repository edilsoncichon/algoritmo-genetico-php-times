var doc = document;

window.onload = function () {

	doc.getElementById('start').onclick = function () {
		this.setAttribute("disabled", "");
		var urlServer = 'http://' + window.location.hostname + window.location.pathname;
		var urlApi = urlServer + 'domain/calculo.php';
		var qtdJog = doc.getElementsByName('qtdJogadores')[0].value;
		requisitar(urlApi + '?qtdJogadores=' + qtdJog);
	}
}

	function carregar(elemento) {
		while (elemento.hasChildNodes())
			elemento.removeChild(elemento.lastChild);

		var img = doc.createElement("img");
		var br = doc.createElement("br");
		var mensagem = doc.createElement("strong");
		mensagem.innerHTML = 'O algoritmo está processando...';
		img.setAttribute("src", "view/img/ajaxLoad.gif");
		elemento.appendChild(img);
		elemento.appendChild(br);
		elemento.appendChild(mensagem);
	}

	function mostrar(ajax, loading) {
		while (loading.hasChildNodes())
			loading.removeChild(loading.lastChild);
		var jsonResposta = JSON.parse(ajax.responseText);

		console.log(jsonResposta);

		if (jsonResposta.hasOwnProperty('erro')) {
			response.appendChild(doc.createTextNode(jsonResposta.erro));
		} 
		else {
			doc.getElementById('nota').innerHTML = jsonResposta.nota;
			//FORMAÇÃO DO JOGADORES.
			var jogs = jsonResposta.jogadores;
			doc.getElementById('goleiro').innerHTML = jogs[0];
			doc.getElementById('zagueiro').innerHTML = jogs[1];
			doc.getElementById('zagueiro2').innerHTML = jogs[2];
			doc.getElementById('lateral').innerHTML = jogs[3];
			doc.getElementById('lateral2').innerHTML = jogs[4];
			doc.getElementById('volante').innerHTML = jogs[5];
			doc.getElementById('volante2').innerHTML = jogs[6];
			doc.getElementById('meia').innerHTML = jogs[7];
			doc.getElementById('meia2').innerHTML = jogs[8];
			doc.getElementById('atacante').innerHTML = jogs[9];
			doc.getElementById('atacante2').innerHTML = jogs[10];

			doc.getElementById('tempo').innerHTML = jsonResposta.tempoProcessamento + ' segundos';
			doc.getElementById("start").removeAttribute("disabled");
			doc.getElementById("resultado").removeAttribute('style');
		}
	}

	function requisitar(url) {
		var ajax = initAjax();
		var response = doc.getElementById("resultado");
		var loading = doc.getElementById("loading");
		carregar(loading);
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4) {
				mostrar(ajax, loading);
			}
		}
		ajax.open('GET', url);
		ajax.send();
		return false;
	}

	function initAjax() {
		var ajax = null;
		if (window.XMLHttpRequest)
			ajax = new XMLHttpRequest();
		else if (window.ActiveXObject)
			try {
				ajax = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			return ajax;
	}
