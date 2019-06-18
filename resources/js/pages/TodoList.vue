<template>
  <div>
    <h1>リスト一覧</h1>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>タスク名</th>
          <th>完了ボタン</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="todo in todos['todos']" v-bind:key="todo.id">  <!-- ←v-forを使ってtodosを表示 -->
          <td>{{ todo.id }}</td>  <!-- ←todoのIDを表示。@を忘れず！ -->
          <td>{{ todo.title }} <span>作業ボリューム {{ todo.workload }}</span></td>  <!-- ←todoのtitleを表示。@を忘れず！ -->
          <td><div class="c-btn01"><button v-on:click="deleteTodo(todo.id)">完了</button></div></td>
        </tr>  <!-- ←完了処理はまた後で設定します。 -->
      </tbody>
    </table>
    <div v-if="isLogin" class="c-add_btn"><button>タスクを追加</button></div>

    <div class="c-modal">
      <div class="c-modal__overlay"></div>
      <div class="c-modal__body">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="タスクを入力してください" v-model="new_title">
          <select v-model="new_workload">
            <option disabled value="">作業ボリュームを選択</option>
            <option>大</option>
            <option>中</option>
            <option>小</option>
          </select>
          <input type="hidden" name="" v-model="userid">
          <span class="input-group-btn">
            <button class="btn btn-success" type="button" v-on:click="addTodo">タスクを登録する</button> <!-- ←v-on:clickを追記 -->
          </span>
        </div>
      <!-- /.c-modal__body --></div>
    <!-- /.c-modal --></div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      todos: [],
      new_title: '',
      new_workload: '',
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    userid () {
      return this.$store.getters['auth/userid']
    },
    apiStatus () {
      return this.$store.state.auth.apiStatus
    },
  },
  methods: {
    createTodos(){ //←axios.getでTODOリストを取得しています
      axios.get('/api/todos').then((res)=>{
        console.log(this.todos);
        
        this.todos = res.data
      })
    },
    async addTodo(){ //←追記
      axios.post('/api/todos',{
        title: this.new_title,
        workload: this.new_workload,
        user_id: this.userid
      }).then((res)=>{
        this.todos = res.data
        // this.$set(this.todos, res.data)
        // this.todos = Object.assign({}, this.todos, res.data)
        // this.todos.push(res.data)
        this.new_title = ''
        this.new_workload = ''
        
      })
    },
    async deleteTodo(id){ //←追記
      axios.delete('/api/todos/' + id ,{
        id: id
      }).then((res)=>{
        this.todos = res.data
        // this.createTodos()
      })
    }
  },
  mounted() {
    this.createTodos()
  },
  watch: {
    $route: {
      async handler () {
        await this.createTodos()
      },
      immediate: true
    }
  }
}
</script>
