
import Vue from 'vue';

import Todo from './components/todos/Todo.vue'
import Projects from './components/projects/Projects.vue'

const app = new Vue({
  'el': '#app',
  mounted() {
    //do something after mounting vue instance
    this.$on('project-selected', function(project) {

    });
  },
  components: {
    Todo,
    Projects
  }
})
