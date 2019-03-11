<template>
<v-container fill-height>
  <v-layout row justify-center align-center wrap>
    <v-sheet class="pa-5" color="white" width="800px">
      <v-layout align-center justify-center column>
        <v-avatar size="80" class="my-avatar">
          <v-icon dark x-large color="primary">check</v-icon>
        </v-avatar>
        <div class="display-2 py-4 text-xs-center">Email Verified!</div>
      </v-layout>
      <v-divider light class="mx-5" inset></v-divider>
      <v-layout align-center justify-center column>
        <div class="body-1 py-4 text-xs-center">
          You now have access to explore the world!
        </div>
        <v-btn to="/" round large color="primary" class="text-capitalize">Continue to Login</v-btn>
      </v-layout>
    </v-sheet>
  </v-layout>
</v-container>
</template>

<script>
export default {
  
}
</script>

<style>
.my-avatar.v-avatar {
  border: 3px solid #8BB59D;
}
</style>
