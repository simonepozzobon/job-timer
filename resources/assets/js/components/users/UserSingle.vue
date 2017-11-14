<template>
  <div id="user-single" class="row">
    <div class="col">
      {{user.name}}
    </div>
  </div>
</template>
<script>
export default {
  name: "user-single",
  props: ['user'],
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
</style>
