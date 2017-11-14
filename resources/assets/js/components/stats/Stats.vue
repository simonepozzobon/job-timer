<template>
  <div id="stats" class="row pt-4">
    <div class="col">
      <h2>Statistiche - {{projectSelected.title}}</h2>
      <hr>
      <stat-single v-for="stat in projectSelected.stats" :key="stat.key" :stat="stat"></stat-single>
    </div>
  </div>
</template>
<script>
import StatSingle from './StatSingle.vue'

export default {
  name: "stats",
  props: ['project'],
  data: () => ({
    projectSelected: '',
  }),
  mounted() {
    var vue = this;
    this.projectSelected = this.project;
    console.log(this.projectSelected);

    this.$parent.$on('project-selected', function(project) {
      vue.changeProject(project);
    });
  },
  methods: {
    changeProject(project) {
      this.projectSelected = project;
    }
  },
  components: {
    StatSingle
  }
}
</script>
<style lang="scss" scoped>
</style>
