<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🐍 Snake
        </h2>
    </x-slot>

    <div class="content">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Back Link -->
                <div class="mb-4">
                    <a href="{{ route('games') }}" class="settings-button" style="display: inline-block; text-decoration: none;">
                        ← Retour aux jeux
                    </a>
                </div>

                <!-- Title -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold mb-1">🐍 Snake Game</h3>
                    <p class="text-sm text-gray-500">Le jeu classique du serpent. Mangez des pommes et grandissez !</p>
                </div>

                <!-- Game Stats -->
                <div class="stats-grid mb-6">
                    <div class="stat-card">
                        <div class="stat-number" id="score">0</div>
                        <div class="stat-label">Score</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="highScore">0</div>
                        <div class="stat-label">Meilleur score</div>
                    </div>
                    <div class="stat-card" style="display: flex; align-items: center; justify-content: center;">
                        <button id="restartBtn" class="settings-button" style="width: 100%; margin: 0;">🔄 Recommencer</button>
                    </div>
                </div>

                <!-- Game Board -->
                <div style="display: flex; justify-content: center; margin-bottom: 24px;">
                    <canvas id="gameCanvas" width="400" height="400" style="border: 2px solid #e5e7eb; border-radius: 8px; background: #f9fafb;"></canvas>
                </div>

                <!-- Game Over Message -->
                <div id="gameOver" style="display: none; text-align: center; margin-bottom: 20px; padding: 12px; background: #fee2e2; border: 1px solid #fca5a5; border-radius: 6px; color: #991b1b;">
                    <strong>Game Over !</strong> Votre score : <span id="finalScore"></span>
                </div>

                <!-- Instructions -->
                <div class="settings-card">
                    <h4 style="margin-bottom: 12px;">📋 Instructions</h4>
                    <ul style="color: #6b7280; font-size: 14px; line-height: 1.8; padding-left: 20px;">
                        <li>Utilisez les <strong>flèches du clavier</strong> (↑ ↓ ← →) pour diriger le serpent</li>
                        <li>Mangez les <strong>pommes rouges</strong> pour grandir et marquer des points</li>
                        <li>Ne touchez pas les <strong>murs</strong> ni votre propre <strong>queue</strong></li>
                        <li>Votre meilleur score est sauvegardé automatiquement</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        const scoreElement = document.getElementById('score');
        const highScoreElement = document.getElementById('highScore');
        const restartBtn = document.getElementById('restartBtn');
        const gameOverElement = document.getElementById('gameOver');
        const finalScoreElement = document.getElementById('finalScore');

        const gridSize = 20;
        const tileCount = canvas.width / gridSize;

        let snake = [{ x: 10, y: 10 }];
        let food = { x: 15, y: 15 };
        let dx = 0;
        let dy = 0;
        let score = 0;
        let highScore = localStorage.getItem('snakeHighScore') || 0;
        let gameRunning = false;
        let gameLoop;

        highScoreElement.textContent = highScore;

        function drawGame() {
            clearCanvas();
            moveSnake();
            drawSnake();
            drawFood();
            checkCollision();
        }

        function clearCanvas() {
            ctx.fillStyle = '#f9fafb';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        }

        function drawSnake() {
            ctx.fillStyle = '#10b981';
            snake.forEach((segment, index) => {
                if (index === 0) {
                    ctx.fillStyle = '#059669';
                } else {
                    ctx.fillStyle = '#10b981';
                }
                ctx.fillRect(segment.x * gridSize, segment.y * gridSize, gridSize - 2, gridSize - 2);
            });
        }

        function moveSnake() {
            if (dx === 0 && dy === 0) return;

            const head = { x: snake[0].x + dx, y: snake[0].y + dy };
            snake.unshift(head);

            if (head.x === food.x && head.y === food.y) {
                score += 10;
                scoreElement.textContent = score;
                generateFood();
            } else {
                snake.pop();
            }
        }

        function drawFood() {
            ctx.fillStyle = '#ef4444';
            ctx.fillRect(food.x * gridSize, food.y * gridSize, gridSize - 2, gridSize - 2);
        }

        function generateFood() {
            food.x = Math.floor(Math.random() * tileCount);
            food.y = Math.floor(Math.random() * tileCount);

            snake.forEach(segment => {
                if (segment.x === food.x && segment.y === food.y) {
                    generateFood();
                }
            });
        }

        function checkCollision() {
            const head = snake[0];

            if (head.x < 0 || head.x >= tileCount || head.y < 0 || head.y >= tileCount) {
                endGame();
                return;
            }

            for (let i = 1; i < snake.length; i++) {
                if (head.x === snake[i].x && head.y === snake[i].y) {
                    endGame();
                    return;
                }
            }
        }

        function endGame() {
            gameRunning = false;
            clearInterval(gameLoop);
            
            finalScoreElement.textContent = score;
            gameOverElement.style.display = 'block';

            if (score > highScore) {
                highScore = score;
                highScoreElement.textContent = highScore;
                localStorage.setItem('snakeHighScore', highScore);
            }
        }

        function resetGame() {
            snake = [{ x: 10, y: 10 }];
            food = { x: 15, y: 15 };
            dx = 0;
            dy = 0;
            score = 0;
            scoreElement.textContent = '0';
            gameOverElement.style.display = 'none';
            gameRunning = true;
            
            clearInterval(gameLoop);
            gameLoop = setInterval(drawGame, 100);
        }

        document.addEventListener('keydown', (e) => {
            if (!gameRunning && ['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                resetGame();
            }

            switch (e.key) {
                case 'ArrowUp':
                    if (dy === 0) { dx = 0; dy = -1; }
                    break;
                case 'ArrowDown':
                    if (dy === 0) { dx = 0; dy = 1; }
                    break;
                case 'ArrowLeft':
                    if (dx === 0) { dx = -1; dy = 0; }
                    break;
                case 'ArrowRight':
                    if (dx === 0) { dx = 1; dy = 0; }
                    break;
            }
        });

        restartBtn.addEventListener('click', resetGame);

        resetGame();
    </script>
</x-app-layout>
