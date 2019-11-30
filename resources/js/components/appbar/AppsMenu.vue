<template>
  <v-menu
    transition="slide-y-transition"
    bottom
    :allow-overflow="true"
    :close-on-content-click="false"
    :offset-y="true"
    :offset-x="true"
  >
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <v-icon>mdi-apps</v-icon>
      </v-btn>
    </template>
    <v-card width="400" class="text-left">
      <v-toolbar class="bg-primary" dark>
        <v-toolbar-title>Access</v-toolbar-title>
      </v-toolbar>

      <v-row class="mt-2">
        <v-col cols="4" class="text-center">
          <trackers-list>
            <template v-slot:activator="{ on }">
              <v-btn fab dark color="black" v-on="on">
                <v-icon>mdi-chip</v-icon>
              </v-btn>
              <div class="caption py-2">
                Trackers
              </div>
            </template>
          </trackers-list>
        </v-col>

        <v-col cols="4" class="text-center">
          <fleets-dialog></fleets-dialog>
        </v-col>

        <v-col
          cols="4"
          v-for="(item, index) in items"
          :key="index"
          class="text-center"
        >
          <v-btn fab dark :color="item.color">
            <v-icon>{{ item.icon }}</v-icon>
          </v-btn>
          <div class="caption py-2">
            {{ item.title }}
          </div>
        </v-col>
      </v-row>
    </v-card>
  </v-menu>
</template>

<script>
export default {
  data() {
    return {
      items: [
        { icon: "mdi-account", title: "Clients", color: "teal" },
        { icon: "mdi-chart-bar", title: "Reports", color: "purple" },
        { icon: "mdi-account", title: "Users", color: "red" }
      ]
    };
  }
};
</script>
