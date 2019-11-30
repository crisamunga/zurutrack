<template>
  <v-list-item>
    <v-list-item-avatar>
      <v-avatar color="teal" size="48">
        <span class="white--text">C</span>
      </v-avatar>
    </v-list-item-avatar>

    <v-list-item-content>
      <v-list-item-title class="text-uppercase">{{title}}</v-list-item-title>
      <v-list-item-subtitle>am.martin.ac@gmail.com</v-list-item-subtitle>
      <v-list-item-subtitle class="caption">{{count}} Trackers</v-list-item-subtitle>
    </v-list-item-content>
  </v-list-item>
</template>

<script>
export default {
  props: ['title', 'count']
}
</script>