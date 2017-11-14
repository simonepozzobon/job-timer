<template>
  <div id="stats" class="row pt-4">
    <div class="col">
      <h2>Statistiche - {{projectSelected.title}}</h2>
      <hr>
      <stat-single title="Data Inizio Progetto:">
        02/10/17
      </stat-single>
      <stat-single title="In Giorni:">
        15 giorni
      </stat-single>
      <stat-single title="Lavoro Effettivo:">
        00:10:11
      </stat-single>
      <stat-single title="Task Attivi:">
        15
      </stat-single>
      <stat-single title="Task Completati:">
        10
      </stat-single>
      <stat-single title="Tempo Medio Task Completo:">
        00:10:11
      </stat-single>
    </div>
  </div>
</template>
<script>
import StatSingle from './StatSingle.vue'

export default {
  name: "stats",
  props: ['project'],
  data: () => ({
    projectSelected: ''
  }),
  computed: {
      projectParsed: function()
      {
          return JSON.parse(this.project);
      }
  },
  mounted() {
    var vue = this;
    this.projectSelected = this.projectParsed;

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
