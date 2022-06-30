<canvas
	id="mainmapzone"
	mapcolumns="<?php echo $map['mapcols']?>"
	mapobjsize="<?php echo $map['objsize']?>"
	mapspeed="<?php echo $map['deplaspeed']?>"
	map="<?php echo $map['map-data'].str_repeat("0",strlen($map['map-data'])%$map['mapcols']?($map['mapcols']-strlen($map['map-data'])%$map['mapcols']):0)?>"
	mapposx="<?php echo $map['departblockx']*$map['objsize']?>"
	mapposy="<?php echo $map['departblocky']*$map['objsize']?>"
	width="100%"></canvas>
<script>

if(Array.prototype.equals)
    console.warn("Overriding existing Array.prototype.equals. Possible causes: New API defines the method, there's a framework conflict or you've got double inclusions in your code.");
// attach the .equals method to Array's prototype to call it on any array
Array.prototype.equals = function (array) {
    // if the other array is a falsy value, return
    if (!array)
        return false;

    // compare lengths - can save a lot of time
    if (this.length != array.length)
        return false;

    for (var i = 0, l=this.length; i < l; i++) {
        // Check if we have nested arrays
        if (this[i] instanceof Array && array[i] instanceof Array) {
            // recurse into the nested arrays
            if (!this[i].equals(array[i]))
                return false;
        }
        else if (this[i] != array[i]) {
            // Warning - two different object instances will never be equal: {x:20} != {x:20}
            return false;
        }
    }
    return true;
}
// Hide method from for-in loops
Object.defineProperty(Array.prototype, "equals", {enumerable: false});

const canvas = document.getElementById("mainmapzone");
var map=[];
for (var i=0;i<canvas.getAttribute("map").length;i++) {
	map.push(canvas.getAttribute("map").charCodeAt(i)-0x30);
};
var mapcols=parseInt(canvas.getAttribute("mapcolumns"));
var mapsize=parseInt(canvas.getAttribute("mapobjsize"));
var mapspeed=parseInt(canvas.getAttribute("mapspeed"));
var dx = dy = 0;
var posx = parseInt(canvas.getAttribute("mapposx"));
var posy = parseInt(canvas.getAttribute("mapposy"));

var BLOCKS = {};

function getColor(color) {
	return "#" + color.toString(16).padStart(4, '0');
}
class Block {
	#colnum;
	#background;
	#walkable;
	#image;
	#missed;
	#load;
	constructor(id, colnum, background, iswalkable) {
		this.#missed = [];
		BLOCKS[id-1]=this;
		this.#colnum = colnum;
		this.#background = background;
		var base_image = new Image();
		base_image.src = '<?php echo $CONF["pathname"]; ?>/imagesapi/imagecreator.php?dims='+mapsize+'&blockid='+parseInt(id);
		this.#image=base_image;
		this.#walkable = iswalkable;
		this.#load=false;
		this.#image.obj=this;
		this.#image.onload = function () {this.obj.actualisemissed();}
	}

	get isWalkable() {
		return this.#walkable;
	}

