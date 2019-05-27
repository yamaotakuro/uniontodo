<template>
  <header class="l-header">
    <div class="container">
      <div class="l-header__inner">
      
        <div class="l-header__logo">
          <RouterLink to="/">
            UnionTodo
          </RouterLink>
        </div>
        <div class="l-header__menu">
          <div v-if="isLogin" class="l-header__add_task">
            <button class="button">
              <i class="icon ion-md-add"></i>
              タスクを登録
            </button>
          </div>
          <span v-if="isLogin" class="l-header__name">
            {{ username }}さん
            <button class="button button--link" @click="logout">Logout</button>
          </span>
          <div v-else class="l-header__login">
            <RouterLink class="button button--link" to="/login">
              ログイン / アカウント登録
            </RouterLink>
          </div>
        </div>
      <!-- /.l-header__inner --></div>
    </div>
  </header>
</template>

<script>
export default {
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    username () {
      return this.$store.getters['auth/username']
    },
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')
      this.$router.push('/login')
    }
  }
}
</script>