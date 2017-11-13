<template>
  <div id="" class="row draggable">
    <div class="col-md-1">
      {{todo.id}}
    </div>
    <div class="col-md-6">
      {{todo.description}}
    </div>
    <div class="col-md-3">
      {{todo.time}}
    </div>
    <div class="col-md-2">
      {{status.name}}
    </div>
  </div>
</template>
<script>
import _ from 'lodash'

export default {
  name: "todo-single",
  props: ['todo', 'statuses'],
  computed: {
    status: function()
    {
      var vue = this;
      return _.find(this.statuses, function(r) {
        return r.id == vue.todo.status_id;
      });
    }
  },
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
</style>
