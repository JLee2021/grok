import { defineConfig } from 'vite'
import { VitePWA } from 'vite-plugin-pwa'

export default defineConfig ({
	base: './',
	plugins: [
		VitePWA({
			registerType: 'autoUpdate',
			devOptions: {
				enabled: true
			},
			manifest: {
				"theme_color": "#0054a4",
				"background_color": "#0093d0",
				"display": "fullscreen",
				"scope": "/",
				"start_url": "/",
				"name": "Project Grok",
				"short_name": "Grok",
				"description": "Project Grok is a PWA proof-of-concept",
				"icons": [{
						"src": "./assets/icon-192x192.png",
						"sizes": "192x192",
						"type": "image/png"
					}, {
						"src": "./assets/icon-256x256.png",
						"sizes": "256x256",
						"type": "image/png"
					}, {
						"src": "./assets/icon-384x384.png",
						"sizes": "384x384",
						"type": "image/png"
					}, {
						"src": "./assets/icon-512x512.png",
						"sizes": "512x512",
						"type": "image/png",
						"purpose": "any maskable"
					}
				]
			}
		}),

	]
})

