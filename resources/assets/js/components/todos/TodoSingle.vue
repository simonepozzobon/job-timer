<template>
  <div id="" class="draggable">
    <hr>
    <div class="row align-items-center" ref="edit" @click="edit">
      <div :class="'col-md-2 text-center bg-'+priority.color_class">
        {{priority.title}}
      </div>
      <div class="col-md-2 text-center">
        {{todo.time}}
      </div>
      <div class="col-md-4">
        {{todo.description}}
      </div>
      <div :class="'col-md-2 text-center bg-'+status.color_class">
        {{status.name}}
      </div>
      <div class="col-md-2 text-center">
        {{timer}}
      </div>
    </div>
    <div id="tools" class="row justify-content-center" ref="tools">
      <div class="col-md-6">
        <button class="btn btn-primary" @click="play" v-if="!timer_status"><i class="fa fa-play"></i></button>
        <button class="btn btn-secondary" @click="pause" v-else><i class="fa fa-pause"></i></button>
        <button class="btn btn-info" @click="update"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger" @click="confirm"><i class="fa fa-trash-o"></i></button>
        <button class="btn btn-success" @click="archive" v-if="todo.archived != 1"><i class="fa fa-download"></i></button>
        <button class="btn btn-success" @click="unarchive" v-else><i class="fa fa-upload"></i></button>
        <button class="btn btn-warning" @click="undo"><i class="fa fa-undo"></i></button>
      </div>
    </div>
    <div id="confirm" class="row justify-content-center" ref="confirm">
      <div class="col">
        <button class="btn btn-danger" @click="destroy"><i class="fa fa-check"></i></button>
        <button class="btn btn-warning" @click="undoConfirm"><i class="fa fa-undo"></i></button>
        <button class="btn btn-secondary" @click="close"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div id="update" class="row" ref="update">
      <div class="col-md-3">
        <select class="form-control" name="status" v-model="todo_priority">
          <option v-for="priority in priorities" :value="priority.id">{{priority.title}}</option>
        </select>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <textarea name="description" class="form-control" v-model="todo_description"></textarea>
        </div>
      </div>
      <div class="col-md-3">
        <select class="form-control" name="status" v-model="todo_status">
          <option v-for="status in statuses" :value="status.id">{{status.name}}</option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary" @click="sendUpdate"><i class="fa fa-floppy-o"></i></button>
        <button class="btn btn-secondary" @click="close"><i class="fa fa-times"></i></button>
      </div>
    </div>
  </div>
</template>
<script>
import _ from 'lodash'
import {TweenMax, Power4, TimelineMax} from 'gsap'

