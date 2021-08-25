<template>
  <v-row class="mt-1">
    <v-col v-for="n in 12" :key="n" cols="auto">
      <v-card :elevation="n - 1" height="50" width="50" class="primary">
        <v-row
          class="month fill-height"
          align="center"
          justify="center"
          v-text="n"
        ></v-row>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
export default {};
</script>

<style>
.month:hover {
  cursor: pointer;
  font-weight: 800;
}
</style>