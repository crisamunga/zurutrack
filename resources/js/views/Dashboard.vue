<template>
  <v-container fluid fill-height class="ma-0 pa-0 bg-light">
    
  </v-container>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  methods: {
     ...mapActions({
      getTrackers: 'trackers/index' // map `this.add()` to `this.$store.dispatch('increment')`
    })
  },
  mounted() {
    this.getTrackers()
  },
};
</script>
