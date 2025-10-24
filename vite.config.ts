import { wayfinder } from '@laravel/vite-plugin-wayfinder'
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'
import path from 'path' // ✅ Add this import

export default defineConfig({
    server: {
        watch: {
            usePolling: true,
        },
        host: 'localhost',
        port: 5173,
        proxy: {
            '/api': 'http://localhost:8000',
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'), 
            '@components': path.resolve(__dirname, 'resources/js/components'), 
            '@ui': path.resolve(__dirname, 'resources/js/components/ui'), 
        },
    },
    plugins: [
        laravel({
            input: ['resources/js/app.ts'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
})
