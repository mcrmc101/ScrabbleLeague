<template>
  <div>
    <b-form
      @submit.prevent="playMatch"
      ref="matchForm"
    >
      <b-row>
        <h3>{{ alert }}</h3>
      </b-row>
      <b-row>
        <b-col>
          <b-form-group
            label="Select Player 1"
            label-for="player1select"
            class="m-1"
          >
            <b-form-select
              id="player1select"
              v-model="player1"
              plain
            >
              <b-form-select-option
                v-for="member in this.$store.state.members"
                :key="member.id"
                :value="member.id"
              >{{ member.name }}</b-form-select-option>
            </b-form-select>
          </b-form-group>
          <b-form-group
            label="Player 1 Score"
            label-for="score1"
          >
            <b-form-input
              type="number"
              id="score1"
              v-model="score1"
            ></b-form-input>
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group
            label="Select Player 2"
            label-for="player2select"
            class="m-1"
          >
            <b-form-select
              id="player2select"
              v-model="player2"
              plain
            >
              <b-form-select-option
                v-for="member in this.$store.state.members"
                :key="member.id"
                :value="member.id"
              >{{ member.name }}</b-form-select-option>
            </b-form-select>
          </b-form-group>
          <b-form-group
            label="Player 2 Score"
            label-for="score2"
          >
            <b-form-input
              type="number"
              id="score2"
              v-model="score2"
            ></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-form-group class="m-1">
          <b-button
            type="submit"
            variant="success"
          >Submit</b-button>
        </b-form-group>
      </b-row>
    </b-form>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'PlayMatch',
  data () {
    return {
      player1: 1,
      player2: 2,
      score1: '',
      score2: '',
      alert: 'Play a Match',
    }
  },
  methods: {
    playMatch: function () {
      if (this.player1 === this.player2) {
        this.alert = 'Player 1 is same as Player 2'
        return
      }
      else {
        var data = {
          'player1': this.player1,
          'player2': this.player2,
          'player1Score': this.score1,
          'player2Score': this.score2,
        }
        axios.post('https://scrabble.mcrmc.co.uk/scrabble/playMatch', data)
          .then((res) => {
            this.alert = res.data
            this.$store.commit('getMembers')
            this.$store.commit('getLeague')
            this.$refs.matchForm.reset()
          })
          .catch((err) => {
            console.log(err)
          })
      }
    }
  }

}
</script>