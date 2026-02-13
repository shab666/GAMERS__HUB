// Memory Card Game Logic
const board = document.getElementById('board');
const movesElement = document.getElementById('moves');
const pairsElement = document.getElementById('pairs');
const timerElement = document.getElementById('timer');
const resetBtn = document.getElementById('resetBtn');
const victoryMessage = document.getElementById('victoryMessage');
const finalMoves = document.getElementById('finalMoves');
const finalTime = document.getElementById('finalTime');

const emojis = ['🎮', '🎯', '🎲', '🎪', '🎨', '🎭', '🎸', '🎹'];
let cards = [];
let flippedCards = [];
let matchedPairs = 0;
let moves = 0;
let timerInterval;
let seconds = 0;

// Initialize game
function initGame() {
    board.innerHTML = '';
    cards = [];
    flippedCards = [];
    matchedPairs = 0;
    moves = 0;
    seconds = 0;

    movesElement.textContent = '0';
    pairsElement.textContent = '0 / 8';
    timerElement.textContent = '0:00';
    victoryMessage.classList.add('hidden');

    // Create card pairs
    const cardValues = [...emojis, ...emojis];
    shuffleArray(cardValues);

    // Create card elements
    cardValues.forEach((emoji, index) => {
        const card = document.createElement('div');
        card.className = 'card bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg shadow-lg flex items-center justify-center text-6xl cursor-pointer transition-all transform hover:scale-105 h-32';
        card.dataset.emoji = emoji;
        card.dataset.index = index;
        card.innerHTML = '<div class="card-back">?</div>';
        card.addEventListener('click', flipCard);
        board.appendChild(card);
        cards.push(card);
    });

    // Start timer
    clearInterval(timerInterval);
    timerInterval = setInterval(updateTimer, 1000);
}

// Shuffle array
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

// Update timer
function updateTimer() {
    seconds++;
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    timerElement.textContent = `${mins}:${secs.toString().padStart(2, '0')}`;
}

// Flip card
function flipCard(e) {
    const card = e.currentTarget;

    // Ignore if already flipped or matched
    if (card.classList.contains('flipped') || card.classList.contains('matched')) {
        return;
    }

    // Ignore if two cards already flipped
    if (flippedCards.length >= 2) {
        return;
    }

    // Flip the card
    card.classList.add('flipped');
    card.innerHTML = card.dataset.emoji;
    card.style.backgroundColor = 'white';
    flippedCards.push(card);

    // Check for match when two cards are flipped
    if (flippedCards.length === 2) {
        moves++;
        movesElement.textContent = moves;

        setTimeout(checkMatch, 800);
    }
}

// Check if flipped cards match
function checkMatch() {
    const [card1, card2] = flippedCards;

    if (card1.dataset.emoji === card2.dataset.emoji) {
        // Match found
        card1.classList.add('matched');
        card2.classList.add('matched');
        card1.classList.remove('cursor-pointer', 'hover:scale-105');
        card2.classList.remove('cursor-pointer', 'hover:scale-105');
        card1.style.backgroundColor = '#dcfce7';
        card2.style.backgroundColor = '#dcfce7';

        matchedPairs++;
        pairsElement.textContent = `${matchedPairs} / 8`;

        // Check if game won
        if (matchedPairs === 8) {
            gameWon();
        }
    } else {
        // No match - flip back
        card1.classList.remove('flipped');
        card2.classList.remove('flipped');
        card1.innerHTML = '<div class="card-back">?</div>';
        card2.innerHTML = '<div class="card-back">?</div>';
        card1.style.backgroundColor = '';
        card2.style.backgroundColor = '';
    }

    flippedCards = [];
}

// Game won
function gameWon() {
    clearInterval(timerInterval);

    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    const timeString = mins > 0 ? `${mins}min ${secs}s` : `${secs}s`;

    finalMoves.textContent = moves;
    finalTime.textContent = timeString;
    victoryMessage.classList.remove('hidden');

    // Celebration animation
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.transform = 'scale(1.1) rotate(5deg)';
            setTimeout(() => {
                card.style.transform = 'scale(1) rotate(0deg)';
            }, 200);
        }, index * 50);
    });
}

// Reset button
resetBtn.addEventListener('click', initGame);

// Add styles for card back
const style = document.createElement('style');
style.textContent = `
    .card-back {
        color: white;
        font-size: 4rem;
        font-weight: bold;
    }
    .card.flipped, .card.matched {
        background: white !important;
    }
`;
document.head.appendChild(style);

// Initialize game
initGame();
