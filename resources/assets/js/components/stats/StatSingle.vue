<template>
  <div id="stat-single" class="row">
      <div class="col-md-6">
        {{title}}
      </div>
      <div class="col-md-6">
        <slot></slot>
      </div>
  </div>
</template>
<script>
export default {
  name: "stat-single",
  props: ['title'],
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
</style>
