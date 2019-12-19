<template>
  <v-dialog v-model="dialog" width="600">
    <template v-slot:activator="{ on }">
      <slot :on="on" />
    </template>

    <v-card class="pb-5 mx-auto" :loading="loading">
      <v-toolbar dark class="mb-3 bg-primary" height="40" extended extension-height="200">
        <v-btn icon @click="dialog = false" v-if="$vuetify.breakpoint.smAndDown">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>
        <v-toolbar-title>
          <span class="headline">Add user</span>
        </v-toolbar-title>
      </v-toolbar>

      <v-card class="mx-5" style="margin-top:-150px;" min-height="200">
        <v-card-text>
          <span class="caption">Add a new user</span>
        </v-card-text>

        <v-form ref="form">
          <v-card-text v-if="addUser">
            <v-text-field
              v-model="name"
              :rules="nameRules"
              :error-messages="errors.name"
              label="Name"
            />
          </v-card-text>

          <v-card-text>
            <v-text-field
              v-model="email"
              :rules="emailRules"
              :error-messages="errors.email"
              label="Email"
            />
          </v-card-text>

          <v-card-text v-if="addUser">
            <v-text-field
              v-model="password"
              :rules="passwordRules"
              :error-messages="errors.password"
              type="password"
              label="Password"
            />
          </v-card-text>

          <v-card-text v-if="addUser">
            <v-text-field
              v-model="password_confirmation"
              :rules="confirmPasswordRules"
              :error-messages="errors.password_confirmation"
              type="password"
              label="Confirm password"
            />
          </v-card-text>
        </v-form>

        <v-alert type="error" v-if="errorMessage" class="bg-error">{{ errorMessage }}</v-alert>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="dialog = false" v-if="$vuetify.breakpoint.mdAndUp" color="red">Cancel</v-btn>
          <v-btn text @click="save" color="primary">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions } from "vuex";
import validators from "../../../utils/validators";

export default {
  data() {
    return {
      addUser: false,
      show: null,
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      nameRules: [v => validators.required(v)],
      emailRules: [v => validators.required(v), v => validators.email(v)],
      passwordRules: [
        v => validators.required(v),
        v => validators.minLength(v, 8)
      ],
      confirmPasswordRules: [
        v => validators.required(v),
        v => validators.match(v, this.password, "Passwords do not match")
      ],
      loading: false,
      errors: {},
      errorMessage: null
    };
  },
  computed: {
    dialog: {
      get() {
        return this.show;
      },
      set(val) {
        this.show = val;
        if (!val) {
          this.name = "";
          this.email = "";
          this.password = "";
          this.password_confirmation = "";
          this.errors = {};
          this.errorMessage = null;
          this.loading = false;
          this.addUser = false;
        }
      }
    }
  },
  methods: {
    ...mapActions({
      linkUser: "users/link",
      storeUser: "users/store"
    }),
    save() {
      if (this.$refs.form.validate()) {
        if (this.addUser) {
          const data = {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
          };
          this.loading = true;
          this.storeUser(data)
            .then(response => {
              this.loading = false;
              this.dialog = false;
            })
            .catch(error => {
              this.loading = false;
              this.errors = error.response.data.errors;
              this.errorMessage = error.response.data.message;
            });
        } else {
          const data = { email: this.email };
          this.loading = true;
          this.linkUser(data)
            .then(response => {
              this.loading = false;
              this.dialog = false;
            })
            .catch(error => {
              this.loading = false;
              if (error.response.status == 404) {
                this.addUser = true;
                this.errors = {};
                this.errorMessage = "";
              } else {
                this.errors = error.response.data.errors;
                this.errorMessage = error.response.data.message;
              }
            });
        }
      }
    }
  }
};
</script>