	draw (x, y) {
		if (this.#load) {
			var ctx = canvas.getContext('2d');
			ctx.drawImage(this.#image, x, y);
		}
		else {
			this.#missed.push([x, y]);
		}
	}

	actualisemissed () {
		this.#load=true;
		for (var i=0;i<this.#missed.length;i++) {
			var ctx = canvas.getContext('2d');
			ctx.drawImage(this.#image, this.#missed[i][0], this.#missed[i][1]);
		}

	}

}

<?php

foreach (sendrequest("SELECT * FROM blocks", true) as $block) {
	echo "new Block({$block['id']}, {$block['colnum']}, '{$block['background']}', '".(bool)$block['canbewalked']."');\n";
}

?>

var actualkeys=[];
var mapspeed;

function draw_object(obj, x, y) {
	obj.draw(x*mapsize+dx, y*mapsize+dy);
}

function draw_pers(x, y, w, h, col) {
	var ctx = canvas.getContext('2d');
	ctx.fillStyle = col;
	ctx.fillRect(x+dx, y+dy, w, h);
}

function getObjectAt(x,y){
	if (x<0 || y<0 || x>=mapcols){return undefined;}
	if (map.length>x+y*mapcols) {
		return BLOCKS[map[x+y*mapcols]];
	}
	return undefined;
}

function setObjectAt(x,y,obj) {map[x+y*mapcols]=obj;}

function screenToCoord(x,y) {
	return [Math.floor((x-dx)/mapsize),Math.floor((y-dy)/mapsize)];
}

function coordToScreen(x,y) {
	return [x*mapsize+dx,y*mapsize+dy];
}

function showMap() {
	canvas.width = canvas.parentElement.clientWidth;
	canvas.height = canvas.parentElement.clientHeight;
	var ctx = canvas.getContext('2d');
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	for (var i=0;i*mapsize<=canvas.height+mapsize;i++) {
		for (var j=0;j*mapsize<=canvas.width+mapsize;j++) {
			b = screenToCoord(0,0);
			if (getObjectAt(j+b[0], i+b[1])) {draw_object(getObjectAt(j+b[0], i+b[1]), j+b[0], i+b[1]);}
		}
	}
	draw_pers(posx, posy, mapsize/3, mapsize/3, "#ff0000");
}

function keydown(key) {
	return actualkeys.includes(key);
}

function mainMvmnt() {
	if (keydown("ArrowLeft")) {
		s1 = screenToCoord(posx-mapspeed+dx,posy+dy);
		s2 = screenToCoord(posx-mapspeed+dx,posy+mapsize/3-1+dy);
		if (getObjectAt(s1[0], s1[1]) && getObjectAt(s2[0], s2[1])) {
			if (getObjectAt(s1[0], s1[1]).isWalkable && getObjectAt(s2[0], s2[1]).isWalkable) {
				posx-=mapspeed;
			}
			else {
				posx=Math.floor(posx/mapsize)*mapsize;
			}
		}
		else {
			posx=Math.floor(posx/mapsize)*mapsize;
		}
	}
	if (keydown("ArrowRight")) {
		s1 = screenToCoord(posx+mapspeed+mapsize/3-1+dx,posy+dy);
		s2 = screenToCoord(posx+mapspeed+mapsize/3-1+dx,posy+mapsize/3-1+dy);
		if (getObjectAt(s1[0], s1[1]) && getObjectAt(s2[0], s2[1])) {
			if (getObjectAt(s1[0], s1[1]).isWalkable && getObjectAt(s2[0], s2[1]).isWalkable) {
				posx+=mapspeed;
			}
			else {
				posx=(Math.floor(posx/mapsize)+1)*mapsize-mapsize/3;
			}
		}
		else {
			posx=(Math.floor(posx/mapsize)+1)*mapsize-mapsize/3;
		}
	}
	if (keydown("ArrowUp")) {
		s1 = screenToCoord(posx+dx,posy-mapspeed+dy);
		s2 = screenToCoord(posx+mapsize/3-1+dx,posy-mapspeed+dy);
		if (getObjectAt(s1[0], s1[1]) && getObjectAt(s2[0], s2[1])) {
			if (getObjectAt(s1[0], s1[1]).isWalkable && getObjectAt(s2[0], s2[1]).isWalkable) {
				posy-=mapspeed;
			}
			else {
				posy=Math.floor(posy/mapsize)*mapsize;
			}
		}
		else {
			posy=Math.floor(posy/mapsize)*mapsize;
		}
	}
	if (keydown("ArrowDown") && posy+mapsize/3<Math.floor(map.length/mapcols)*mapsize) {
		s1 = screenToCoord(posx+dx,posy+mapspeed+mapsize/3-1+dy);
		s2 = screenToCoord(posx+mapsize/3-1+dx,posy+mapspeed+mapsize/3-1+dy);
		if (getObjectAt(s1[0], s1[1]) && getObjectAt(s2[0], s2[1])) {
			if (getObjectAt(s1[0], s1[1]).isWalkable && getObjectAt(s2[0], s2[1]).isWalkable) {
				posy+=mapspeed;
			}
			else {
				posy=(Math.floor(posy/mapsize)+1)*mapsize-mapsize/3;
			}
		}
		else {
			posy=(Math.floor(posy/mapsize)+1)*mapsize-mapsize/3;
		}
	}

	var d1 = [dx, dy];

	if (posx<0) {posx=0;}
	if (posy<0) {posy=0;}
	if (posx+mapsize/3>mapcols*mapsize) {posx=mapcols*mapsize-mapsize/3;}
	if (posy+mapsize/3>(Math.floor(map.length/mapcols)+(map.length%mapcols?1:0))*mapsize) {posy=(Math.floor(map.length/mapcols)+(map.length%mapcols?1:0))*mapsize-mapsize/3;}

	if (posx+dx<mapsize*2) {dx=-posx+mapsize*2;}
	if (posy+dy<mapsize*2) {dy=-posy+mapsize*2;}
	if (posx+dx>canvas.width-mapsize*2) {dx=-posx+canvas.width-mapsize*2;}
	if (posy+dy>canvas.height-mapsize*2) {dy=-posy+canvas.height-mapsize*2;}

	if (dx<=-mapcols*mapsize+canvas.width) {dx=-mapcols*mapsize+canvas.width;}
	if (dy<=-(Math.floor(map.length/mapcols)+(map.length%mapcols?1:0))*mapsize+canvas.height) {dy=-(Math.floor(map.length/mapcols)+(map.length%mapcols?1:0))*mapsize+canvas.height;}
	if (dx>=0) {dx=0;}
	if (dy>=0) {dy=0;}

	if (d1.equals([dx, dy])===false) {
		showMap();
	}

	var ctx = canvas.getContext('2d');
	for (var i=-1;i<2;i++) {
		for (var j=-1;j<2;j++) {
			b = coordToScreen(posx/mapsize,posy/mapsize);
			b = screenToCoord(b[0],b[1]);
			if (getObjectAt(j+b[0], i+b[1])) {
				draw_object(getObjectAt(j+b[0], i+b[1]), j+b[0], i+b[1]);
			}
		}
	}
	draw_pers(posx, posy, mapsize/3, mapsize/3, "#ff0000");

	requestAnimationFrame(mainMvmnt);
}

setTimeout(mainMvmnt, 500);
setTimeout(showMap, 100);

window.onkeydown=function(event) {if (!keydown(event.key)) {actualkeys.push(event.key);}}
window.onkeyup=function(event) {actualkeys.shift(event.key);}

</script>
