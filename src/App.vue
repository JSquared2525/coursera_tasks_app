<template>
  <div class="container">
    <Login
      v-if="!isLoggedIn"
      :passwordIncorrect="passwordIncorrect"
      @password_incorrect="handlePasswordIncorrect"
      @login_successful="handleSuccessfulLogin"
    />
    <Dashboard v-else />
  </div>
</template>

<script>
import Login from "./components/Login.vue";
import Dashboard from "./components/Dashboard.vue";

export default {
  name: "App",
  components: {
    Login,
    Dashboard,
  },
  data() {
    return {
      passwordIncorrect: false,
      isLoggedIn: false,
    };
  },
  methods: {
    handlePasswordIncorrect() {
      this.passwordIncorrect = true;
    },
    handleSuccessfulLogin() {
      this.isLoggedIn = true;
    },
  },
};
</script>

<style>
/* Your styles here */
</style>

