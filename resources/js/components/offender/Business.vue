<template>
  <card :title="$t('business')">
    {{ $t('you_are_in_business') }}
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('business') }
  }
}
</script>
