// Tic-Tac-Toe Game Logic
const board = document.getElementById('board');
const gameStatus = document.getElementById('gameStatus');
const gameResult = document.getElementById('gameResult');
const resetBtn = document.getElementById('resetBtn');
const playerWinsElement = document.getElementById('playerWins');
const computerWinsElement = document.getElementById('computerWins');
const drawsElement = document.getElementById('draws');

let cells = [];
let currentPlayer = 'X';
let gameActive = true;
let boardState = ['', '', '', '', '', '', '', '', ''];

let stats = {
    playerWins: 0,
    computerWins: 0,
    draws: 0
};

// Load stats from localStorage
const savedStats = localStorage.getItem('tictactoeStats');
if (savedStats) {
    stats = JSON.parse(savedStats);
    updateStatsDisplay();
}

// Initialize board
function initBoard() {
    board.innerHTML = '';
    cells = [];
    boardState = ['', '', '', '', '', '', '', '', ''];
    currentPlayer = 'X';
    gameActive = true;
    gameStatus.textContent = 'Votre tour (X)';
    gameResult.classList.add('hidden');

    for (let i = 0; i < 9; i++) {
        const cell = document.createElement('div');
        cell.className = 'bg-white rounded-lg shadow-md flex items-center justify-center text-5xl font-bold cursor-pointer hover:bg-indigo-50 transition-all h-32 border-2 border-gray-200';
        cell.dataset.index = i;
        cell.addEventListener('click', handleCellClick);
        board.appendChild(cell);
        cells.push(cell);
    }
}

// Handle cell click
function handleCellClick(e) {
    const index = e.target.dataset.index;

    if (!gameActive || boardState[index] !== '' || currentPlayer !== 'X') {
        return;
    }

    makeMove(index, 'X');

    if (gameActive) {
        setTimeout(computerMove, 500);
    }
}

// Make a move
function makeMove(index, player) {
    boardState[index] = player;
    cells[index].textContent = player;
    cells[index].classList.add(player === 'X' ? 'text-indigo-600' : 'text-red-600');
    cells[index].classList.remove('cursor-pointer', 'hover:bg-indigo-50');

    if (checkWinner(player)) {
        endGame(player);
    } else if (boardState.every(cell => cell !== '')) {
        endGame('draw');
    } else {
        currentPlayer = player === 'X' ? 'O' : 'X';
        gameStatus.textContent = currentPlayer === 'X' ? 'Votre tour (X)' : 'Tour de l\'ordinateur (O)';
    }
}

// Computer move with minimax algorithm
function computerMove() {
    if (!gameActive) return;

    gameStatus.textContent = 'Tour de l\'ordinateur (O)...';

    const bestMove = findBestMove();
    makeMove(bestMove, 'O');
}

// Minimax algorithm
function minimax(board, depth, isMaximizing) {
    if (checkWinner('O')) return 10 - depth;
    if (checkWinner('X')) return depth - 10;
    if (board.every(cell => cell !== '')) return 0;

    if (isMaximizing) {
        let bestScore = -Infinity;
        for (let i = 0; i < 9; i++) {
            if (board[i] === '') {
                board[i] = 'O';
                const score = minimax(board, depth + 1, false);
                board[i] = '';
                bestScore = Math.max(score, bestScore);
            }
        }
        return bestScore;
    } else {
        let bestScore = Infinity;
        for (let i = 0; i < 9; i++) {
            if (board[i] === '') {
                board[i] = 'X';
                const score = minimax(board, depth + 1, true);
                board[i] = '';
                bestScore = Math.min(score, bestScore);
            }
        }
        return bestScore;
    }
}

// Find best move
function findBestMove() {
    let bestScore = -Infinity;
    let bestMove = -1;

    for (let i = 0; i < 9; i++) {
        if (boardState[i] === '') {
            boardState[i] = 'O';
            const score = minimax([...boardState], 0, false);
            boardState[i] = '';

            if (score > bestScore) {
                bestScore = score;
                bestMove = i;
            }
        }
    }

    return bestMove;
}

// Check winner
function checkWinner(player) {
    const winPatterns = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
        [0, 4, 8], [2, 4, 6]             // Diagonals
    ];

    return winPatterns.some(pattern => {
        return pattern.every(index => boardState[index] === player);
    });
}

// End game
function endGame(winner) {
    gameActive = false;
    gameResult.classList.remove('hidden');

    if (winner === 'X') {
        gameResult.textContent = '🎉 Vous avez gagné !';
        gameResult.className = 'mt-2 text-xl font-semibold text-green-600';
        stats.playerWins++;
    } else if (winner === 'O') {
        gameResult.textContent = '🤖 L\'ordinateur a gagné !';
        gameResult.className = 'mt-2 text-xl font-semibold text-red-600';
        stats.computerWins++;
    } else {
        gameResult.textContent = '🤝 Match nul !';
        gameResult.className = 'mt-2 text-xl font-semibold text-gray-600';
        stats.draws++;
    }

    gameStatus.textContent = 'Partie terminée';
    updateStatsDisplay();
    saveStats();
}

// Update stats display
function updateStatsDisplay() {
    playerWinsElement.textContent = stats.playerWins;
    computerWinsElement.textContent = stats.computerWins;
    drawsElement.textContent = stats.draws;
}

// Save stats to localStorage
function saveStats() {
    localStorage.setItem('tictactoeStats', JSON.stringify(stats));
}

// Reset button
resetBtn.addEventListener('click', initBoard);

// Initialize game
initBoard();
