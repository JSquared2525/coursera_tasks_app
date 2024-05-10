<template>
  <div>
    <form @submit.prevent="submitForm">
      <textarea v-model="inputValue" placeholder="Enter a task"></textarea>
      <button type="submit">Add Task</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inputValue: "",
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await fetch("../php/add_task.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ task: this.inputValue }),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        this.$emit("formSubmitted");
        this.inputValue = "";
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>
textarea {
  width: 80%;
  height: 60px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

button[type="submit"] {
  display: block;
  margin-top: 10px;
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}
</style>