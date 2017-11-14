<template>
  <div id="category-single">
    <div class="row">
      <div class="col">
        {{category.title}}
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "category-single",
  props: ['category'],
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
</style>
