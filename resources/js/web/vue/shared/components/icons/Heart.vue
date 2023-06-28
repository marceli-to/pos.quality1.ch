<template>
  <svg width="32" height="25" viewBox="0 0 32 25" fill="none" xmlns="http://www.w3.org/2000/svg" :class="$props.cls">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.721 24.9605V7.8605C15.721 3.51926 12.2017 0 7.8605 0C3.51926 0 0 3.51926 0 7.8605C0 16.6863 15.721 24.9605 15.721 24.9605ZM23.5815 0C27.9227 0 31.442 3.51926 31.442 7.8605C31.442 16.6863 15.721 24.9605 15.721 24.9605V7.8605C15.721 3.51926 19.2403 0 23.5815 0Z" fill="#000000"/>
  </svg>
</template>
<script>
export default {
  props: {
    cls: {
      type: String,
    },
  }      
}
</script>
<style>
.has-vote path {
  fill: #FF0000;
}
</style>

