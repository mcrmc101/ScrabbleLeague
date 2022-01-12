<template>
  <div>
    <b-table
      hover
      sticky-header
      small
      bordered
      :items="this.$store.state.league"
      :fields="fields"
      sort-icon-left
      responsive="sm"
    >
      <template #cell(average)="data">{{ data.item.average }} %</template>
    </b-table>
  </div>
</template>
<script>
export default {
  name: 'LeagueTable',
  data () {
    return {
      fields: [
        {
          key: 'name',
          label: 'Name',
          sortable: true,
        },
        {
          key: 'average',
          label: 'Average',
          sortable: true,
        },
        {
          key: 'wins',
          label: 'Wins',
          sortable: true,
        },
        {
          key: 'losses',
          label: 'Losses',
          sortable: true,
        },
        {
          key: 'draws',
          label: 'Draws',
          sortable: true,
        },
        {
          key: 'matches',
          label: 'Matches',
          sortable: true,
        },
      ]
    }
  }
}
</script>