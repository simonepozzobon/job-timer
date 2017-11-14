<template>
  <div id="projects">
    <h2>Progetti</h2>
    <hr>
    <project-single v-for="project in projectsParsed" :key="project.key" :project="project">
    </project-single>
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
