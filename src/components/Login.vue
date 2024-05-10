
<template>
  <div class="center-container">
    <div class="form-holder">
      <form id="loginform" @submit.prevent="login">
        <img src="../assets/logo.png" alt="logo" class="logo" />
        <input
          class="form-control input-lg"
          type="text"
          id="login"
          name="login"
          v-model="userCredentials.login"
          placeholder="Login"
        />
        <input
          type="password"
          id="pass"
          name="pass"
          v-model="userCredentials.password"
          placeholder="Password"
        />
        <input type="submit" value="LOGIN" id="loginbtn" />
      </form>
      <p v-if="passwordIncorrect" class="warning">
        Password Incorrect! Please try again!
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  props: {
    passwordIncorrect: Boolean,
  },
  data() {
    return {
      userCredentials: {
        login: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      fetch("../php/login.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.userCredentials),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(
              "Network response was not ok: " + response.statusText
            );
          }
          return response.text();
        })
        .then((text) => {
          if (text === "success") {
            this.$emit("login_successful");
          } else {
            this.$emit("password_incorrect");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    },
  },
};
</script>

<style scoped>
.center-container {
  min-height: 100%; /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one :-)       */
  display: flex;
  align-items: center;
  justify-content: center;
}

.form-holder {
  width: 75%;
  display: inline-block;
  text-align: center;
  background-color: white;
  border-radius: 2px;
  box-shadow: 1px 1px 5px 1px #d3d3d3, -0.5px -0.5px 5px 0.5px #d3d3d3;
  margin: 0px;
  padding: 20px;
  max-width: 50%;
}

#login {
  border-bottom: 0.5px solid gray;
  border-top: 0px;
  border-left: 0px;
  border-right: 0px;
  width: 100%;
  height: 30px;
  padding: 15px 10px;
  margin: 8px 0;
  box-sizing: border-box;
  font-size: medium;
}

#pass {
  border-bottom: 0.5px solid gray;
  border-top: 0px;
  border-left: 0px;
  border-right: 0px;
  height: 30px;
  width: 100%;
  padding: 15px 10px;
  margin: 8px 0;
  box-sizing: border-box;
  font-size: medium;
}

#loginbtn:active {
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

#loginbtn {
  background-color: #007bff;
  width: 100%;
  border-radius: 2px;
  border: none;
  color: white;
  font-size: medium;
  padding: 10px 24px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  box-shadow: 0.5px 0.5px 5px 1px #d3d3d3, -0.5px -0.5px 5px 0.5px #d3d3d3;
  margin-top: 20px;
  margin-bottom: 20px;
}
#loginbtn:hover {
  cursor: pointer;
}

.logo {
  width: 250px; /* Adjust as needed */
  height: 250px; /* Adjust as needed */
}

.warning {
  color: red;
  font-size: medium;
}
</style>