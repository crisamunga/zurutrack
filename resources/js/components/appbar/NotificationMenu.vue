<template>
  <v-menu
    :close-on-content-click="false"
    transition="slide-y-transition"
    bottom
    :offset-y="true"
  >
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <v-badge>
          <template v-slot:badge
            >0</template
          >
          <v-icon>mdi-bell</v-icon>
        </v-badge>
      </v-btn>
    </template>
    <v-card max-width="450" class="mx-auto">
      <v-toolbar class="bg-primary" dark>
        <v-toolbar-title>Notifications</v-toolbar-title>
      </v-toolbar>

      <v-list two-line>
        <template v-for="(item, index) in items">
          <v-subheader
            v-if="item.header"
            :key="item.header"
            v-text="item.header"
          ></v-subheader>

          <v-divider
            v-else-if="item.divider"
            :key="index"
            :inset="item.inset"
          ></v-divider>

          <appbar-notification-message
            v-else
            :key="item.title"
            :avatar="item.avatar"
            :sender="item.sender"
            :message="item.message"
          ></appbar-notification-message>
        </template>
      </v-list>

      <v-card-actions>
        <v-btn block text>All notifications</v-btn>
      </v-card-actions>
    </v-card>
  </v-menu>
</template>

<script>
export default {
  data: () => ({
    items: [
      { header: "Today" },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
        sender: "Brunch this weekend?",
        message:
          "I'll be in your neighborhood doing errands this weekend. Do you want to hang out?"
      },
      { divider: true, inset: true },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
        sender: "Summer BBQ",
        message: "Wish I could come, but I'm out of town this weekend."
      },
      { divider: true, inset: true },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
        sender: "Oui oui",
        message: "Do you have Paris recommendations? Have you ever been?"
      },
      { divider: true, inset: true },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
        sender: "Birthday gift",
        message:
          "Have any ideas about what we should get Heidi for her birthday?"
      },
      { divider: true, inset: true },
      {
        avatar: "https://cdn.vuetifyjs.com/images/lists/5.jpg",
        sender: "Recipe to try",
        message: "We should eat this: Grate, Squash, Corn, and tomatillo Tacos."
      }
    ]
  })
};
</script>
