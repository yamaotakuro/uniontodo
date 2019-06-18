<template>
  <div>
    <h1>{{user.name}}さん</h1>
    <h2>Todoリスト</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>タスク名</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="todo in user['todos']" v-bind:key="todo.id">
          <td>{{ todo.id }}</td>
          <td>{{ todo.title }} <span>作業ボリューム {{ todo.workload }}</span></td>
        </tr>
      </tbody>
    </table>
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
  // computed: {
  //   userid () {
  //     return this.$store.getters['auth/userid']
  //   },
  // },
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
