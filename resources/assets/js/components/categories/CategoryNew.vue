<template>
  <div id="category-new" ref="new" class="row pt-4">
    <div class="col">
      <div class="close mb-2">
        <button @click="hideNew" class="btn"><i class="fa fa-times"></i></button>
      </div>
      <div class="form-group">
        <label for="title">Titolo:</label>
        <input type="text" name="title" v-model="title" class="form-control">
      </div>
      <button class="btn btn-primary" @click="saveCategory">Aggiungi</button>
    </div>
  </div>
</template>
<script>
import {TweenMax, TimelineMax, Power4} from 'gsap'
import axios from 'axios'

export default {
  name: "category-new",
  props: ['project'],
  data: () => ({
      title: ''
  }),
  mounted() {
    var vue = this;
    this.$parent.$on('show-new-category', function() {
      vue.showNew();
    });
  },
  methods: {
      showNew()
      {
          var t2 = new TimelineMax();
          t2.to(this.$refs.new, .4, {
            opacity: 1,
            display: 'inherit',
            ease: Power4.easeInOut
          });

      },

      hideNew()
      {
          var t2 = new TimelineMax();
          t2.to(this.$refs.new, .4, {
            opacity: 0,
            display: 'none',
            ease: Power4.easeInOut
          });

      },

      saveCategory()
      {
          var vue = this;
          var formData = new FormData();
          formData.append('title', this.title);
          formData.append('project_id', this.project.id);

          axios.post('/api/v1/todo/category/new', formData)
          .then(function(response) {
            vue.$parent.$parent.$emit('new-category', response.data);
            vue.hideNew();
            vue.todo_description = '';
          })
          .catch(function(errors) {
            console.log(errors);
          })

      }
  }
}
</script>
<style lang="scss" scoped>

  #category-new {
    display: none;
    opacity: 0;
  }

</style>
