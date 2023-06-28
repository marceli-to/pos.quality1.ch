<template>
<div>
  <notifications classes="notification" />
  <page-header :user="$store.state.user"></page-header>
  <main class="site">
    <nav :class="[!menuVisible ? '' : 'is-visible', 'page']">
      <header>
        <span>
          {{user}}<br>
          <a href="/logout" class="feather-icon feather-icon--prepend feather-icon--light">
            <log-out-icon size="12"></log-out-icon>
            <span>Logout</span>
          </a>
        </span>
        <a href="javascript:;" @click="hideMenu()" class="feather-icon menu-close">
          <arrow-right-icon size="24"></arrow-right-icon>
        </a>
      </header>
      <ul>
        <li>
          <span>Beiträge</span>
          <ul>
            <li>
              <router-link :to="{name: 'posts-nonpublished'}" :active-class="'is-active'">
                Neu
              </router-link>
            </li>
            <li>
              <router-link :to="{name: 'posts-published'}" :active-class="'is-active'">
                Veröffentlicht
              </router-link>
            </li>
            <li>
              <router-link :to="{name: 'posts-trashed'}" :active-class="'is-active'">
                Gelöscht
              </router-link>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <router-view></router-view>
  </main>
</div>
</template>
<script>
import { ArrowRightIcon, MenuIcon, LogOutIcon } from 'vue-feather-icons';
import PageHeader from '@/views/layout/PageHeader.vue';

export default {

  components: {
    PageHeader,
    ArrowRightIcon,
    MenuIcon,
    LogOutIcon,
  },

	data() {
		return {
      menuVisible: false,
      user: null,
		}
  },
  

  mounted() {
    this.fetchUser();
  },

  methods: {
    fetchUser() {
      if (!this.$store.state.user) {
        this.axios.get(`/api/user`).then(response => {
          this.$store.commit('user', `${response.data.firstname} ${response.data.name}`);
          this.user = `${response.data.firstname} ${response.data.name}`;
        });
      }
    },

    hideMenu() {
      this.menuVisible = false;
    }
  }
}
</script>