import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    members: [],
    league: []
  },
  mutations: {
    getMembers (state) {
      axios.get('https://scrabble.mcrmc.co.uk/scrabble/getMembers')
        .then((res) => {
          state.members = res.data
        })
        .catch((err) => {
          console.log(err)
        })
    },
    getLeague (state) {
      axios.get('https://scrabble.mcrmc.co.uk/scrabble/getLeague')
        .then((res) => {
          state.league = res.data
        })
        .catch((err) => {
          console.log(err)
        })
    },
  },
  actions: {
  },
  modules: {
  }
})
