// 2048 Game Logic
const boardElement = document.getElementById('board');
const scoreElement = document.getElementById('score');
const bestScoreElement = document.getElementById('bestScore');
const newGameBtn = document.getElementById('newGameBtn');
const gameMessage = document.getElementById('gameMessage');
const messageBox = document.getElementById('messageBox');
const messageTitle = document.getElementById('messageTitle');
const messageText = document.getElementById('messageText');

const gridSize = 4;
let board = [];
let score = 0;
let bestScore = localStorage.getItem('2048BestScore') || 0;
let gameWon = false;

bestScoreElement.textContent = bestScore;

// Colors for tiles
const tileColors = {
    2: '#eee4da',
    4: '#ede0c8',
    8: '#f2b179',
    16: '#f59563',
    32: '#f67c5f',
    64: '#f65e3b',
    128: '#edcf72',
    256: '#edcc61',
    512: '#edc850',
    1024: '#edc53f',
    2048: '#edc22e',
    4096: '#3c3a32',
    8192: '#3c3a32'
};

// Initialize game
function initGame() {
    board = Array(gridSize).fill(null).map(() => Array(gridSize).fill(0));
    score = 0;
    gameWon = false;
    scoreElement.textContent = '0';
    gameMessage.classList.add('hidden');

    addNewTile();
    addNewTile();
    renderBoard();
}

// Render board
function renderBoard() {
    const gridContainer = boardElement.querySelector('.grid');
    gridContainer.innerHTML = '';

    for (let i = 0; i < gridSize; i++) {
        for (let j = 0; j < gridSize; j++) {
            const tile = document.createElement('div');
            const value = board[i][j];

            tile.className = 'tile w-24 h-24 rounded-lg flex items-center justify-center font-bold text-2xl transition-all duration-200';

            if (value === 0) {
                tile.style.backgroundColor = '#cdc1b4';
                tile.style.color = 'transparent';
            } else {
                tile.style.backgroundColor = tileColors[value] || '#3c3a32';
                tile.style.color = value > 4 ? '#f9f6f2' : '#776e65';
                tile.textContent = value;
                tile.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)';
            }

            gridContainer.appendChild(tile);
        }
    }
}

// Add new tile
function addNewTile() {
    const emptyCells = [];

    for (let i = 0; i < gridSize; i++) {
        for (let j = 0; j < gridSize; j++) {
            if (board[i][j] === 0) {
                emptyCells.push({ i, j });
            }
        }
    }

    if (emptyCells.length > 0) {
        const { i, j } = emptyCells[Math.floor(Math.random() * emptyCells.length)];
        board[i][j] = Math.random() < 0.9 ? 2 : 4;
    }
}

// Move tiles
function move(direction) {
    let moved = false;
    const oldBoard = board.map(row => [...row]);

    if (direction === 'left' || direction === 'right') {
        for (let i = 0; i < gridSize; i++) {
            const row = direction === 'left' ? board[i] : board[i].reverse();
            const newRow = slideAndMerge(row);
            board[i] = direction === 'left' ? newRow : newRow.reverse();
        }
    } else {
        for (let j = 0; j < gridSize; j++) {
            const column = [];
            for (let i = 0; i < gridSize; i++) {
                column.push(board[i][j]);
            }

            const newColumn = direction === 'up' ? slideAndMerge(column) : slideAndMerge(column.reverse()).reverse();

            for (let i = 0; i < gridSize; i++) {
                board[i][j] = newColumn[i];
            }
        }
    }

    // Check if board changed
    for (let i = 0; i < gridSize; i++) {
        for (let j = 0; j < gridSize; j++) {
            if (oldBoard[i][j] !== board[i][j]) {
                moved = true;
                break;
            }
        }
        if (moved) break;
    }

    if (moved) {
        addNewTile();
        renderBoard();

        if (score > bestScore) {
            bestScore = score;
            bestScoreElement.textContent = bestScore;
            localStorage.setItem('2048BestScore', bestScore);
        }

        checkWin();
        checkGameOver();
    }
}

// Slide and merge row/column
function slideAndMerge(line) {
    // Remove zeros
    let newLine = line.filter(val => val !== 0);

    // Merge adjacent equal values
    for (let i = 0; i < newLine.length - 1; i++) {
        if (newLine[i] === newLine[i + 1]) {
            newLine[i] *= 2;
            score += newLine[i];
            scoreElement.textContent = score;
            newLine.splice(i + 1, 1);
        }
    }

    // Add zeros to the end
    while (newLine.length < gridSize) {
        newLine.push(0);
    }

    return newLine;
}

// Check win condition
function checkWin() {
    if (gameWon) return;

    for (let i = 0; i < gridSize; i++) {
        for (let j = 0; j < gridSize; j++) {
            if (board[i][j] === 2048) {
                gameWon = true;
                showMessage('success', '🎉 Vous avez gagné !', 'Vous avez atteint 2048 ! Continuez pour un score encore plus élevé.');
                return;
            }
        }
    }
}

// Check game over
function checkGameOver() {
    // Check for empty cells
    for (let i = 0; i < gridSize; i++) {
        for (let j = 0; j < gridSize; j++) {
            if (board[i][j] === 0) return;
        }
    }

    // Check for possible merges
    for (let i = 0; i < gridSize; i++) {
        for (let j = 0; j < gridSize; j++) {
            const current = board[i][j];
            if (j < gridSize - 1 && current === board[i][j + 1]) return;
            if (i < gridSize - 1 && current === board[i + 1][j]) return;
        }
    }

    // Game over
    showMessage('error', '😢 Game Over !', `Score final: ${score}. Essayez de battre votre record !`);
}

// Show message
function showMessage(type, title, text) {
    messageTitle.textContent = title;
    messageText.textContent = text;

    if (type === 'success') {
        messageBox.className = 'bg-green-100 border-2 border-green-400 text-green-700 px-4 py-3 rounded-lg text-center';
    } else {
        messageBox.className = 'bg-red-100 border-2 border-red-400 text-red-700 px-4 py-3 rounded-lg text-center';
    }

    gameMessage.classList.remove('hidden');
}

// Keyboard controls
document.addEventListener('keydown', (e) => {
    if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
        e.preventDefault();

        switch (e.key) {
            case 'ArrowUp':
                move('up');
                break;
            case 'ArrowDown':
                move('down');
                break;
            case 'ArrowLeft':
                move('left');
                break;
            case 'ArrowRight':
                move('right');
                break;
        }
    }
});

// New game button
newGameBtn.addEventListener('click', initGame);

// Initialize grid structure
if (!boardElement.querySelector('.grid')) {
    const grid = document.createElement('div');
    grid.className = 'grid grid-cols-4 gap-4';
    boardElement.innerHTML = '';
    boardElement.appendChild(grid);
}

// Start game
initGame();
