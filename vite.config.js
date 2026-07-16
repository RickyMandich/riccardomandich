import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
	plugins: [
		laravel({
			input: ['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js', 'resources/scss/tombola.scss'],
			refresh: true,
		}),
	],
	css: {
		preprocessorOptions: {
			scss: {
				quietDeps: true,
				silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'if-function']
			}
		}
	}
});
