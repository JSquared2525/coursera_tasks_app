<template>
  <table>
    <thead>
      <tr>
        <th>Task</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(task, index) in tasks" :key="index">
        <td>
          <p>{{ task.task }}</p>
        </td>
        <td>
          <button
            @click="updateTask(task, index)"
            style="
              background-color: #007bff;
              color: white;
              padding: 10px 20px;
              border: none;
              border-radius: 3px;
              cursor: pointer;
            "
          >
            ✓
          </button>
        </td>
        <td>
          <button
            @click="deleteTask(task, index)"
            style="
              background-color: red;
              color: white;
              padding: 10px 20px;
              border: none;
              border-radius: 3px;
              cursor: pointer;
              font-weight: boldest;
            "
          >
            X
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "TaskTable",
  props: ["filter", "search"],
  data() {
    return {
      tasks: [],
    };
  },
  watch: {
    filter(newFilter, oldFilter) {
      console.log("Filter changed from", oldFilter, "to", newFilter);
      this.getTasks();
    },
    search(newSearch, oldSearch) {
      console.log("Search changed from", oldSearch, "to", newSearch);
      this.getTasks();
    },
  },
  async mounted() {
    this.getTasks();
  },
  methods: {
    async getTasks() {
      try {
        const response = await fetch("../php/get_tasks.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ filter: this.filter, search: this.search }),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        this.tasks = await response.json();
        console.log(this.tasks);
      } catch (error) {
        console.error(error);
      }
    },
    async updateTask(task, index) {
      try {
        const response = await fetch("../php/mark_task_complete.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ id: task.id }),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        this.getTasks();
      } catch (error) {
        console.error(error);
      }
    },
    async deleteTask(task, index) {
      try {
        const response = await fetch("../php/delete_task.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ id: task.id }),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        this.getTasks();
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}

table,
th,
td {
  border: 1px solid black;
}

th,
td {
  padding: 15px;
  text-align: left;
}

table td:nth-child(2),
table td:nth-child(3) {
  width: 1%;
  white-space: nowrap;
}
</style>