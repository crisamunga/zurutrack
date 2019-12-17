<template>
  <v-tooltip :top="top" :bottom="bottom" :left="left" :right="right">
    <template v-slot:activator="{ on }">
      <v-btn icon :dark="dark" :color="color" v-on="on" @click="onClick" :small="small" :large="large">
        <v-icon>{{ icon }}</v-icon>
      </v-btn>
    </template>
    {{ label }}
  </v-tooltip>
</template>

<script>
export default {
  props: {
    dark: Boolean,
    icon: String,
    label: String,
    color: String,
    left: Boolean,
    right: Boolean,
    top: Boolean,
    bottom: Boolean,
    small: Boolean,
    large: Boolean,
  },
  methods: {
    onClick() {
      this.$emit("click");
    }
  }
};
</script>
