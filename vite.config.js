import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from "vite-plugin-static-copy";


export default defineConfig({
    build: {
        assetsDir: 'public',
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
            },
            output: {
                format: 'es',
            },
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                { src: 'resources/js/app.js', dest: 'public/jss' }, // Przykładowa kopia plików
            ],

        }),
    ],
});
