<template>
<v-container fill-height>
  <v-layout row justify-center align-center wrap>
    <v-sheet class="pa-5" color="white" width="800px">
      <v-layout align-center justify-center column>
        <v-avatar size="80" class="my-avatar">
          <v-icon dark x-large color="primary">email</v-icon>
        </v-avatar>
        <div class="display-2 py-4 text-xs-center">Verify your email address</div>
      </v-layout>
      <v-divider light class="mx-5" inset></v-divider>
      <v-layout align-center justify-center column>
        <div class="body-1 py-4 text-xs-center">We now need to verify your email address. We've sent an email to {{email}} to verify your address.
          please click the link in the email to continue.
        </div>
        <v-btn @click="resend" :disabled="disabled" round large color="primary" class="text-capitalize">Resend Verification Message</v-btn>
      </v-layout>
    </v-sheet>
  </v-layout>
</v-container>
</template>

<script>
export default {
  data: () => ({
    disabled: false
  }),
  props: [
    'email'
  ],
  methods: {
    async resend() {
      this.disabled = !this.disabled
      const payload = {
        email: this.$store.state.registeredEmail
      }
      const { dispatch } = this.$store
      await dispatch('resend', payload)
      this.disabled = !this.disabled
    }
  }
}
</script>

<style>
.my-avatar.v-avatar {
  border: 3px solid #8BB59D;
}
</style>
