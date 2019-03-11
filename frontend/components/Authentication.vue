<template>
<v-layout justify-center align-center row fill-height>
  <v-sheet class="pa-5" color="white" width="800px">
    <v-layout justify-center align-center row wrap>
      <v-flex xs12 md6>
        <v-layout align-center justify-center fill-height row>
          <v-avatar slot="activator" size="260">
            <img src="rocket.jpg" alt="illustrator">
          </v-avatar>
        </v-layout>
      </v-flex>
      <v-flex xs12 md6>
        <v-layout justify-center align-center column wrap>
          <sign-up v-if="signup" />
          <sign-in v-if="login" />
          <div v-if="signup" class="body-1 black--text text-xs-center">Already have an account? <v-btn round @click="toggle" flat color="primary" class="text-capitalize pa-0 ma-0">sign in</v-btn>
          </div>
          <div v-if="login" class="body-1 black--text text-xs-center">Don't have an account? <v-btn @click="toggle" round flat color="primary" class="text-capitalize pa-0 ma-0">sign up</v-btn>
          </div>
        </v-layout>
      </v-flex>
    </v-layout>
  </v-sheet>
</v-layout>
</template>

<script>
import SignUp from '~/components/SignUp'
import SignIn from '~/components/SignIn'
export default {
  components: {
    SignUp,
    SignIn
  },
  computed: {
    login() {
      return this.$store.state.login
    },
    signup() {
      return this.$store.state.signup
    },
  },
  methods: {
    toggle() {
      this.$store.commit('TOGGLE_AUTH')
    }
  }
}
</script>

<style>
.input-field .v-icon {
  font-size: 17px;
}

.input-field.v-text-field .v-input__prepend-inner {
  padding-right: 12px;
}

.input-field .v-label {
  font-size: 11px;
}

.input-field.v-text-field input {
  margin-bottom: 8px;
}

.input-field.v-text-field {
  margin-top: 0;
  padding-top: 0;
}

.input-field.v-input {
  font-size: 1.0em;
}

.input-btn.v-btn {
  margin: 6px 75px;
}

.input-btn.v-btn--small {
  font-size: 12px;
}
</style>