export default {
  name: "todo-single",
  props: ['todo', 'statuses', 'priorities', 'order'],
  computed: {
    status: function()
    {
        var vue = this;
        return _.find(this.statuses, function(r) {
            return r.id == vue.todo.status_id;
        });
    },
    priority: function()
    {
        var vue = this;
        return _.find(this.priorities, function(r) {
            return r.id == vue.todo.priority_id;
        });
    },
    timer: function()
    {
      if (this.todo.timer.status) {
        this.timer_status = true;
        return this.todo.timer.time;
      } else {
        this.timer_status = false;
        return this.todo.timer.time || null;
      }
    }
  },
  data: () => ({
    todo_description: '',
    todo_status: '',
    todo_priority: '',
    timer_status: '',
  }),
  mounted() {
      this.todo_description = this.todo.description;
      this.todo_priority = this.todo.priority_id;
      this.todo_status = this.todo.status_id;


  },
  methods: {
      play()
      {
          var vue = this;
          var formData = new FormData();
          formData.append('id', this.todo.id);

          axios.post('/api/v1/timer/play', formData)
          .then(function(response) {
            console.log(response);
            vue.close();
            vue.timer_status = true;
          })
          .catch(function(errors) {
            console.log(errors);
          });
      },

      pause()
      {
          var vue = this;
          var formData = new FormData();
          formData.append('id', 1);

          axios.post('/api/v1/timer/pause', formData)
          .then(function(response) {
            console.log(response);
            vue.close();
            vue.timer_status = false;
          })
          .catch(function(errors) {
            console.log(errors);
          });
      },

      edit()
      {
          var master = new TimelineMax();
          var t1 = new TimelineMax();
          t1.to(this.$refs.edit, .4, {
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

      update()
      {
          var master = new TimelineMax();
          var t1 = new TimelineMax();
          t1.to(this.$refs.tools, .4, {
            opacity: 0,
            display: 'none'
          });

          var t2 = new TimelineMax();
          t2.to(this.$refs.update, .4, {
            opacity: 1,
            display: 'flex'
          });

          master.add(t1);
          master.add(t2, .4);
          master.play();
      },

      sendUpdate()
      {
          var vue = this;
          var formData = new FormData();
          formData.append('id', this.todo.id);
          formData.append('description', this.todo_description);
          formData.append('priority', this.todo_priority);
          formData.append('status', this.todo_status);

          axios.post('/api/v1/todo/update', formData)
          .then(function(response) {
            console.log(response);
            vue.todo.description = vue.todo_description;
            vue.todo.priority_id = vue.todo_priority;
            vue.todo.status_id = vue.todo_status;
            vue.close();
          })
          .catch(function(errors) {
            console.log(errors);
          });
      },

      archive()
      {
          var vue = this;
          var formData = new FormData();
          formData.append('id', this.todo.id);
          axios.post('/api/v1/todo/archive', formData)
          .then(function(response) {
            console.log(response);
            vue.close();
            vue.$parent.$parent.$emit('todo-archived', parseInt(response.data.id));
          })
          .catch(function(errors) {
            console.log(errors);
          });
      },

      unarchive()
      {
          var vue = this;
          var formData = new FormData();
          formData.append('id', this.todo.id);
          axios.post('/api/v1/todo/unarchive', formData)
          .then(function(response) {
            console.log(response);
            vue.close();
            vue.$parent.$parent.$emit('todo-unarchived', parseInt(response.data.id));
          })
          .catch(function(errors) {
            console.log(errors);
          });
      },

      undo()
      {
          var master = new TimelineMax();
          var t1 = new TimelineMax();
          t1.to(this.$refs.edit, .4, {
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
      },

      confirm()
      {
          var master = new TimelineMax();

          var t1 = new TimelineMax();
          t1.to(this.$refs.tools, .4, {
            opacity: 0,
            display: 'none'
          });

          var t2 = new TimelineMax();
          t2.to(this.$refs.confirm, .4, {
            opacity: 1,
            display: 'flex'
          });

          master.add(t1);
          master.add(t2, .4);
          master.play();
      },

      undoConfirm()
      {
          var master = new TimelineMax();

          var t1 = new TimelineMax();
          t1.to(this.$refs.tools, .4, {
            opacity: 1,
            display: 'flex'
          });

          var t2 = new TimelineMax();
          t2.to(this.$refs.confirm, .4, {
            opacity: 0,
            display: 'none'
          });

          master.add(t2);
          master.add(t1, .4);
          master.play();
      },

      destroy()
      {
          var vue = this;

          var formData = new FormData();
          formData.append('id', this.todo.id);

          axios.post('/api/v1/todo/destroy', formData)
          .then(function(response) {
            console.log(response);
            vue.close();
            vue.$parent.$parent.$emit('todo-deleted', parseInt(response.data.id));
          })
          .catch(function(errors) {
            console.log(errors);
          });
      },

      close()
      {
          var master = new TimelineMax();

          var t1 = new TimelineMax();
          t1.to(this.$refs.tools, .4, {
            opacity: 0,
            display: 'none'
          });

          var t2 = new TimelineMax();
          t2.to(this.$refs.confirm, .4, {
            opacity: 0,
            display: 'none'
          });

          var t3 = new TimelineMax();
          t3.to(this.$refs.update, .4, {
            opacity: 0,
            display: 'none'
          });

          var t4 = new TimelineMax();
          t4.to(this.$refs.edit, .4, {
            opacity: 1,
            display: 'flex'
          });

          master.add(t1);
          master.add(t2);
          master.add(t4, .4);
          master.play();
      },
  }
}
</script>
<style lang="scss" scoped>

  .row {
    cursor: pointer;
  }

  #tools {
    display: none;
    opacity: 0;
  }

  #confirm {
    display: none;
    opacity: 0;
  }

  #update {
    display: none;
    opacity: 0;
  }

</style>
