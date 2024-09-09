var rows = 3;
var columns = 3;

var currTile;
var otherTile;

var turns = 0;

window.onload = function() {
    initializeBoard();
    initializePieces();
}
var placeSound = new Audio("./img/audio.mp3");
function initializeBoard() {
    //initialize the 5x5 board
    for (let r = 0; r < rows; r++) {
        for (let c = 0; c < columns; c++) {
            //<img>
            let tile = document.createElement("img");
            tile.src = "./images/blank.jpg";

            //DRAG FUNCTIONALITY
            tile.addEventListener("dragstart", dragStart); //click on image to drag
            tile.addEventListener("dragover", dragOver);   //drag an image
            tile.addEventListener("dragenter", dragEnter); //dragging an image into another one
            tile.addEventListener("dragleave", dragLeave); //dragging an image away from another one
            tile.addEventListener("drop", dragDrop);       //drop an image onto another one
            tile.addEventListener("dragend", dragEnd);      //after you completed dragDrop

            document.getElementById("board").append(tile);
        }
    }
}
function initializePieces() {
    let pieces = [];
    for (let i=1; i <= rows*columns; i++) {
        pieces.push(i.toString());
    }
    pieces.reverse();
    for (let i =0; i < pieces.length; i++) {
        let j = Math.floor(Math.random() * pieces.length);
        [pieces[i], pieces[j]] = [pieces[j], pieces[i]]; // Swap pieces
    }
       

    for (let i = 0; i < pieces.length; i++) {
        let tile = document.createElement("img");
        tile.src = `./images/img${pieces[i]}.jpg`;
        tile.id = `img${pieces[i]}`;

        //DRAG FUNCTIONALITY
        tile.addEventListener("dragstart", dragStart); //click on image to drag
        tile.addEventListener("dragover", dragOver);   //drag an image
        tile.addEventListener("dragenter", dragEnter); //dragging an image into another one
        tile.addEventListener("dragleave", dragLeave); //dragging an image away from another one
        tile.addEventListener("drop", dragDrop);       //drop an image onto another one
        tile.addEventListener("dragend", dragEnd);      //after you completed dragDrop

        document.getElementById("pieces").append(tile);
    }
}

//DRAG TILES
function dragStart() {
    currTile = this; //this refers to image that was clicked on for dragging
    console.log("Drag Start:", currTile.src);
}

function dragOver(e) {
    e.preventDefault();
}

function dragEnter(e) {
    e.preventDefault();
}

function dragLeave() {

}

function dragDrop() {
    otherTile = this; //this refers to image that is being dropped on
    console.log("Drag Drop:", otherTile.src);
}

function dragEnd() {
    if (currTile.src.includes("blank")) {
        return;
    }
    let currImg = currTile.src;
    let otherImg = otherTile.src;
    currTile.src = otherImg;
    otherTile.src = currImg;

    turns += 1;
    document.getElementById("turns").innerText = turns;
    // Play the place sound
    placeSound.play();
// Check the solution after every move
checkSolution();
}

function checkSolution() {
    let isSolved = true;
    for (let r = 0; r < rows; r++) {
        for (let c = 0; c < columns; c++) {
            let tile = document.querySelector(`#board img:nth-child(${r * columns + c + 1})`);
            let expectedId = `img${r * columns + c + 1}`;
            
            if (!tile.src.includes(expectedId)) {
                isSolved = false;
                break;
            }
        }
    }

    let messageElement = document.getElementById("message");
    if (isSolved) {
        messageElement.innerText = "Congrats! You have solved the puzzle.";
        document.getElementById("level2Btn").style.display = "block";
        // Optional: Automatically proceed to the next level after a delay
        setTimeout(nextLevel, 2000);
    } else {
        messageElement.innerText = "Keep trying!";
    }
}

function nextLevel() {
    alert("Proceeding to Level 2!");
    window.location.href = "level2.html";
    // Logic for proceeding to level 2
}
function quitGame() {
    window.location.href = 'index.html'; // Redirect to index.html
}