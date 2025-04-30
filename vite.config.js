import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
 
export default defineConfig({
 
    plugins: [
        
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/response.scss',
                'resources/sass/checkers.scss',
                
                'resources/js/app.js',
                'resources/js/ceny.js',
                'resources/js/pay.js',
                'resources/js/checkers.js',
                'resources/js/app-admin.js',
            ],
            
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
                compilerOptions: {
                    isCustomElement: (tag) => tag.includes('swiper')
                  }
            },
        }),
         
        
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
     
});
