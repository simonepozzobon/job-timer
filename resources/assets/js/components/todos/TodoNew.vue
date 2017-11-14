<template>
  <div id="todo-new">
    <div id="btn" ref="btn">
      <button @click="showNew" class="btn btn-primary">Nuovo</button>
    </div>
    <div id="new" ref="new">
      <div class="close mb-2">
        <button @click="hideNew" class="btn"><i class="fa fa-times"></i></button>
      </div>
      <div class="form-group">
        <label for="priority">Priorità</label>
        <select class="form-control" name="priority" v-model="todo_priority">
          <option v-for="priority in priorities" :value="priority.id">{{ priority.title }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="status">Stato</label>
        <select class="form-control" name="status" v-model="todo_status">
          <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="description">Descrizione</label>
        <textarea name="description" placeholder="descrizione" class="form-control" v-model="todo_description">
        </textarea>
      </div>
      <button class="btn btn-primary" @click="saveTodo">Aggiungi</button>
    </div>
  </div>
</template>
<script>
import {TweenMax, TimelineMax, Power4} from 'gsap'
import axios from 'axios'

export default {
  name: "todo-new",
  props: ['statuses', 'priorities', 'project'],
  data: () => ({
    todo_priority: 1,
    todo_status: 1,
    todo_description: '',
  }),
  computed: {
      projectParsed: function()
      {
          return JSON.parse(this.project);
      },
  },
  methods: {
      showNew()
      {
          var master = new TimelineMax();

          var t1 = new TimelineMax();
          t1.to(this.$refs.btn, .4, {
            opacity: 0,
            display: 'none',
            ease: Power4.easeInOut
          });

          var t2 = new TimelineMax();
          t2.to(this.$refs.new, .4, {
            opacity: 1,
            display: 'inherit',
            ease: Power4.easeInOut
          });

          master.add(t1);
          master.add(t2, .5);
          master.play();
      },

      hideNew()
      {
          var master = new TimelineMax();

          var t1 = new TimelineMax();
          t1.to(this.$refs.btn, .4, {
            opacity: 1,
            display: 'inherit',
            ease: Power4.easeInOut
          });

          var t2 = new TimelineMax();
          t2.to(this.$refs.new, .4, {
            opacity: 0,
            display: 'none',
            ease: Power4.easeInOut
          });

          master.add(t2);
          master.add(t1, .4);
          master.play();
      },

      saveTodo()
      {
          var vue = this;
          var formData = new FormData();
          formData.append('project_id', this.projectParsed.id);
          formData.append('priority', this.todo_priority);
          formData.append('status', this.todo_status);
          formData.append('description', this.todo_description);

          axios.post('/api/v1/todo/add', formData)
          .then(function(response) {
            vue.$parent.$emit('new-todo', response.data);
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

  #new {
    display: none;
    opacity: 0;
  }

</style>
