		<input value="<?php echo $block["title"]; ?>" id="blocktitle"/>

		<div id="editdiv">
			<label>Nombre de colonnes et lignes : </label><input type="number" id="colnuminput" onchange="actualiseBlockInfo()" value="<?php echo $block['cols'];?>"/>
			<label>Couleur d'arrière plan : </label><input type="color"id="backinput" onchange="actualiseBlockInfo()" value="<?php echo $block['back'];?>"/><label id="colorlabel"></label>
			<label>Appliquer la couleur : </label><input type="color" onchange="actualiseChoice()" id="colinput" />
			<label>Appliquer la transparence : </label><input type="range" onchange="actualiseChoice()" id="alphainput" min="0" max="255" value="255"/><label id="zonecolorlabel"></label>
			<label>On peut marcher dessus : </label><input type="checkbox" onclick="actualiseBlockInfo();" id="walkbox" <?php if($block["canbewalked"]) {echo "checked";};?>/>
		</div>
		<button onclick="save()">Sauvegarder le block</button>
		<table id="maintable" class="mapedit" onclick="pencilDown=!pencilDown;actualiseText();" onmouseleave="pencilDown = false;actualiseText();">
		</table>
		<p id="infotext">Le mode balayage est désactivé</p>
		<canvas id="mainmapzone4" width="200px" height="200px">Prévisualisation indisponible</canvas>
		<canvas id="mainmapzone3" width="100px" height="100px">Prévisualisation indisponible</canvas>
		<canvas id="mainmapzone2" width="60px" height="60px">Prévisualisation indisponible</canvas>
		<canvas id="mainmapzone1" width="30px" height="30px">Prévisualisation indisponible</canvas>

		<script>

function actualiseText() {
	document.getElementById("infotext").textContent = "Le mode balayage est "+(pencilDown?"activé":"désactivé");
}

function getColor(color) {
	return "#" + color.toString(16).padStart(4, '0');
};

var pencilDown = false;
var lastblock = null;

function actualiseBlockInfo() {
	mainblock.background=document.getElementById("backinput").value;
	mainblock.colnum=document.getElementById("colnuminput").value;
	mainblock.walkable = document.getElementById("walkbox").checked;
	var maintable = document.getElementById("maintable");
	maintable.innerHTML = "";
	maintable.setAttribute("style", "--back:"+mainblock.background);
	for (i=0;i<mainblock.colnum;i++) {
		var tr = document.createElement("tr");
		maintable.appendChild(tr);
		for (j=0;j<mainblock.colnum;j++) {
			var td = document.createElement("td");
			tr.appendChild(td);
			td.setAttribute("style", "--back:"+mainblock.colorAt(i*mainblock.colnum+j));
			td.setAttribute("title", mainblock.colorAt(i*mainblock.colnum+j))
			td.setAttribute("onclick", "attributeclr(event, this, true)");
			td.id=i*mainblock.colnum+j;
			td.setAttribute("onmouseenter", "attributeclr(event, this)");
		}
	}
	document.getElementById("mainmapzone1").getContext("2d").clearRect(0, 0, document.getElementById("mainmapzone1").width, document.getElementById("mainmapzone1").height);
	mainblock.draw(5,5,20,20, document.getElementById("mainmapzone1"));
	document.getElementById("mainmapzone2").getContext("2d").clearRect(0, 0, document.getElementById("mainmapzone2").width, document.getElementById("mainmapzone2").height);
	mainblock.draw(5,5,50,50, document.getElementById("mainmapzone2"));
	document.getElementById("mainmapzone3").getContext("2d").clearRect(0, 0, document.getElementById("mainmapzone3").width, document.getElementById("mainmapzone3").height);
	mainblock.draw(5,5,90,90, document.getElementById("mainmapzone3"));
	document.getElementById("mainmapzone4").getContext("2d").clearRect(0, 0, document.getElementById("mainmapzone4").width, document.getElementById("mainmapzone4").height);
	mainblock.draw(5,5,190,190, document.getElementById("mainmapzone4"));
	var label = document.getElementById("colorlabel");
	label.textContent=mainblock.background;
}

