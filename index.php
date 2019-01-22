<DOCTYPE !HTML>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
  </head>
  <body>
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/p5.js"></script>
  <script type="text/javascript">
  function drawMatrix() {
  var input = $('#input')[0].value;
  var inputArray = input.split(", ");
  console.log(inputArray);
  var directions = input[3];
  var dims = input[0];
  var xInit = input[1];
  var yInit = input[2];
  setup();
  var index = 0;
  var w;
  var columns;
  var rows;
  var canvas;
  var coordX = xInit;
  var coordY = yInit;
  var widthW = window.innerWidth - 5;
  var heightW = window.innerHeight - 5;

  $(window).resize(function(){location.reload();});

  function setup() {
    createCanvas(widthW, heightW);
    // Calculate columns and rows for fullscreen square grid
    if (width > height) {
      w = height/dims;
      columns = floor(height/w);
      rows = floor(height/w);
    } else {
      w = width/dims;
      columns = floor(width/w);
      rows = floor(width/w);
    }
    // Initial a 2D array
    canvas = new Array(columns);
    for (var i = 0; i < columns; i++) {
      canvas[i] = new Array(rows);
    } 
    console.log(canvas, columns, rows);
    init();
  }
  function draw() {
    background(255);
    for (var i=0;i<columns;i++) {
      for (var j=0;j<rows;j++) {
	if ((canvas[i][j] == 1)) {
	  fill(0);
	  rect(i*w, j*w, w-1, w-1);
	  coordX = j;
	  coordY = i;
	  fill(255);
	  textSize(w/5);
	  text(coordX + ", " + coordY, i*w+w/1.75, j*w+w/1.75);
	} else {
	  fill(255); 
          stroke(0);
          rect(i*w, j*w, w-1, w-1);
        }  
      }
    }
  }
  // reset canvas when mouse is pressed
  function mousePressed() {
    init();
  }
  function moveBox() {
    var dirArray = directions.split("");
    for (var h=index;h<dirArray.length;h++) {
      for (var i=0;i<columns;i++) {
        for (var j=0;j<rows;j++) {
          if (canvas[i][j] === 1) {
            canvas[i][j] = 0;
 	    if (keyCode === LEFT_ARROW  || dirArray[h] === "L") {
              if (i == 0) {
                index++;      
		return canvas[columns-1][j] = 1;
	      } else {
	        index++;
		return canvas[i-1][j] = 1;
              }
            } else if (keyCode === RIGHT_ARROW || dirArray[h] === "R") {
	      if (i == columns-1) {
                index++;
                return canvas[0][j] = 1;
	      } else {
		index++;     
	        return canvas[i+1][j] = 1;
	      }
	    } else if (keyCode === DOWN_ARROW || dirArray[h] === "D") {
              if (j == rows-1) {
                index++;
		return canvas[i][j] = 1;
	      } else {
		index++;
	        return canvas[i][j+1] = 1;
	      }
	    } else if (keyCode === UP_ARROW || dirArray[h] === "U") {
              if (j == 0) {
                return canvas[i][j] = 1;
	      } else {
                return canvas[i][j-1] = 1;
	      }
	    }
	  }
        }
      }
    }
  }
  function keyPressed() {
    for (var i=0;i<columns;i++) {
      for (var j=0;j<rows;j++) {
        if (canvas[i][j] === 1) {
          canvas[i][j] = 0;
 	  if (keyCode === LEFT_ARROW) {
            if (i == 0) {
	      return canvas[columns-1][j] = 1;
	    } else {
              return canvas[i-1][j] = 1;
            }
          } else if (keyCode === RIGHT_ARROW) {
	    if (i == columns-1) {
              return canvas[0][j] = 1;
	    } else {
	      return canvas[i+1][j] = 1;
	    }
	  } else if (keyCode === DOWN_ARROW) {
            if (j == rows-1) {
	      return canvas[i][j] = 1;
	    } else {
	      return canvas[i][j+1] = 1;
	    }
	  } else if (keyCode === UP_ARROW) {
            if (j == 0) {
              return canvas[i][j] = 1;
	    } else {
              return canvas[i][j-1] = 1;
	    }
	  }
	}
      }
    }
  }
  // Fill canvas at origin
  function init() {
    for (var i=0;i<columns;i++) {
      for (var j=0;j<rows;j++) {
        // Fill origin cell
	if (i == xInit && j == yInit) {
          console.log('origin found');
	  canvas[i][j] = 1;
	}
        // Empty the rest
	else {
	  canvas[i][j] = 0;
        }  
      }
    }
    moveBox(); 
  }
  }
  </script>
  <input id="input">
  <button type="button" onclick="drawMatrix()">Submit</button>
  </body>
</html>
