require("./bootstrap");

require("moment");

import Vue from "vue";

import { InertiaApp } from "@inertiajs/inertia-vue";
import { InertiaForm } from "laravel-jetstream";
import PortalVue from "portal-vue";
import VueTailwind from "vue-tailwind";
import settings from "./relay.js";
import VueMoment from "vue-moment";
import moment from "moment-timezone";
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
    // The color of the progress bar.
  color: '#29d',

  // Whether to include the default NProgress styles.
  includeCSS: true,

  // Whether the NProgress spinner will be shown.
  showSpinner: false,
})
Vue.use(VueMoment, moment);

Vue.mixin({ methods: { route } });
Vue.mixin({
  methods: {
    hasRole: function(role) {
      return this.$page.auth.roles.includes(role)
    }
  }
})
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VueTailwind, settings);

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(app);
