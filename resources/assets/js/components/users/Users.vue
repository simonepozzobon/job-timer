<template>
  <div id="users" class="row">
    <div class="col">
      <h2>Utenti</h2>
      <hr>
      <user-single v-for="user in users" :key="user.key" :user="user"></user-single>
    </div>
  </div>
</template>
<script>
import UserSingle from './UserSingle.vue'

export default {
  name: "users",
  props: ['project'],
  data: () => ({
      users: ''
  }),
  computed: {
    projectParsed: function()
    {
        return JSON.parse(this.project)
    }
  },
  mounted() {
      this.users = [this.projectParsed.user];
  },
  methods: {
      methodName() {

      }
  },
  components: {
    UserSingle
  }
}
</script>
<style lang="scss" scoped>
</style>
