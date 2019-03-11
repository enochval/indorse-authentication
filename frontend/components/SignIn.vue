<template>
<div>
  <div class="headline black--text text-xs-center">Login to your Account</div>
  <v-container fluid pt-3 pb-2>
    <v-layout column alig-center ju stify-center fill-height px-3>
      <v-flex xs12>
        <v-text-field
          :hint="validationError.email.value" 
          :persistent-hint="validationError.email.display" 
          v-model="credentials.email"
          type="text" 
          class="input-field" 
          label="E-mail" 
          single-line 
          prepend-inner-icon="email">
        </v-text-field>
      </v-flex>
      <v-flex xs12>
        <v-text-field 
          :hint="validationError.password.value" 
          :persistent-hint="validationError.password.display"
          v-model="credentials.password"
          type="password" 
          class="input-field" 
          label="Password" 
          single-line 
          prepend-inner-icon="lock">
        </v-text-field>
      </v-flex>
      <v-btn @click="signIn" :disabled="disabled" color="primary" class="input-btn text-capitalize" depressed round small>sign in</v-btn>
    </v-layout>
  </v-container>
</div>
</template>

<script>
export default {
  data: () => ({
    disabled: false,
    credentials: {
      email: '',
      password: ''
    },
    default: {
      email: '',
      password: ''
    },
    validationError: {
      email: {
        value: '',
        display: false
      },
      password: {
        value: '',
        display: false
      }
    },
    reset: {
      value: '',
      display: false
    }
  }),
  watch: {
    'credentials.email'() {
      Object.assign(this.validationError.email, this.reset)
    },
    'credentials.password'() {
      Object.assign(this.validationError.password, this.reset)
    }
  },
  methods: {
    async signIn() {
      this.disabled = !this.disabled
      const { dispatch } = this.$store
      try {
        await dispatch('signIn', this.credentials)
        this.$router.push('welcome')
      } catch (e) {
        this.handleValidationError(e)
      } finally {
        this.disabled = !this.disabled
      }
    },

    handleValidationError(e) {
      const { error } = e.response.data
      for (let item of error) {
        if (item.toLowerCase().includes('email')) {
          this.validationError.email.value = item
          this.validationError.email.display = true
        }
        if (item.toLowerCase().includes('password')) {
          this.validationError.password.value = item
          this.validationError.password.display = true
        }
      }
    }
  }
}
</script>
