<template>
  <v-container fluid fill-height class="pa-0">
    <v-row class="pa-0" style="height: 100%;">
      <v-col md="8" cols="12" class="pa-0 bg-spinning-earth">
        <v-container fill-height class="justify-center">
          <v-card dark flat class="px-2 transparent" max-width="800px">
            <v-card-title
              class="display-1 font-weight-light mb-5 justify-center"
              >Zuru Track</v-card-title
            >
            <v-card-text>
              <v-form ref="form">
                <v-text-field
                  outlined
                  rounded
                  label="Name"
                  v-model="name"
                  :rules="nameRules"
                  :error-messages="errors.name"
                ></v-text-field>

                <v-text-field
                  outlined
                  rounded
                  label="E-mail"
                  v-model="email"
                  :rules="emailRules"
                  :error-messages="errors.email"
                ></v-text-field>

                <v-text-field
                  outlined
                  rounded
                  name="name"
                  label="Password"
                  hint="At least 8 characters"
                  min="8"
                  v-model="password"
                  :rules="passwordRules"
                  :error-messages="errors.password"
                  type="password"
                ></v-text-field>

                <v-text-field
                  outlined
                  rounded
                  label="Confirm password"
                  :rules="confirmPasswordRules"
                  :error-messages="errors.password_confirmation"
                  v-model="password_confirmation"
                  type="password"
                ></v-text-field>
              </v-form>
            </v-card-text>
            <v-card-text class="text-center"
              >By signing up, you agree to our terms and conditions</v-card-text
            >
            <v-card-actions class="justify-center my-10">
              <v-btn
                large
                bordered
                rounded
                outlined
                class="px-10"
                color="light"
                @click="onSubmit"
                >Register</v-btn
              >
            </v-card-actions>
            <v-card-actions>
              <v-btn small text class="mx-5 px-5" color="light"
                >Terms & conditions</v-btn
              >
              <v-spacer></v-spacer>
              <v-btn small text class="mx-5 px-5" color="light" href="/login"
                >Log in</v-btn
              >
            </v-card-actions>
          </v-card>
        </v-container>
      </v-col>
      <v-col
        md="4"
        cols="12"
        class="pa-0 d-none d-xl-block d-lg-block d-md-block bg-secondary"
        style="height: 100%;"
      >
        <v-container fill-height class="justify-space-around">
          <v-card dark class="transparent text-center" flat>
            <v-card-title
              class="display-2 font-weight-light my-10 justify-center"
              >Sign up!</v-card-title
            >
            <v-card-text class="title font-weight-light my-10"
              >Already have an account? Sign in now</v-card-text
            >
            <v-card-actions class="justify-center my-10">
              <v-btn
                large
                rounded
                outlined
                class="px-10"
                color="light"
                href="/login"
                >Log in</v-btn
              >
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
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      errors: {},
      emailRules: [v => validators.required(v), v => validators.email(v)],
      nameRules: [v => validators.required(v)],
      passwordRules: [
        v => validators.required(v),
        v => validators.minLength(v, 8)
      ],
      confirmPasswordRules: [
        v => validators.required(v),
        v => validators.match(v, this.password, "Passwords do not match")
      ]
    };
  },
  methods: {
    onSubmit() {
      if (this.$refs.form.validate()) {
        this.$store
          .dispatch("auth/register", {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
          })
          .then(result => {
            window.location.href = "/";
            this.errors = {};
          })
          .catch(err => {
            this.errors = err.data.errors;
          });
      }
    }
  }
};
</script>
