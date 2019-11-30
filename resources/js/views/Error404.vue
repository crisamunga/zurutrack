<template>
  <v-container
    fill-height
    fluid
    class="justify-center bg-secondary bg-spinning-earth"
  >
    <v-card dark class="transparent text-center" flat>
      <v-card-title class="display-2 font-weight-light my-10 justify-center"
        >Page not found!</v-card-title
      >
      <v-card-text class="title font-weight-light my-10"
        >404 Error :(</v-card-text
      >
      <v-card-text class="font-weight-light my-10"
        >We can't find the page you're looking for</v-card-text
      >
      <v-card-actions class="justify-center my-10">
        <v-btn large rounded outlined class="px-10" color="light" to="/"
          >Back to home page</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
export default {};
</script>
