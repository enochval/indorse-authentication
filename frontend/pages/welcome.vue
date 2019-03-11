<template>
  <v-layout row>
    <v-flex xs12>
      <welcome />
    </v-flex>
  </v-layout>
</template>

<script>
import Welcome from '~/components/Welcome' 

export default {
  middleware: 'auth',
  components: {
    Welcome
  }
}
</script>