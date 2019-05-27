<template>
  <article class="p-login">
  
    <div class="container">
      <div class="p-login__inner">
      
        <ul class="p-login__tab">
          <li
            :class="{'is-act': tab === 1 }"
            @click="tab = 1"
          >ログイン</li>
          <li
            :class="{'is-act': tab === 2 }"
            @click="tab = 2"
          >登録</li>
        </ul>
        <div class="p-login__panel" v-show="tab === 1">
          <div class="panel" v-show="tab === 1">
            <form class="form" @submit.prevent="login">
              <label for="login-email">Email</label>
              <input type="text" class="form__item" id="login-email" v-model="loginForm.email">
              <label for="login-password">Password</label>
              <input type="password" class="form__item" id="login-password" v-model="loginForm.password">
              <div class="c-btn01">
                <button type="submit" class="button button--inverse">login</button>
              </div>
            </form>
          </div>
        </div>
        <div class="p-login__panel" v-show="tab === 2">
          <div class="panel" v-show="tab === 2">
            <form class="form" @submit.prevent="register">
              <label for="username">Name</label>
              <input type="text" class="form__item" id="username" v-model="registerForm.name">
              <label for="email">Email</label>
              <input type="text" class="form__item" id="email" v-model="registerForm.email">
              <label for="password">パスワード</label>
              <input type="password" class="form__item" id="password" v-model="registerForm.password">
              <label for="password-confirmation">パスワード (確認)</label>
              <input type="password" class="form__item" id="password-confirmation" v-model="registerForm.password_confirmation">
              <div class="c-btn01">
                <button type="submit" class="button button--inverse">register</button>
              </div>
            </form>
          </div>
        </div>
      <!-- /.p-login__inner --></div>
    </div>
  <!-- /.-p-login --></article>
</template>

<script>
export default {
  
  data(){
    return {
      tab:1,
      loginForm:{
        email:'',
        password:''
      },
      registerForm:{
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods:{
    async login () {
      // authストアのloginアクションを呼び出す
      await this.$store.dispatch('auth/login', this.loginForm)

      // トップページに移動する
      this.$router.push('/')
    },
    async register () {
      // authストアのresigterアクションを呼び出す
      await this.$store.dispatch('auth/register', this.registerForm)

      // トップページに移動する
      this.$router.push('/')
    }
  }
}
</script>
