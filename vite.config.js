import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  resolve: {
    alias: {
      '@Layout': path.resolve(__dirname, 'resources/js/Layouts'),
      '@Components': path.resolve(__dirname, 'resources/js/Components'),
      '@Pages': path.resolve(__dirname, 'resources/js/Pages'),
      '@Images': path.resolve(__dirname, 'resources/images'),
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    vue({
      template: {
        compilerOptions:{

        },
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    
  ],
});
