<template>
  <v-tooltip top>
    <template v-slot:activator="{ on }">
      <v-btn icon :dark="dark" :color="color" v-on="on" @click="onClick">
        <v-icon>
          {{ icon }}
        </v-icon>
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
    color: String
  },
  methods: {
    onClick() {
      this.$emit("click");
    }
  }
};
</script>
