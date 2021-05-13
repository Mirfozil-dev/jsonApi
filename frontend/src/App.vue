<template>
  <div id="app">
    <p v-if="isLoading">Loading...</p>
    <table v-else border="1">
      <tr>
        <td>id</td>
        <td>name</td>
        <td>email</td>
      </tr>
      <tr v-for="item in users" :key="item.id">
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.email }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'App',
  data() {
    return {
      users: [],
      isLoading: true,
    };
  },
  mounted() {
    axios.get('http://localhost:3000/').then(r => {
      this.users = r.data;
      this.isLoading = false;
    });
  },
};
</script>

<style>
table {
  border-collapse: collapse;
}

td {
  padding: 5px;
}
</style>
