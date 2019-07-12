<template>
  <div>
    <h1>{{user.name}}さんのタスクリスト</h1>
    <div class="c-todo_list">
      <div class="row">
        <div class="col-sm-4" v-for="todo in user['todos']" v-bind:key="todo.id">
          <div class="c-todo_list__card" v-bind:class="todo.workload">
            <h3>{{ todo.title }}</h3>
            <div class="c-todo_list__inner">
              <p>作業内容： {{ todo.body }}</p>
              <ul>
                <li>納期：{{ todo.date }}</li>
                <li>進捗：{{ todo.progress }}</li>
              </ul>

            <!-- /.c-todo_list__inner --></div>
          </div>
        </div>
      </div>
    <!-- /.c-todo_list --></div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      user: [],
    }
  },
  props: {
    id: {
      type: String,
      required: true
    }
  },
  methods: {
    async fetchTodos(){ //←axios.getでTODOリストを取得しています
      axios.get(`/api/users/${this.id}`).then((res)=>{
        this.user = res.data //←取得したTODOリストをtodosに格納
      })
    },
    
  },
  created() {  //←インスタンス生成時にfetchTodos()を実行したいので、createdフックに登録します。
    this.fetchTodos()
  },
}
</script>
