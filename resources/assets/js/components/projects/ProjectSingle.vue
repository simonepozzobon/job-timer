<template>
  <div id="project-single">
    <div id="project" class="row" ref="project" @click="tools">
      <div class="col">
        <span v-if="project.is_main == 1">{{project.title}} <i class="fa fa-star"></i></span>
        <span v-else>{{project.title}}</span>
      </div>
    </div>
    <div id="tools" class="row justify-content-center" ref="tools">
      <div class="col">
        <button class="btn btn-success" @click="select"><i class="fa fa-check"></i></button>
        <button class="btn btn-yellow" @click="set_main"><i class="fa fa-star-o"></i></button>
        <button class="btn btn-primary"><i class="fa fa-info"></i></button>
        <button class="btn btn-info"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
        <button class="btn btn-secondary" @click="close"><i class="fa fa-times"></i></button>
      </div>
    </div>
  </div>
</template>
<script>
import {TweenMax, Power4, TimelineMax} from 'gsap'
import axios from 'axios'

export default {
  name: "project-single",
  props: ['project'],
  data: () => ({

  }),
  methods: {
      select()
      {
          this.$parent.$parent.$emit('project-selected', this.project);
          this.close();
      },

      set_main()
      {
          var vue = this;

          this.$parent.$parent.$emit('project-selected', this.project);

          var formData = new FormData();
          formData.append('id', this.project.id);

          axios.post('/api/v1/projects/set-main', formData)
          .then((response) => {
              vue.close();
          })
          .then((errors) => {
              console.log(errors);
          });
      },

      tools()
      {
          var master = new TimelineMax();
          var t1 = new TimelineMax();
          t1.to(this.$refs.project, .4, {
            opacity: 0,
            display: 'none'
          });

          var t2 = new TimelineMax();
          t2.to(this.$refs.tools, .4, {
            opacity: 1,
            display: 'flex'
          });

          master.add(t1);
          master.add(t2, .4);
          master.play();
      },

      close()
      {
          var master = new TimelineMax();
          var t1 = new TimelineMax();

          t1.to(this.$refs.project, .4, {
            opacity: 1,
            display: 'flex'
          });

          var t2 = new TimelineMax();
          t2.to(this.$refs.tools, .4, {
            opacity: 0,
            display: 'none'
          });

          master.add(t2);
          master.add(t1, .4);
          master.play();
      }
  }
}
</script>
<style lang="scss" scoped>

  .row {
    cursor: pointer;
  }

  #tools {
    opacity: 0;
    display: none;
  }

</style>
