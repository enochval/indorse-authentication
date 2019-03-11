<template>
<div>
  <div class="headline black--text text-xs-center">Create Your Account Now</div>
  <div class="body-1 black--text text-xs-center">Get unlimited access to all the festures free forever</div>
  <v-container fluid pt-3 pb-2>
    <v-layout column alig-center ju stify-center fill-height px-3>
      <v-flex xs12>
        <v-text-field 
          :hint="validationError.full_name.value" 
          :persistent-hint="validationError.full_name.display" 
          class="input-field" 
          v-model="postData.full_name" 
          type="text" 
          label="Full Name" 
          single-line 
          prepend-inner-icon="person_outline">
        </v-text-field>
      </v-flex>
      <v-flex xs12>
        <v-text-field
          :hint="validationError.email.value" 
          :persistent-hint="validationError.email.display"  
          class="input-field" 
          v-model="postData.email" 
          type="email" 
          label="E-mail" 
          single-line 
          prepend-inner-icon="email">
        </v-text-field>
      </v-flex>
      <v-flex xs12>
        <v-text-field
          :hint="validationError.password.value" 
          :persistent-hint="validationError.password.display"  
          class="input-field" 
          v-model="postData.password" 
          type="password" 
          label="Password" 
          single-line 
          prepend-inner-icon="lock">
        </v-text-field>
      </v-flex>
      <v-flex xs12>
        <v-text-field 
          :hint="validationError.password_confirmation.value" 
          :persistent-hint="validationError.password_confirmation.display" 
          class="input-field" 
          v-model="postData.password_confirmation" 
          type="password" 
          label="Confirm Password" 
          single-line 
          prepend-inner-icon="lock">
        </v-text-field>
      </v-flex>
      <v-btn color="primary" class="input-btn text-capitalize" :disabled="disabled" depressed round small @click="register">sign up</v-btn>
    </v-layout>
  </v-container>
</div>
</template>

<script>
export default {
  data: () => ({
    name: false,
    disabled: false,
    postData: {
      full_name: '',
      email: '',
      password: '',
      password_confirmation: ''
    },
    default: {
      full_name: '',
      email: '',
      password: '',
      password_confirmation: ''
    },
    validationError: {
      full_name: {
        value: '',
        display: false
      },
      email: {
        value: '',
        display: false
      },
      password: {
        value: '',
        display: false
      },
      password_confirmation: {
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
    'postData.full_name'() {
      Object.assign(this.validationError.full_name, this.reset)
    },
    'postData.email'() {
      Object.assign(this.validationError.email, this.reset)
    },
    'postData.password'() {
      Object.assign(this.validationError.password, this.reset)
    },
    'postData.password_confirmation'() {
      Object.assign(this.validationError.password_confirmation, this.reset)
    }
  },
  methods: {
    async register() {
      this.disabled = !this.disabled
      const { dispatch } = this.$store
      try {
        await dispatch('register', this.postData)
        this.$router.push('verification')
      } catch (e) {
        if (e.response.status === 422) {
          this.handleValidationError(e)
        }
      } finally {
        this.disabled = !this.disabled
      }
    },
    handleValidationError(e) {
      const { error } = e.response.data
      for (let item of error) {
        if (item.toLowerCase().includes('full name')) {
          this.validationError.full_name.value = item
          this.validationError.full_name.display = true
        }
        if (item.toLowerCase().includes('email')) {
          this.validationError.email.value = item
          this.validationError.email.display = true
        }
        if (item.toLowerCase().includes('password')) {
          this.validationError.password.value = item
          this.validationError.password.display = true
        }
        if (item.toLowerCase().includes('confirmation')) {
          this.validationError.password_confirmation.value = item
          this.validationError.password_confirmation.display = true
        }
      }
    }
  }
}
</script>

<style>

</style>
