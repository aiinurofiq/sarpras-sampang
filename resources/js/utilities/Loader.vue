<template>
  <loader object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>
</template>
<script>
export default {
    mounted() {
        var vm = this;
        $(vm.$el).hide()
        //nav-item has-treeview menu-open
        //console.log(vm.$root.$children.querySelector('.nav-item'));
    },
}
</script>