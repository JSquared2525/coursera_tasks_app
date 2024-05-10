<template>
  <div class="container">
    <div class="row">
      <div class="input-group">
        <select name="status" id="status" v-model="internalFilter">
          <option disabled selected value>Choose Status</option>
          <option value="open">Open</option>
          <option value="complete">Complete</option>
          <option value="all">All</option>
        </select>
        <label for="status">Status</label>
      </div>
      <div id="task-filter" class="input-group">
        <input
          type="text"
          name="filter-task"
          id="filter-task"
          v-model="internalSearch"
        />
        <label for="filter-task">Search Tasks</label>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FilterBar",
  props: {
    filter: String,
    search: String,
  },
  data() {
    return {
      internalFilter: this.filter,
      internalSearch: this.search,
    };
  },
  watch: {
    internalFilter(newVal) {
      this.$emit("filter-change", newVal);
    },
    internalSearch(newVal) {
      this.$emit("search-change", newVal);
    },
  },
};
</script>



<style scoped>
.container {
  width: 90%;
  margin: auto;
  padding: 10px;
}
.row {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.input-group {
  display: flex;
  flex-direction: column;
  margin: 10px;
  width: 50%;
}

select,
input[type="text"] {
  border: 0.5px solid gray;
  height: 40px;
  padding: 5px 10px;
  margin: 8px 0px;
  box-sizing: border-box;
}
</style>
