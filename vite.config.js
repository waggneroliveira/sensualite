import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/assets/client/scss/app.scss',
                'resources/assets/client/js/main.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/assets/admin/css',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/admin/fonts',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/admin/images',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/admin/videos',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/admin/js',
                    dest: 'admin'
                },

                //client
                {
                    src: 'node_modules/swiper/swiper.min.css',
                    dest: 'client/plugin'
                },
                {
                    src: 'node_modules/swiper/swiper.min.js',
                    dest: 'client/plugin'
                },
                {
                    src: 'resources/assets/client/images',
                    dest: 'client'
                },
                {
                    src: 'resources/assets/client/js',
                    dest: 'client'
                },
            ]
        })
    ],
    server: {
        // Comando que executa a cópia ao iniciar o servidor de desenvolvimento
        setup: () => execSync('npm run copy-static', { stdio: 'inherit' })
    }
});
