// vite.config.js
import { defineConfig } from "file:///C:/laragon/www/hoom/loveprive/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/laragon/www/hoom/loveprive/node_modules/laravel-vite-plugin/dist/index.js";
import { viteStaticCopy } from "file:///C:/laragon/www/hoom/loveprive/node_modules/vite-plugin-static-copy/dist/index.js";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.js",
        "resources/assets/client/scss/app.scss",
        "resources/assets/client/js/main.js"
      ],
      refresh: true
    }),
    viteStaticCopy({
      targets: [
        {
          src: "resources/assets/admin/css",
          dest: "admin"
        },
        {
          src: "resources/assets/admin/fonts",
          dest: "admin"
        },
        {
          src: "resources/assets/admin/images",
          dest: "admin"
        },
        {
          src: "resources/assets/admin/videos",
          dest: "admin"
        },
        {
          src: "resources/assets/admin/js",
          dest: "admin"
        },
        //client
        {
          src: "node_modules/swiper/swiper.min.css",
          dest: "client/plugin"
        },
        {
          src: "node_modules/swiper/swiper.min.js",
          dest: "client/plugin"
        },
        {
          src: "resources/assets/client/images",
          dest: "client"
        },
        {
          src: "resources/assets/client/js",
          dest: "client"
        }
      ]
    })
  ],
  server: {
    // Comando que executa a cópia ao iniciar o servidor de desenvolvimento
    setup: () => execSync("npm run copy-static", { stdio: "inherit" })
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxsYXJhZ29uXFxcXHd3d1xcXFxob29tXFxcXGxvdmVwcml2ZVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxcbGFyYWdvblxcXFx3d3dcXFxcaG9vbVxcXFxsb3ZlcHJpdmVcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L2xhcmFnb24vd3d3L2hvb20vbG92ZXByaXZlL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCB7IHZpdGVTdGF0aWNDb3B5IH0gZnJvbSAndml0ZS1wbHVnaW4tc3RhdGljLWNvcHknO1xuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogW1xuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvY3NzL2FwcC5jc3MnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvYXBwLmpzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9jbGllbnQvc2Nzcy9hcHAuc2NzcycsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvY2xpZW50L2pzL21haW4uanMnLFxuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgICAgICB2aXRlU3RhdGljQ29weSh7XG4gICAgICAgICAgICB0YXJnZXRzOiBbXG4gICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBzcmM6ICdyZXNvdXJjZXMvYXNzZXRzL2FkbWluL2NzcycsXG4gICAgICAgICAgICAgICAgICAgIGRlc3Q6ICdhZG1pbidcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgc3JjOiAncmVzb3VyY2VzL2Fzc2V0cy9hZG1pbi9mb250cycsXG4gICAgICAgICAgICAgICAgICAgIGRlc3Q6ICdhZG1pbidcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgc3JjOiAncmVzb3VyY2VzL2Fzc2V0cy9hZG1pbi9pbWFnZXMnLFxuICAgICAgICAgICAgICAgICAgICBkZXN0OiAnYWRtaW4nXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIHNyYzogJ3Jlc291cmNlcy9hc3NldHMvYWRtaW4vdmlkZW9zJyxcbiAgICAgICAgICAgICAgICAgICAgZGVzdDogJ2FkbWluJ1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBzcmM6ICdyZXNvdXJjZXMvYXNzZXRzL2FkbWluL2pzJyxcbiAgICAgICAgICAgICAgICAgICAgZGVzdDogJ2FkbWluJ1xuICAgICAgICAgICAgICAgIH0sXG5cbiAgICAgICAgICAgICAgICAvL2NsaWVudFxuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgc3JjOiAnbm9kZV9tb2R1bGVzL3N3aXBlci9zd2lwZXIubWluLmNzcycsXG4gICAgICAgICAgICAgICAgICAgIGRlc3Q6ICdjbGllbnQvcGx1Z2luJ1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBzcmM6ICdub2RlX21vZHVsZXMvc3dpcGVyL3N3aXBlci5taW4uanMnLFxuICAgICAgICAgICAgICAgICAgICBkZXN0OiAnY2xpZW50L3BsdWdpbidcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgc3JjOiAncmVzb3VyY2VzL2Fzc2V0cy9jbGllbnQvaW1hZ2VzJyxcbiAgICAgICAgICAgICAgICAgICAgZGVzdDogJ2NsaWVudCdcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgc3JjOiAncmVzb3VyY2VzL2Fzc2V0cy9jbGllbnQvanMnLFxuICAgICAgICAgICAgICAgICAgICBkZXN0OiAnY2xpZW50J1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBdXG4gICAgICAgIH0pXG4gICAgXSxcbiAgICBzZXJ2ZXI6IHtcbiAgICAgICAgLy8gQ29tYW5kbyBxdWUgZXhlY3V0YSBhIGNcdTAwRjNwaWEgYW8gaW5pY2lhciBvIHNlcnZpZG9yIGRlIGRlc2Vudm9sdmltZW50b1xuICAgICAgICBzZXR1cDogKCkgPT4gZXhlY1N5bmMoJ25wbSBydW4gY29weS1zdGF0aWMnLCB7IHN0ZGlvOiAnaW5oZXJpdCcgfSlcbiAgICB9XG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBbVIsU0FBUyxvQkFBb0I7QUFDaFQsT0FBTyxhQUFhO0FBQ3BCLFNBQVMsc0JBQXNCO0FBRS9CLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQ3hCLFNBQVM7QUFBQSxJQUNMLFFBQVE7QUFBQSxNQUNKLE9BQU87QUFBQSxRQUNIO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsTUFDSjtBQUFBLE1BQ0EsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLElBQ0QsZUFBZTtBQUFBLE1BQ1gsU0FBUztBQUFBLFFBQ0w7QUFBQSxVQUNJLEtBQUs7QUFBQSxVQUNMLE1BQU07QUFBQSxRQUNWO0FBQUEsUUFDQTtBQUFBLFVBQ0ksS0FBSztBQUFBLFVBQ0wsTUFBTTtBQUFBLFFBQ1Y7QUFBQSxRQUNBO0FBQUEsVUFDSSxLQUFLO0FBQUEsVUFDTCxNQUFNO0FBQUEsUUFDVjtBQUFBLFFBQ0E7QUFBQSxVQUNJLEtBQUs7QUFBQSxVQUNMLE1BQU07QUFBQSxRQUNWO0FBQUEsUUFDQTtBQUFBLFVBQ0ksS0FBSztBQUFBLFVBQ0wsTUFBTTtBQUFBLFFBQ1Y7QUFBQTtBQUFBLFFBR0E7QUFBQSxVQUNJLEtBQUs7QUFBQSxVQUNMLE1BQU07QUFBQSxRQUNWO0FBQUEsUUFDQTtBQUFBLFVBQ0ksS0FBSztBQUFBLFVBQ0wsTUFBTTtBQUFBLFFBQ1Y7QUFBQSxRQUNBO0FBQUEsVUFDSSxLQUFLO0FBQUEsVUFDTCxNQUFNO0FBQUEsUUFDVjtBQUFBLFFBQ0E7QUFBQSxVQUNJLEtBQUs7QUFBQSxVQUNMLE1BQU07QUFBQSxRQUNWO0FBQUEsTUFDSjtBQUFBLElBQ0osQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLFFBQVE7QUFBQTtBQUFBLElBRUosT0FBTyxNQUFNLFNBQVMsdUJBQXVCLEVBQUUsT0FBTyxVQUFVLENBQUM7QUFBQSxFQUNyRTtBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
