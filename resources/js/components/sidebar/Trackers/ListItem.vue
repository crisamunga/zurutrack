<template>
  <v-list-item three-line>
    <v-list-item-avatar>
      <v-avatar class="elevation-3">
        <v-icon :class="iconClass">mdi-chip</v-icon>
      </v-avatar>
    </v-list-item-avatar>

    <v-list-item-content>
      <v-list-item-title class="text-uppercase body-2">
        {{ name }}
      </v-list-item-title>
      <v-list-item-subtitle class="text-uppercase caption">{{
        this.tracker.client || "No client"
      }}</v-list-item-subtitle>
      <v-list-item-subtitle class="overline">
        Expires on
        <span :class="getExpiresOnColor(tracker.expires_on)">
          {{ this.tracker.expires_on }}
        </span>
      </v-list-item-subtitle>
    </v-list-item-content>

    <v-list-item-action>
      <v-list-item-action-text>
        <v-tooltip
          right
          v-if="this.tracker.fleet && this.tracker.fleet.length > 10"
        >
          <template v-slot:activator="{ on }">
            <span text v-on="on">{{
              tracker.fleet.substring(0, 10) + "..."
            }}</span>
          </template>
          <span>{{ this.tracker.fleet }}</span>
        </v-tooltip>
        <span v-else>{{ this.tracker.fleet }}</span>
      </v-list-item-action-text>

      <div class="text-center">
        <v-menu
          v-model="menu"
          :close-on-click="false"
          :close-on-content-click="false"
          :nudge-width="200"
          offset-x
        >
          <template v-slot:activator="{ on }">
            <v-btn color="indigo" dark v-on="on" icon>
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </template>

          <v-card width="400" height="700" dark class="bg-secondary">
            <v-toolbar dark color="bg-secondary" extension-height="80">
              <v-toolbar-title>{{ name }}</v-toolbar-title>
              <v-spacer></v-spacer>

              <buttons-hover-icon icon="mdi-delete" label="Delete" />

              <buttons-hover-icon icon="mdi-map-marker" label="Locate" />

              <buttons-hover-icon
                icon="mdi-close"
                label="Close"
                @click="menu = false"
              />

              <template v-slot:extension>
                <v-tabs
                  v-model="tab"
                  background-color="transparent"
                  centered
                  dark
                  icons-and-text
                  grow
                >
                  <v-tab href="#tab-1" class="caption">
                    Statistics
                    <v-icon>mdi-chart-line</v-icon>
                  </v-tab>

                  <v-tab href="#tab-2" class="caption">
                    Alerts
                    <v-icon>mdi-bell</v-icon>
                  </v-tab>

                  <v-tab href="#tab-3" class="caption">
                    Settings
                    <v-icon>mdi-settings</v-icon>
                  </v-tab>

                  <v-tab href="#tab-4" class="caption">
                    Details
                    <v-icon>mdi-pencil</v-icon>
                  </v-tab>
                </v-tabs>
              </template>
            </v-toolbar>

            <v-tabs-items v-model="tab" dark class="bg-secondary">
              <v-tab-item value="tab-1">
                {{ name }}
              </v-tab-item>

              <v-tab-item value="tab-2">
                {{ name }}
              </v-tab-item>

              <v-tab-item value="tab-3">
                <v-list class="transparent">
                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle
                        class="subtitle-1 font-weight-light"
                      >
                        COMMANDS
                      </v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action>
                      <v-btn icon><v-icon>mdi-information</v-icon></v-btn>
                    </v-list-item-action>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Geofence</v-list-item-subtitle>
                      <v-list-item-title>
                        <v-btn text>
                          <v-icon left>mdi-map-marker-circle</v-icon> Add
                          geofence
                        </v-btn>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Checkpoints</v-list-item-subtitle>
                      <v-list-item-title>
                        <v-btn text>
                          <v-icon left>mdi-map-marker-radius</v-icon> Add
                          checkpoint
                        </v-btn>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>
                        Engine control
                      </v-list-item-subtitle>
                      <v-list-item-title>
                        <v-btn text>
                          <v-icon left>mdi-engine</v-icon> Start Engine
                        </v-btn>
                        <v-btn text>
                          <v-icon left>mdi-engine-outline</v-icon> Stop Engine
                        </v-btn>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Tracking</v-list-item-subtitle>
                      <v-list-item-title>
                        <v-btn text>
                          <v-icon left>mdi-map-marker</v-icon> Enable
                        </v-btn>
                        <v-btn text>
                          <v-icon left>mdi-map-marker-outline</v-icon> Disable
                        </v-btn>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-subheader>Settings</v-subheader>

                  <v-list-item>
                    <v-list-item-action>
                      <v-switch v-model="notification" />
                    </v-list-item-action>
                    <v-list-item-title>Enable notifications</v-list-item-title>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-action>
                      <v-switch v-model="hints" />
                    </v-list-item-action>
                    <v-list-item-title>Weekly reports</v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-tab-item>

              <v-tab-item value="tab-4">
                <v-list class="transparent">
                  <v-list-item>
                    <v-list-item-content>
                      <v-text-field
                        name="name"
                        label="Name"
                        v-model="name"
                      ></v-text-field>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Model</v-list-item-subtitle>
                      <v-list-item-title>
                        {{ this.tracker.model }}
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Serial</v-list-item-subtitle>
                      <v-list-item-title>
                        {{ this.tracker.serial }}
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Added on</v-list-item-subtitle>
                      <v-list-item-title>
                        {{ this.tracker.added_on }}
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>


                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Expires on</v-list-item-subtitle>
                      <v-list-item-title>
                        {{ this.tracker.expires_on }}
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Fleet</v-list-item-subtitle>
                      <v-list-item-title>
                        {{ this.tracker.fleet || "No fleet set" }}
                      </v-list-item-title>
                    </v-list-item-content>
                    <buttons-hover-icon icon="mdi-pencil" label="Edit" />
                    <buttons-hover-icon
                      icon="mdi-delete"
                      label="Delete"
                      color="red"
                    />
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-subtitle>Client</v-list-item-subtitle>
                      <v-list-item-title>
                        {{ this.tracker.client || "No client set" }}
                      </v-list-item-title>
                    </v-list-item-content>
                    <buttons-hover-icon icon="mdi-pencil" label="Edit" />
                    <buttons-hover-icon
                      icon="mdi-delete"
                      label="Delete"
                      color="red"
                    />
                  </v-list-item>

                  <v-list-item class="mt-3">
                    <v-spacer></v-spacer>
                    <v-btn text><v-icon left>mdi-upload</v-icon> Save</v-btn>
                  </v-list-item>
                </v-list>
              </v-tab-item>
            </v-tabs-items>
            <!-- 
            <v-list class="transparent">
              <v-subheader>Commands</v-subheader>

              <v-list-item>
                <v-list-item-content>
                  <v-list-item-subtitle>Geofence</v-list-item-subtitle>
                  <v-list-item-title>
                    <v-btn text>Add geofence</v-btn>
                  </v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-btn icon><v-icon>mdi-information</v-icon></v-btn>
                </v-list-item-action>
              </v-list-item>

              <v-list-item>
                <v-list-item-content>
                  <v-list-item-subtitle>Checkpoints</v-list-item-subtitle>
                  <v-list-item-title>
                    <v-btn text>Add checkpoint</v-btn>
                  </v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-btn icon><v-icon>mdi-information</v-icon></v-btn>
                </v-list-item-action>
              </v-list-item>

              <v-list-item>
                <v-list-item-content>
                  <v-list-item-subtitle>Engine control</v-list-item-subtitle>
                  <v-list-item-title>
                    <v-btn text>Start Engine</v-btn>
                    <v-btn color="red" text>Stop Engine</v-btn>
                    <v-btn icon><v-icon>mdi-information</v-icon></v-btn>
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>

              <v-list-item>
                <v-list-item-content>
                  <v-list-item-subtitle>Tracking</v-list-item-subtitle>
                  <v-list-item-title>
                    <v-btn text>Enable</v-btn>
                    <v-btn color="red" text>Disable</v-btn>
                  </v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-btn icon><v-icon>mdi-information</v-icon></v-btn>
                </v-list-item-action>
              </v-list-item>

              <v-subheader>Settings</v-subheader>

              <v-list-item>
                <v-list-item-action>
                  <v-switch v-model="notification" color="purple"></v-switch>
                </v-list-item-action>
                <v-list-item-title>Enable notifications</v-list-item-title>
              </v-list-item>

              <v-list-item>
                <v-list-item-action>
                  <v-switch v-model="hints" color="purple"></v-switch>
                </v-list-item-action>
                <v-list-item-title>Weekly reports</v-list-item-title>
              </v-list-item>
            </v-list> -->
          </v-card>
        </v-menu>
      </div>
    </v-list-item-action>
  </v-list-item>
</template>

<script>
export default {
  props: {
    tracker: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      tab: null,
      fav: false,
      menu: false,
      notification: false,
      hints: true,
      name: "",
      model: "",
      serial: "",
      sim: "",
      models: ["Noran 008", "Coban 102"]
    };
  },
  computed: {
    iconClass() {
      return this.tracker.state.toLowerCase() == "active"
        ? "green--text"
        : "red--text";
    }
  },
  methods: {
    getColor(state) {
      return state.toLowerCase() == "active" ? "primary" : "red";
    },
    getExpiresOnColor(date) {
      return this.expired(date) ? "primary--text" : "red--text";
    },
    expired(date) {
      return new Date(date) > new Date();
    },
    initCurrentValues() {
      this.name = this.tracker.name;
      this.model = this.tracker.model;
      this.serial = this.tracker.serial;
      this.sim = this.tracker.sim;
    }
  },
  mounted() {
    this.initCurrentValues();
  }
};
</script>

<style lang="css" scoped>
.bg-light {
  background-color: #ffeeff
}
</style>
