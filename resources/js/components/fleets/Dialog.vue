<template>
  <dialog-system :icon="icon" :iconLabel="iconLabel" :iconColor="iconColor">
    <template v-slot:headerLeft>
      <v-toolbar-title class="mx-5 body-2">
        <v-icon>{{icon}}</v-icon> {{iconLabel.toUpperCase()}}
      </v-toolbar-title>
    </template>

    <template v-slot:headerRight>
      <fleets-create></fleets-create>
    </template>

    <fleets-list></fleets-list>
  </dialog-system>
</template>

<script>
export default {
  data() {
    return {
      icon: "mdi-map-marker-multiple",
      iconLabel: "Fleets",
      iconColor: "blue"
    };
  }
};
</script>
