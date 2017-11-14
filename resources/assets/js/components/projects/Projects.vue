<template>
  <div id="projects" class="row pt-4">
    <div class="col">
      <h2>Progetti</h2>
      <hr>
      <project-single v-for="project in projectsParsed" :key="project.key" :project="project">
      </project-single>
    </div>
  </div>
</template>
<script>
import ProjectSingle from './ProjectSingle.vue'

export default {
  name: "projects",
  props: ['projects'],
  computed: {
    projectsParsed: function()
    {
        return JSON.parse(this.projects)
    }
  },
  data: () => ({

  }),
  components: {
    ProjectSingle
  }
}
</script>
<style lang="scss" scoped>
</style>
