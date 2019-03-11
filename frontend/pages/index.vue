<template>
<v-layout row>
  <v-flex xs12>
    <authentication />
  </v-flex>
</v-layout>
</template>

<script>
import Authentication from '~/components/Authentication'
import Welcome from '~/components/Welcome'
export default {
  components: {
    Authentication,
    Welcome
  }
}
</script>
