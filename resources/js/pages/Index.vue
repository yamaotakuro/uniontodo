<template>
  <div class="p-index">
    <h1>ユーザーリスト</h1>
    <ul class="p-index_user_list">
      <li v-for="user in users" v-bind:key="user.id">
        <router-link 
        class="link"
        :to="`/users/${user.id}`"
        >
        {{ user.name }}さんのタスクを確認
        <i class="far fa-angle-right"></i>
        </router-link> 
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data () {
    return {
      users: [],
    }
  },
  computed: {
    userid () {
      return this.$store.getters['auth/userid']
    },
  },
  methods: {
    async fetchUsers(){ 
      axios.get('/api/users').then((res)=>{
        this.users = res.data
      })
    },
    
  },
  created() {
    this.fetchUsers()
  },
}
</script>
