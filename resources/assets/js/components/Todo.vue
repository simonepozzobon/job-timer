<template>
  <div>
    <h2>Project Title</h2>
    <hr>
    <todo-single
      v-for="todo in todosParsed"
      :key="todo.key"
      :todo="todo"
      :statuses="statusesParsed"
    ></todo-single>
  </div>
</template>
<script>
import TodoSingle from './TodoSingle.vue'

export default {
  name: "todo",
  props: ['todos', 'statuses'],
  data: () => ({
  }),
  computed: {
    todosParsed: function()
    {
        return JSON.parse(this.todos);
    },
    statusesParsed: function()
    {
        return JSON.parse(this.statuses);
    }
  },
  mounted() {
    //do something after mounting vue instance
  },
  components: {
    TodoSingle
  }
}
</script>
<style lang="scss" scoped>
</style>
