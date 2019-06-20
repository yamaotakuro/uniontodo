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
          <ul class="gnavi">
            <li v-if="isLogin">
              <RouterLink to="/todos" tag="a">
                タスクの追加・削除
              </RouterLink>
            </li>
            <!-- <li>
              <RouterLink to="/users" tag="a">
                ユーザーリスト
              </RouterLink>
            </li> -->
          <!-- /.gnavi --></ul>
          <div class="l-header__account_info">
            <div v-if="isLogin" class="l-header__logout">
              <span  class="l-header__name">
                こんにちは{{ username }}さん
              </span>
              <div class="c-btn01">
                <button @click="logout">ログアウト</button>
              </div>
            </div>
            <div v-else class="l-header__login">
              <div class="c-btn01">
                <RouterLink to="/login">
                  ログイン / アカウント登録
                </RouterLink>
              </div>
            </div>
          <!-- /.l-header_account_info --></div>
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
    userid () {
      return this.$store.getters['auth/userid']
    },
    apiStatus () {
      return this.$store.state.auth.apiStatus
    },
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')
      if (this.apiStatus) {
        this.$router.push('/login')
      }
    }
  }
}
</script>