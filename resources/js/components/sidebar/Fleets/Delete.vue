<template>
  <v-card class="mx-auto transparent" flat>
    <v-list-item>
      <v-list-item-content class="text-center">
        <h4>Are you sure you want to delete fleet</h4>
        <h4>{{fleet.name}}</h4>
      </v-list-item-content>
    </v-list-item>

    <v-card-actions>
      <v-spacer />
      <v-btn text @click="save">Confirm delete</v-btn>
      <v-btn text @click="cancel">Cancel</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: {
    fleet: {
      type: Object,
      required: false
    }
  },
  methods: {
    save() {
      this.$emit("done");
    },
    cancel() {
      this.$emit("done");
    }
  }
};
</script>
