<template>
  <div>
    <h1>現在のタスク一覧</h1>
    <div class="c-todo_list">
      <div class="row">
        <div class="col-sm-4" v-for="todo in todos['todos']" v-bind:key="todo.id">
          <div class="c-todo_list__card">
            <h3>{{ todo.title }}</h3>
            <div class="c-todo_list__inner">
              <p>作業内容 {{ todo.body }}</p>
              <div class="c-btn01"><button v-on:click="deleteTodo(todo.id)">完了</button></div>
            <!-- /.c-todo_list__inner --></div>
          </div>
        </div>
      </div>
    <!-- /.c-todo_list --></div>
    
    <div v-if="isLogin" class="p-todo_add_btn" @click="openModal"><span><i class="far fa-plus"></i></span></div>


    <Modal @close="closeModal" v-if="modal">
      <div class="c-modal__inner">
        <table>
          <tr>
            <td><input type="text" class="form-control" placeholder="タスク名を入力してください" v-model="new_title"></td>
          </tr>
          <tr>
            <td><textarea name="" id="" cols="30" rows="10" placeholder="タスクの内容を入力してください" v-model="new_body"></textarea></td>
          </tr>
          <tr>
            <td>
              <div class="c-common_select">
                <select v-model="new_workload">
                  <option disabled value="">作業ボリュームを選択</option>
                  <option value="volume1">ボリューム小</option>
                  <option value="volume2">ボリューム中</option>
                  <option value="volume3">ボリューム大</option>
                </select>
              </div>
            </td>
          </tr>
          <input type="hidden" name="" v-model="userid">
        </table>
        <div class="todo_add_btn" v-on:click="addTodo">タスクを登録する</div>
      </div>
    </Modal>
  </div>
</template>


<script>
import Modal from '../components/Modal.vue'
export default {
  components: { Modal },
  data () {
    return {
      todos: [],
      new_title: '',
      new_workload: '',
      new_body: '',
      modal: false,
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
        this.closeModal()
      })
    },
    async deleteTodo(id){ //←追記
      axios.delete('/api/todos/' + id ,{
        id: id
      }).then((res)=>{   
        this.todos.todos = res.data.todos
        this.closeModal()
      })
    },
    openModal() {
      this.modal = true
    },
    closeModal() {
      this.modal = false
    },
  },
  mounted() {
    this.createTodos()
  }
}
</script>
