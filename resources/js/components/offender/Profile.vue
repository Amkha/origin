<template>
  <!-- <card :title="$t('​oprofile')">
    {{ $t('oprofile') }}
    <div>
    <p> Hello offender profile <p/>
  </div>
  </card> -->
  <card :title="$t('​oprofile')">
    {{ $t('you_are_in_profile_page') }}
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('oprofile') }
  }
}
</script>