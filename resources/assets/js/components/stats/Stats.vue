<template>
  <div id="stats" class="row pt-4">
    <div class="col">
      <h2>Statistiche - {{projectSelected.title}}</h2>
      <hr>
      <stat-single title="Data Inizio Progetto:">
        {{projectSelected.stats.project_start}}
      </stat-single>
      <stat-single title="Giorni dall'inizio:">
        {{projectSelected.stats.days_from_start}}
      </stat-single>
      <stat-single title="Lavoro Effettivo:" class="pt-4">
        {{projectSelected.stats.global_time}}
      </stat-single>
      <stat-single title="Task Attivi:" class="pt-4">
        {{projectSelected.stats.actives}}
      </stat-single>
      <stat-single title="Task Completati:">
        {{projectSelected.stats.completed}}
      </stat-single>
      <stat-single title="Task Totali:">
        {{projectSelected.stats.total}}
      </stat-single>
      <stat-single title="Tempo Medio Task Completo:" class="pt-4">
        {{projectSelected.stats.average_time}}
      </stat-single>
      <stat-single title="Tempo al Completamento (stima):" class="pt-4">
        {{projectSelected.stats.time_to_complete}}
      </stat-single>
      <stat-single title="Data del Completamento (stima):">
        {{projectSelected.stats.date_to_complete}}
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
