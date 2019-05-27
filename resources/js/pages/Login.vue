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
              <table>
                <tr>
                  <th>メールアドレス</th>
                  <td><input type="text" class="form__item" id="login-email" v-model="loginForm.email"></td>
                </tr>
                <tr>
                  <th>パスワード</th>
                  <td><input type="password" class="form__item" id="login-password" v-model="loginForm.password"></td>
                </tr>
              </table>
              <div class="c-btn01">
                <button type="submit" class="button button--inverse">ログイン</button>
              </div>
            </form>
          </div>
        </div>
        <div class="p-login__panel" v-show="tab === 2">
          <div class="panel" v-show="tab === 2">
            <form class="form" @submit.prevent="register">
              <table>
                <tr>
                  <th>名前</th>
                  <td><input type="text" class="form__item" id="username" v-model="registerForm.name"></td>
                </tr>
                <tr>
                  <th>メールアドレス</th>
                  <td><input type="text" class="form__item" id="email" v-model="registerForm.email"></td>
                </tr>
                <tr>
                  <th>パスワード</th>
                  <td><input type="password" class="form__item" id="password" v-model="registerForm.password"></td>
                </tr>
                <tr>
                  <th>パスワード (確認)</th>
                  <td><input type="password" class="form__item" id="password-confirmation" v-model="registerForm.password_confirmation"></td>
                </tr>
              </table>
              
              <div class="c-btn01">
                <button type="submit" class="button button--inverse">登録</button>
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
