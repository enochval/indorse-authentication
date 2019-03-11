<template>
  <v-layout row>
    <v-flex xs12>
      <verify-email :email="email"/>
    </v-flex>
  </v-layout>
</template>

<script>
import VerifyEmail from '~/components/VerifyEmail' 

export default {
  components: {
    VerifyEmail
  },
  computed: {
    email() {
      const { registeredEmail } = this.$store.state
      return registeredEmail
    }
  }
}
</script>
