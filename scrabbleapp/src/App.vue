<template>
  <div id="app">
    <b-navbar
      variant="dark"
      type="dark"
      class="mb-3"
    >
      <b-navbar-brand
        tag="h1"
        class="m-3"
      >Scrabble League</b-navbar-brand>
    </b-navbar>
    <b-container fluid>
      <b-row
        align-v="center"
        align-h="center"
      >
        <league-table></league-table>
      </b-row>
      <b-row class="mb-3">
        <b-col md="6">
          <b-card>
            <play-match></play-match>
          </b-card>
        </b-col>
        <b-col md="6">
          <b-card>
            <add-member></add-member>
            <all-members></all-members>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import AddMember from './components/AddMember.vue'
import AllMembers from './components/AllMembers.vue'
import LeagueTable from './components/LeagueTable.vue'
import PlayMatch from './components/PlayMatch.vue'


export default {
  name: 'App',
  components: {
    LeagueTable,
    PlayMatch,
    AddMember,
    AllMembers,
  },
  created () {
    this.$store.commit('getMembers')
    this.$store.commit('getLeague')
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.sr-only {
  display: none !important;
}
</style>
