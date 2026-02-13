import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/games/snake.js',
                'resources/js/games/tictactoe.js',
                'resources/js/games/memory.js',
                'resources/js/games/2048.js',
            ],
            refresh: true,
        }),
    ],
});
