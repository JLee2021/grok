import { defineConfig } from "vite";
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
  base: "./",
  build: {
    target: "esnext", // browsers can handle the latest ES features (needed for geoloaction implementation using top-level await)
  },
  server: {
    proxy: {
      "/api": {
        target:
          "https://nefsctest.nmfs.local/grok/html/Backend/public/index.php/api",
        rewrite: (path) => path.replace(/^\/api/, ""),
        secure: false, // Don't verify cert: Ref - see vite config docs:server.proxy and https://github.com/http-party/node-http-proxy#options
      },
    },
  },
  plugins: [
    VitePWA({
      registerType: "autoUpdate",
      devOptions: {
        enabled: true,
      },
      manifest: {
        theme_color: "#0054a4",
        background_color: "#0093d0",
        display: "fullscreen",
        scope: "/",
        start_url: "/",
        name: "Project Grok",
        short_name: "Grok",
        description: "Project Grok is a PWA proof-of-concept",
        icons: [
          {
            src: "icon-192x192.png",
            sizes: "192x192",
            type: "image/png",
          },
          {
            src: "icon-256x256.png",
            sizes: "256x256",
            type: "image/png",
          },
          {
            src: "icon-384x384.png",
            sizes: "384x384",
            type: "image/png",
          },
          {
            src: "icon-512x512.png",
            sizes: "512x512",
            type: "image/png",
            purpose: "any maskable",
          },
        ],
      },
    }),
  ],
});
