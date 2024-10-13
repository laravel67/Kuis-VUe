import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
// import { FlowbiteThemableChild } from 'flowbite-vue';
import 'https://code.jquery.com/jquery-3.4.1.min.js';
import 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js';
import '/public/assets/js/chart.min';
import '/public/assets/js/easing.min';
import '/public/assets/js/waypoints.min';
import '/public/assets/js/owl.carousel.min';
// import '/public/assets/js/moment.min';
// import '/public/assets/js/moment-timezone.min';
// import '/public/assets/js/tempusdominus-bootstrap-4.min';
// import '/public/assets/js/main';
import 'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js';

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    return pages[`./Pages/${name}.vue`];
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      // .use(FlowbiteThemableChild) // Use Flowbite as a plugin
      .component('Head', Head)
      .mount(el);
  },
});
