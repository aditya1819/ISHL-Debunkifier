import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        https: true, // Keep false for local dev
        host: '0.0.0.0', // Important for Docker
        port: 5173,
        hmr: {
            host: 'localhost',
        },
    }
});
