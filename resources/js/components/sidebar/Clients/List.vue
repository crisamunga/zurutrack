<template>
  <v-list three-line dense class="pt-0">
    <v-toolbar class="mb-2 transparent py 5" flat>
          <v-text-field
            v-model="search"
            hide-details
            label="Search"
            clearable
            single-line
            prepend-inner-icon="mdi-magnify"
          ></v-text-field>
          <v-spacer></v-spacer>
          <v-btn icon><v-icon>mdi-plus</v-icon></v-btn>
          <v-btn icon><v-icon>mdi-dots-vertical</v-icon></v-btn>
        </v-toolbar>
    <v-data-iterator
      :items="clients"
      :items-per-page.sync="itemsPerPage"
      :search="search"
      :footer-props="{ itemsPerPageOptions }"
    >

      <template v-slot:default="props">
        <sidebar-clients-list-item
          v-for="(item, index) in props.items"
          :key="index"
          :title="item.title"
          :count="item.count"
        ></sidebar-clients-list-item>
      </template>
    </v-data-iterator>
  </v-list>
</template>

<script>
export default {
  data() {
    return {
      itemsPerPageOptions: [5, 10, 25, 50],
      itemsPerPage: 5,
      search: "",
      filter: {},
      clients: [
        {
          title: "Chris Martin Amunga",
          count: "4"
        }
      ]
    };
  }
};
</script>
