<template>
  <div class="dashboard">
    <FilterBar
      class="filter-bar"
      :filter="filter"
      :search="search"
      @filter-change="updateFilter"
      @search-change="updateSearch"
    />
    <div class="row">
      <TaskCard @formSubmitted="handleNewTask" class="card" />
      <TaskTable class="card" :filter="filter" :search="search" />
    </div>
  </div>
</template>

<script>
import FilterBar from "./FilterBar.vue";
import TaskTable from "./TaskTable.vue";
import TaskCard from "./TaskCard.vue";

export default {
  name: "Dashboard",
  components: {
    FilterBar,
    TaskCard,
    TaskTable,
  },
  data() {
    return {
      filter: "all",
      search: "",
    };
  },
  methods: {
    handleNewTask() {
      const currentFilter = this.filter;
      this.filter = null;
      this.$nextTick(() => {
        this.filter = currentFilter;
      });
    },
    updateFilter(newFilter) {
      this.filter = newFilter;
    },
    updateSearch(newSearch) {
      this.search = newSearch;
    },
  },
};
</script>

<style scoped>
.dashboard {
  display: flex;
  flex-direction: column;
}

.filter-bar {
  order: -1;
}
.row {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
.card {
  width: 50%;
}
</style>
