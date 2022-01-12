<template>
  <div>
    <h6>Add Member</h6>
    <b-form @submit.prevent="addMember">
      <b-row align-v="end">
        <b-col>
          <b-form-group
            label="Member Name"
            label-for="name"
          >
            <b-form-input
              id="name"
              v-model="name"
              required
            ></b-form-input>
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group>
            <b-button
              type="submit"
              variant="success"
            >Save</b-button>
          </b-form-group>
        </b-col>
      </b-row>
    </b-form>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'AddMember',
  data () {
    return {
      name: ''
    }
  },
  methods: {
    addMember: function () {
      var data = {
        'name': this.name
      }
      axios.post('https://scrabble.mcrmc.co.uk/scrabble/addMember', data)
        .then((res) => {
          console.log(res)
          this.$store.commit('getMembers');
        })
        .catch((err) => {
          console.log(err)
        })

    }
  }
}
</script>