<template>
  <div id="panel" class="row">
    <div class="col-md-8">
      <todo
        :project="project"
        :statuses="statuses"
        :priorities="priorities"
      ></todo>
    </div>
    <div class="col-md-4">
      <users :project="project"></users>
      <projects :projects="projects"></projects>
      <categories :main_categories="categories"></categories>
      <stats :project="project"></stats>
    </div>
  </div>
</template>
<script>

import Todo from '../todos/Todo.vue'
import Users from '../users/Users.vue'
import Projects from '../projects/Projects.vue'
import Categories from '../categories/Categories.vue'
import Stats from '../stats/Stats.vue'

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
  },
  methods: {
      init()
      {
          this.$emit('project-selected', this.main_projectParsed);
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
