<template>
<div>
  <header class="page-header">
    <div>
      <a href="/administration/posts" class="brand">
       <h1>Quality1 mit neuem Auftritt</h1>
      </a>
      <a href="javascript:;" @click="showMenu()" class="feather-icon menu-open">
        <menu-icon size="24"></menu-icon>
      </a>
    </div>
  </header>
</div>
</template>
<script>

// Icons
import { MenuIcon } from 'vue-feather-icons';

export default {
  components: {
    MenuIcon,
  },
 
	methods: {
		showMenu() {
			this.$parent.menuVisible = true;
		}
  },

  watch: {
    '$route'() {
      this.$parent.menuVisible = false
    }
  }
}
</script>
