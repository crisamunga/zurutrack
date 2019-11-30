<template>
  <v-dialog
    v-model="dialog"
    :fullscreen="$vuetify.breakpoint.smAndDown"
    max-width="500px"
  >
    <template v-slot:activator="{ on }">
      <v-btn tile color="primary" v-on="on">
        More <v-icon right>mdi-chevron-right</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-toolbar class="bg-primary" dark>
        <v-btn
          v-if="$vuetify.breakpoint.smAndDown"
          icon
          @click="dialog = false"
        >
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>

        <v-toolbar-title>KAA 542J</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn text><v-icon left>mdi-upload</v-icon> Save</v-btn>
        <v-btn text @click="dialog = false" v-if="$vuetify.breakpoint.mdAndUp">
          <v-icon left>mdi-close</v-icon> Close
        </v-btn>
      </v-toolbar>

      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi-format-title</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-text-field label="Name" :clearable="true"></v-text-field>
        </v-list-item-content>

        <v-list-item-action>
          <v-btn icon color="success"><v-icon>mdi-check</v-icon></v-btn>
        </v-list-item-action>
      </v-list-item>

      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi-map-marker-multiple</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-btn color="primary" text>
            Kenya Mpya Sacco
          </v-btn>
        </v-list-item-content>
        <v-list-item-action>
          <v-btn icon color="red"><v-icon>mdi-close</v-icon></v-btn>
        </v-list-item-action>
      </v-list-item>

      <v-list-item>
        <v-list-item-icon>
          <v-avatar color="red" size="32" >
            <span class="white--text">C</span>
          </v-avatar>
          <!-- <v-icon>mdi-account</v-icon> -->
        </v-list-item-icon>
        <v-list-item-content>
          <v-btn color="primary" text>
            Chris Martin Amunga
          </v-btn>
        </v-list-item-content>
        <v-list-item-action>
          <v-btn icon color="red"><v-icon>mdi-close</v-icon></v-btn>
        </v-list-item-action>
      </v-list-item>

      <v-list class="transparent">
        <v-list-item v-for="item in statistics" :key="item.day">
          <v-list-item-title>{{ item.day }}</v-list-item-title>
          <v-list-item-subtitle class="text-right">
            {{ item.temp }}
          </v-list-item-subtitle>
        </v-list-item>
      </v-list>

      <v-divider></v-divider>

      <v-card-actions>
        <v-spacer />
        <v-btn text color="primary">Save</v-btn>
        <v-btn text color="red" @click="dialog = false">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["tracker"],
  data() {
    return {
      dialog: false,
      labels: ["SU", "MO", "TU", "WED", "TH", "FR", "SA"],
      time: 0,
      statistics: [
        {
          day: "Mileage",
          temp: "1800 KM"
        },
        {
          day: "Average speed",
          temp: "50 KMPH"
        },
        { day: "Oil used", temp: "2.5 Tanks" }
      ]
    };
  }
};
</script>
