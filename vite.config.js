import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

/*
 * Compile check for the theme (`npm run build`): resources/css/build.css
 * imports Filament's stylesheet then the theme, like a host app does.
 * The output in resources/dist is not shipped — the host compiles the theme.
 */
export default defineConfig({
    plugins: [tailwindcss()],
    build: {
        outDir: 'resources/dist',
        emptyOutDir: true,
        rollupOptions: {
            input: 'resources/css/build.css',
            output: {
                assetFileNames: 'filament-tribute-theme.[ext]',
            },
        },
    },
});
