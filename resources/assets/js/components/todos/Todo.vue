<template>
  <div>
    <h2 v-if="!this.archive">{{projectSelected.title}}</h2>
    <h2 v-else>{{projectSelected.title}} - Archivio</h2>
    <div class="row">
      <div class="col">
        <button class="btn btn-primary" @click="newTodo"><i class="fa fa-file-o"></i> Nuovo</button>
        <button class="btn btn-secondary" @click="toggleArchive"><i class="fa fa-archive"></i> Archivio</button>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <todo-new :project="project" :statuses="statusesParsed" :priorities="prioritiesParsed">
        </todo-new>
      </div>
    </div>
    <draggable v-model="todos" @end="updateTodo">
      <todo-single
        v-for="todo in todos"
        :todo="todo"
        :statuses="statusesParsed"
        :priorities="prioritiesParsed"
        :key="todo.key"
      ></todo-single>
    </draggable>
    <hr>
  </div>
</template>
<script>
import draggable from 'vuedraggable'
import _ from 'lodash'
import axios from 'axios'

import TodoSingle from './TodoSingle.vue'
import TodoNew from './TodoNew.vue'

export default {
  name: "todo",
  props: ['project', 'statuses', 'priorities'],
  data: () => ({
    todos: [],
    archived: [],
    cache: [],
    archive: false,
    projectSelected: ''
  }),
  computed: {
    projectParsed: function()
    {
        return JSON.parse(this.project);
    },
    statusesParsed: function()
    {
        return JSON.parse(this.statuses);
    },
    prioritiesParsed: function()
    {
        return JSON.parse(this.priorities);
    },
  },
  mounted() {

      var vue = this;
      this.projectSelected = this.projectParsed;
      this.todos = this.projectSelected.todos;
      this.archived = this.projectSelected.archived_todos;

      this.$parent.$on('project-selected', function(project){
          console.log('cambiato ', project);
          vue.projectSelected = project;
          vue.todos = project.todos;
          vue.archived = project.archived_todos;
      });

      this.$on('new-todo', function(data) {
          vue.todos.push(data[0]);
      });

      this.$on('todo-deleted', function(id) {
          vue.deleteTodo(id);
      });

      this.$on('todo-archived', function(id) {
          vue.archiveTodo(id);
      });

      this.$on('todo-unarchived', function(id) {
          vue.unarchiveTodo(id);
      });


  },
  methods: {
    deleteTodo(id)
    {
        this.todos = this.todos.filter(function(value) {
            return value.id !== id;
        });
    },

    archiveTodo(id)
    {
        // trovo l'oggetto archivitato
        var obj = this.todos.filter(function(value) {
            return value.id == id;
        });

        obj[0].archived = 1;

        this.archived.push(obj[0]);

        // Elimino l'oggetto dai todo
        this.todos = this.todos.filter(function(value) {
            return value.id !== id;
        });
    },

    unarchiveTodo(id)
    {
        // trovo l'oggetto archivitato
        var obj = this.todos.filter(function(value) {
            return value.id == id;
        });

        obj[0].archived = 0;

        this.cache.push(obj[0]);

        // Elimino l'oggetto dai todo
        this.todos = this.todos.filter(function(value) {
            return value.id !== id;
        });
        // Elimino l'oggetto dall'archivio
        this.archived = this.archived.filter(function(value) {
            return value.id !== id;
        });
    },

    updateTodo()
    {
        var formData = new FormData();
        formData.append('project_id', this.projectSelected.id);
        formData.append('todos', JSON.stringify(this.todos));

        axios.post('/api/v1/todo/order', formData)
        .then(function(response) {
          console.log(response);
        })
        .catch(function(errors) {
          console.log(errors);
        })
    },

    toggleArchive(){
        if (this.archive) {
            this.todos = this.cache;
            this.cache = '';
            this.archive = false;
        } else {
            this.cache = this.todos;
            this.todos = this.archived;
            this.archive = true;
        }
    },

    newTodo()
    {
        this.$emit('show-new-todo');
    },
  },
  components: {
    TodoSingle,
    TodoNew,
    draggable,
  }
}
</script>
<style lang="scss" scoped>
</style>
