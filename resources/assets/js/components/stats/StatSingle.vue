<template>
  <div id="stat-single" class="row">
      <div class="col-md-6">
        {{stat.title}}
      </div>
      <div class="col-md-6">
        {{stat.value}}
      </div>
  </div>
</template>
<script>
export default {
  name: "stat-single",
  props: ['stat'],
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
</style>
