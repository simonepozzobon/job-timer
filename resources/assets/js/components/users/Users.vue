<template>
  <div id="users" class="row">
    <div class="col">
      <h2>Utenti</h2>
      <hr>
      <!-- <user-single v-for="user in users" :key="user.key" :user="user"></user-single> -->
    </div>
  </div>
</template>
<script>
import UserSingle from './UserSingle.vue'

export default {
  name: "users",
  props: ['project'],
  data: () => ({
      users: [],
  }),
  mounted() {
      this.users.push(this.project.user);
  },
  methods: {
  },
  components: {
    UserSingle
  }
}
</script>
<style lang="scss" scoped>
</style>
