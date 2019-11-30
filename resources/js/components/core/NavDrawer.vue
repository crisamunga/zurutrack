<template>
  <v-navigation-drawer v-model="drawer" width="300" app dark class="bg-secondary">
    <template v-slot:prepend>
      <v-toolbar flat color="transparent">
        <v-btn icon class="hidden-xs-only">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>

        <v-toolbar-title>Dashboard</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon class="hidden-xs-only">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-toolbar>
    </template>
    <v-list
        nav
      >
        <v-list-item-group v-model="item">
          <v-list-item
            v-for="(item, i) in tracking"
            :key="i"
          >
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="item.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>

        <v-divider></v-divider>

        <v-list-item-group v-model="item" >
          <v-list-item
            v-for="(item, i) in reseller"
            :key="i"
          >
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="item.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>

        <v-divider></v-divider>

        <v-list-item-group v-model="item" >
          <v-list-item
            v-for="(item, i) in admin"
            :key="i"
          >
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="item.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  data() {
    return {
      drawer: null,
      tracking: [
        { icon: 'mdi-car', iconClass: 'indigo lighten-1 white--text', title: 'Vehicles', subtitle: 'Manage your vehicles' },
        { icon: 'mdi-car-multiple', iconClass: 'green darken-1 white--text', title: 'Fleets', subtitle: 'Organize and manage your fleets' },
        { icon: 'mdi-truck-trailer', iconClass: 'red darken-1 white--text', title: 'Assets', subtitle: 'Manage your assets' },
      ],
      reseller: [
        { icon: 'mdi-account', iconClass: 'blue white--text', title: 'Clients', subtitle: 'Manage your clients' },
        { icon: 'mdi-chip', iconClass: 'black white--text', title: 'Trackers', subtitle: 'Manage your trackers' },
      ],
      admin: [
        { icon: 'mdi-account-multiple', iconClass: 'cyan white--text', title: 'Users', subtitle: 'Manage users' },
        { icon: 'mdi-server', iconClass: 'orange darken-2 white--text', title: 'System', subtitle: 'Manage the system' },
      ],
    };
  }
};
</script>
