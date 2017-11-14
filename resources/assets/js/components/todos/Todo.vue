<template>
  <div>
    <h2>{{projectParsed.title}}</h2>
    <todo-single
      v-for="todo in todos"
      :key="todo.key"
      :todo="todo"
      :statuses="statusesParsed"
      :priorities="prioritiesParsed"
    ></todo-single>
    <hr>
    <todo-new :project="project" :statuses="statusesParsed" :priorities="prioritiesParsed">
    </todo-new>
  </div>
</template>
<script>
import TodoSingle from './TodoSingle.vue'
import TodoNew from './TodoNew.vue'

export default {
  name: "todo",
  props: ['project', 'statuses', 'priorities'],
  data: () => ({
    todos: []
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
    }
  },
  mounted() {
      var vue = this;
      this.todos = this.projectParsed.todos;

      this.$on('new-todo', function(data) {
          this.todos.push(data[0]);
      });

      this.$on('todo-deleted', function(id) {
          vue.deleteTodo(id);
      });
  },
  methods: {
    deleteTodo(id)
    {
        this.todos = this.todos.filter(function(value) {
            return value.id !== id;
        });
    },
  },
  components: {
    TodoSingle,
    TodoNew,
  }
}
</script>
<style lang="scss" scoped>
</style>
