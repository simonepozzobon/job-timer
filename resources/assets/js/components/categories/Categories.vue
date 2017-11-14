<template>
  <div id="categories" class="row pt-4">
    <div class="col">
      <h2>Categorie</h2>
      <hr>
      <category-single v-for="category in categories" :category="category" :key="category.key"></category-single>
    </div>
  </div>
</template>
<script>
import CategorySingle from './CategorySingle.vue'

export default {
  name: "categories",
  props: ['main_categories'],
  data: () => ({
      categories: []
  }),
  computed: {
      main_categoriesParsed: function()
      {
          return JSON.parse(this.main_categories);
      }
  },
  mounted() {
      var vue = this;
      this.categories = this.main_categoriesParsed;

      this.$parent.$on('project-selected', function(project) {
          vue.changeProject(project);
      });
  },
  methods: {
      changeProject(project) {
          this.categories = project.categories;
      }
  },
  components: {
      CategorySingle
  }
}
</script>
<style lang="scss" scoped>
</style>
