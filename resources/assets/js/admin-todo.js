
import Vue from 'vue';

import Todo from './components/todos/Todo.vue'
import Users from './components/users/Users.vue'
import Projects from './components/projects/Projects.vue'
import Categories from './components/categories/Categories.vue'
import Stats from './components/stats/Stats.vue'


const app = new Vue({
  'el': '#app',
  mounted() {
    this.$on('project-selected', function(project) {
    });
  },
  components: {
    Todo,
    Users,
    Projects,
    Categories,
    Stats,
  }
})
