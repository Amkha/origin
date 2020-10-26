<template>
  <card :title="$t('network')">
    {{ $t('you_are_in_network') }}
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('network') }
  }
}
</script>