requestAnimationFrame(actualiseChoice);

function actualiseChoice() {
	var label = document.getElementById("zonecolorlabel");
	var clr=document.getElementById("colinput").value;
	label.textContent=clr+parseInt(document.getElementById("alphainput").value).toString(16).padStart(2, "0");
//	setTimeout(actualiseBlockInfo, 1000);
}

function attributeclr(event, square, direct=false) {
	event.preventDefault();
	if ((pencilDown || direct)&&lastblock!=square.id) {
		var clr=document.getElementById("colinput").value;
		mainblock.setDataAt(square.id, parseInt(clr.substring(1)+parseInt(document.getElementById("alphainput").value).toString(16).padStart(2, "0"), 16))
		actualiseBlockInfo();
		lastblock = square.id;
	}
}

class Block {
	#data;
	#id;
	background;
	#colnum;
	walkable;
	constructor(id, colnum, background, data, iswalkable) {
		this.#id = id;
		this.#colnum = colnum;
		this.background = background;
		this.#data = data.split("x");
		while (this.#data.length<=colnum) {
			this.#data.push("0");
		}
		for (var i=0;i<this.#data.length;i++) {this.#data[i]=parseInt(this.#data[i], 16);}
		this.walkable = iswalkable;
	}

	get data() {
		var result="";
		for(var i=0;i<this.#data.length;i++) {
			if (i) {result+="x"};
			result+=this.#data[i].toString(16);
		}
		return result;
	}

	get id() {
		return this.#id;
	}

	colorAt(pos) {
		return "#" + this.#data[parseInt(pos)].toString(16).padStart(8, '0');
	}

	get colnum() {
		return this.#colnum;
	}

	set colnum(value) {
		while (this.#data.length<=value**2) {
			this.#data.push(0);
		}
		this.#colnum=value;
	}

	setDataAt(pos, value) {
		this.#data[pos] = value;
	}

	draw (x, y, w, h, canvas) {
		var ctx = canvas.getContext('2d');
		ctx.fillStyle = this.background;
		ctx.fillRect(x, y, w, h);
		for (var i=0;i<this.#colnum**2;i++) {
			ctx.fillStyle = "#"+this.#data[parseInt(i)].toString(16).padStart(8, '0');
			ctx.fillRect(x+(i%this.#colnum)*(w/this.#colnum), y+Math.floor(i/this.#colnum)*(h/this.#colnum), w/this.#colnum, h/this.#colnum);
		}
	}

}

var mainblock = new Block(<?php echo $block['id']?>, <?php echo $block['cols']?>, "<?php echo $block['back']?>", <?php echo var_export($block['data'], true)?>, <?php echo $block['canbewalked']?>);

requestAnimationFrame(actualiseBlockInfo);

function callScript(scriptname, scriptrequests, onload) {
	var script = new XMLHttpRequest();
	var formData = new FormData();
	for (var i=0;i<Object.keys(scriptrequests).length;i++) {
		formData.append(Object.keys(scriptrequests)[i], scriptrequests[Object.keys(scriptrequests)[i]]);
	}
	script.open("POST", "./actions/"+scriptname+".php", true);
	script.send(formData);
	script.overrideMimeType("text/plain; charset=x-user-defined");
	script.onload = onload;
}

function save() {
	actualiseBlockInfo;
	callScript("save", {"saveblock":mainblock.id, "blockdata":mainblock.data, "blockcols":mainblock.colnum, "blockback":mainblock.background, "blockcanbewalked":mainblock.walkable?1:0, "blocktitle":document.getElementById("blocktitle").value}, onSaveReturn);
}

function onSaveReturn() {
	responseCode = parseInt(this.response[0]);
	responseInformation = this.response.substring(1);
	console.log(responseInformation);
	if (responseCode===0) {
		alert("Veuillez réessayer ("+responseInformation+")");
	}
	else if (responseCode===1) {
		alert("Enregistrement effectué avec succès");
	}
	else {
		alert("Une erreur s'est produite ("+responseInformation+")");
	}
}

		</script>
	<a href='./' style='bottom:0;position:fixed'>Retour</a>
