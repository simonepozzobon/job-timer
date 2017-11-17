import Vue from 'vue'
import Resource from 'vue-resource'
import http from 'http'

Vue.use(Resource);
Vue.http.options.emulateJSON = true

import Panel from './components/views/Panel.vue'



new Vue({
  'el': '#app',
  components: {
    Panel,
  },
  data: () => ({
    projects: [],
  }),
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      var vue = this;
      // this.$http.get('http://192.168.1.2:80/api/v1/projects')
      //       .then(response => {
      //         console.log(response.body);
      //         vue.projects = response.body;
      //       })
    }
  }
})
