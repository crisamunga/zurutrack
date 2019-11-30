<template>
  <v-list-item>
    <v-list-item-avatar>
      <v-img :src="avatar"></v-img>
    </v-list-item-avatar>

    <v-list-item-content>
      <v-list-item-title v-html="sender"></v-list-item-title>
      <v-list-item-subtitle v-html="message"></v-list-item-subtitle>
    </v-list-item-content>
  </v-list-item>
</template>

<script>
export default {
  props: ["avatar", "sender", "message"]
};
</script>
