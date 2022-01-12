<template>
  <div :message="message" :class="{
    [`alert-${type}`]: true,
  }" class="alert "
  >
  {{message}}
  </div>
</template>

<script>
export default {
  name: 'Alert',
  props: {
    type:'',
    message: '',
  }
}
</script>
