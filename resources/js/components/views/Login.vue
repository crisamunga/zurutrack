<template>
  <v-container fluid fill-height class="pa-0">
    <v-row class="pa-0" style="height: 100%;">
      <v-col
        md="4"
        cols="12"
        class="pa-0 d-none d-xl-block d-lg-block d-md-block bg-secondary"
        style="height: 100%;"
      >
        <v-container fill-height class="justify-space-around">
          <v-card dark class="transparent text-center" flat>
            <v-card-title class="display-2 font-weight-light my-10 justify-center">Welcome back!</v-card-title>
            <v-card-text class="title font-weight-light my-10">
              Don't have an account yet? Create one and start
              tracking your vehicles and assets today
            </v-card-text>
            <v-card-actions class="justify-center my-10">
              <v-btn large rounded outlined class="px-10" color="light" href="/register">Sign up</v-btn>
            </v-card-actions>
          </v-card>
        </v-container>
      </v-col>
      <v-col md="8" cols="12" class="pa-0 bg-spinning-earth" style="height: 100%;">
        <v-container fill-height class="justify-center">
          <v-card dark flat class="py-10 px-2 transparent" max-width="500px">
            <v-card-title class="display-2 font-weight-light my-10 justify-center">Zuru Track</v-card-title>
            <v-card-text>
              <v-form ref="form">
                <v-text-field outlined rounded label="E-mail" :rules="emailRules" v-model="email"></v-text-field>

                <v-text-field
                  outlined
                  rounded
                  name="name"
                  label="Enter your password"
                  :rules="passwordRules"
                  v-model="password"
                  type="password"
                ></v-text-field>
              </v-form>
              <v-alert type="error" v-if="error" class="bg-error">{{ error }}</v-alert>
            </v-card-text>
            <v-card-actions class="justify-center my-10">
              <v-btn
                large
                bordered
                rounded
                outlined
                class="px-10"
                color="light"
                @click="onSubmit"
              >Log in</v-btn>
            </v-card-actions>
            <v-card-actions>
              <v-btn small text class="mx-5 px-5" color="light">Forgot Password</v-btn>
              <v-spacer></v-spacer>
              <v-btn small text class="mx-5 px-5" color="light" href="/register">Register</v-btn>
            </v-card-actions>
          </v-card>
        </v-container>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import validators from "../../utils/validators";

export default {
  data() {
    return {
      center: "center",
      email: "",
      password: "",
      emailRules: [v => validators.required(v), v => validators.email(v)],
      passwordRules: [v => validators.required(v)],
      error: ""
    };
  },
  methods: {
    onSubmit() {
      if (this.$refs.form.validate()) {
        this.$store
          .dispatch("auth/login", {
            email: this.email,
            password: this.password
          })
          .then(result => {
            this.error = null;
            window.location.href = "/";
          })
          .catch(err => {
            this.error = err.data.message;
          });
      }
    },
    validateRequired(v, message) {
      return !!v || message || "This field is required";
    }
  }
};
</script>
