<template>
  <div>
    <h1>リスト一覧</h1>
    <div class="c-todo_list">
      <div class="container">
        <div class="row">
          <div class="col-sm-4" v-for="todo in todos['todos']" v-bind:key="todo.id">
            <div class="c-todo_list__card">
              <h3>{{ todo.title }}</h3>
              <div class="c-todo_list__inner">
                <p>作業ボリューム {{ todo.workload }}</p>
                <p>作業内容 {{ todo.body }}</p>
                <div class="c-btn01"><button v-on:click="deleteTodo(todo.id)">完了</button></div>
              <!-- /.c-todo_list__inner --></div>
            </div>
          </div>
        </div>
      </div>
    <!-- /.c-todo_list --></div>
    
    <div v-if="isLogin" class="c-add_btn"><button>タスクを追加</button></div>

    <div class="c-modal">
      <div class="c-modal__overlay"></div>
      <div class="c-modal__body">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="タスク名を入力してください" v-model="new_title">
          <textarea name="" id="" cols="30" rows="10" placeholder="タスクの内容を入力してください" v-model="new_body"></textarea>
          <select v-model="new_workload">
            <option disabled value="">作業ボリュームを選択</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
          </select>
          <small>1→3でボリュームが大きい</small>
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
      new_body: '',
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
        this.todos = res.data
      })
    },
    async addTodo(){ //←追記
      axios.post('/api/todos',{
        title: this.new_title,
        workload: this.new_workload,
        body: this.new_body,
        user_id: this.userid
      }).then((res)=>{
        this.todos.todos.push(res.data)
        this.new_title = ''
        this.new_workload = ''
        this.new_body = ''
        
      })
    },
    async deleteTodo(id){ //←追記
      axios.delete('/api/todos/' + id ,{
        id: id
      }).then((res)=>{   
        this.todos.todos = res.data.todos
      })
    }
  },
  mounted() {
    this.createTodos()
  }
}
</script>
