<template>
  <div id="panel" class="row">
    <div class="col">
      <todo
        :project="project"
        :statuses="statuses"
        :priorities="priorities"
      ></todo>
    </div>
    <!-- <div class="col-md-4">
      <users :project="project"></users>
      <projects :projects="projects"></projects>
      <categories :main_categories="categories"></categories>
      <stats :project="project"></stats>
    </div> -->
  </div>
</template>
<script>

import Todo from '../todos/Todo.vue'
import Users from '../users/Users.vue'
import Projects from '../projects/Projects.vue'
import Categories from '../categories/Categories.vue'
import Stats from '../stats/Stats.vue'

import axios from 'axios'

export default {
  name: "panel",
  props: ['main_project', 'projects', 'statuses', 'priorities'],
  data: () => ({
    project: '',
    categories: ''
  }),
  computed: {
      main_projectParsed: function()
      {
          return JSON.parse(this.main_project);
      },
  },
  mounted() {
    var vue = this;

    this.init();
    this.categories = this.categoriesArr;

    this.$on('project-selected', function(project) {
        vue.changeProject(project);
    });

    // this.test_request();
  },
  methods: {
      init()
      {
          this.$emit('project-selected', this.main_projectParsed);
      },

      test_request()
      {
        axios.post('http://192.168.1.3:80/api/v1/project/todo/add',
          {
            'project_id': 1,
            'category': 1,
            'priority': 1,
            'status': 1,
            'description': 'fadasfdsafasdf',
          }
        ).then(response => {
          console.log(response);
        })
      },

      changeProject(project) {
          this.project = project;
          this.categories = project.categories;
      }
  },
  components: {
    Todo,
    Users,
    Projects,
    Categories,
    Stats,
  }
}
</script>
<style lang="scss" scoped>
</style>
