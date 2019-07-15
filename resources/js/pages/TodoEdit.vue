<template>
  <div>
    <h1>タスク変種</h1>
    <table>
      <tr>
        <td><input type="text" class="form-control" placeholder="タスク名を入力してください" v-model="todos"></td>
      </tr>
      <tr>
        <td><textarea name="" id="" cols="30" rows="10" placeholder="タスクの内容を入力してください" v-model="this.body"></textarea></td>
      </tr>
      <tr>
        <td>
          <flat-pickr
            v-model="this.date"
            :config="config"
            placeholder="納期を入力"               
            name="date">
          </flat-pickr>
        </td>
      </tr>
      <tr>
        <td>
          <div class="c-common_select">
            <select v-model="this.workload">
              <option disabled value="">作業ボリュームを選択</option>
              <option value="volume1">ボリューム小</option>
              <option value="volume2">ボリューム中</option>
              <option value="volume3">ボリューム大</option>
            </select>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="c-common_select">
            <select v-model="this.progress">
              <option disabled value="">作業進捗を選択</option>
              <option value="作業前">作業前</option>
              <option value="作業中">作業中</option>
              <option value="確認中">確認中</option>
            </select>
          </div>
        </td>
      </tr>
      <input type="hidden" name="" v-model="userid">
    </table>
    <div class="todo_add_btn" v-on:click="updateTodo">タスクを編集する</div>

  </div>
</template>



<script>
import flatPickr from 'vue-flatpickr-component'
import { Japanese } from 'flatpickr/dist/l10n/ja'
import 'flatpickr/dist/flatpickr.css'
export default {
  components: { 
    flatPickr
  },
  data () {
    return {
      todos: [],
      title: '',
      workload: '',
      body: '',
      date: '',
      progress: '',
      config: {
        altFormat: 'Y/m/d',
        altInput: true,
        minDate: 'today',
        locale: Japanese,
      }, 
    }
  },
  props: {
    id: {
      type: String,
      required: true
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
      axios.get(`/api/todos/${this.id}`).then((res)=>{
        let self = this;
        self.title = res.data.title,
        self.workload = res.data.workload,
        self.body = res.data.body,
        self.date = res.data.date,
        self.progress = res.data.progress,
        self.user_id = res.data.user_id
      })
    },
    async updateTodo(){
      axios.put(`/api/todos/${this.id}`,{
        title: this.title,
        workload: this.workload,
        body: this.body,
        date: this.date,
        progress: this.progress,
        user_id: this.userid
      }).then((res)=>{
        let id = res.data.id;
        console.log(id,this.todos.todos);    
        // const index = this.todos.todos.findIndex((v) => v.id === id);
 
        // this.todos.todos.splice(index, 1, value);    
        
        // this.todos.todos.push(res.data)
      })
    },
  },
  mounted() {
    this.createTodos()
  }
}
</script>
