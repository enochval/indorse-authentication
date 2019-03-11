<template>
  <v-layout row>
    <v-flex xs12>
      <confirmation />
    </v-flex>
  </v-layout>
</template>

<script>
import Confirmation from '~/components/Confirmation' 

export default {
  async asyncData ({ query, $axios, app, redirect }) {
    try {
      const { data } = await $axios.get(`verify/${query.code}`)
    } catch (e) {
      // report this error
      redirect('/')
    }
  },
  components: {
    Confirmation
  }
}
</script>