<template>
  <div>
    <div class="p-acount_info">
      <h1>アカウント設定</h1>
      <table>
        <tr>
          <th>ID</th>
          <td>{{user.id}}</td>
        </tr>
        <tr>
          <th>お名前</th>
          <td>{{user.name}}</td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>{{user.email}}</td>
        </tr>
      </table>
    <!-- /.p-acount_info --></div>
    <div class="u-right">
      <div class="c-btn02" v-on:click="deleteUser"><button>アカウント削除</button></div>
    </div>
  </div>
</template>


<script>
export default {
  data () {
    return {
      user: [],
    }
  },
  computed: {
    userid () {
      return this.$store.getters['auth/userid']
    },
    apiStatus () {
      return this.$store.state.auth.apiStatus
    },
  },
  methods: {
    async fetchUser(){
      axios.get(`/api/users/${this.userid}`).then((res)=>{
        this.user = res.data
      })
    },
    async deleteUser(){
      axios.delete(`/api/users/${this.userid}`).then((res)=>{
        this.$store.dispatch('auth/logout')
        this.$router.push('/login')
      })
    },
    
  },
  created() {  //←インスタンス生成時にfetchUser()を実行したいので、createdフックに登録します。
    this.fetchUser()
  },
}
</script>
