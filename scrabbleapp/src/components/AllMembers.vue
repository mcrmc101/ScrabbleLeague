<template>
  <div>
    <dl>

    </dl>
    <b-list-group>
      <b-list-group-item
        class="d-flex justify-content-between align-items-center"
        v-for="member in this.$store.state.members"
        :key="member.id"
      >{{ member.name }} - {{ member.matches_played }} matches played</b-list-group-item>

    </b-list-group>

  </div>
</template>
<script>
export default {
  name: 'AllMembers'
}
</script>