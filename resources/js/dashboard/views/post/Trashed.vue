<template>
<div>
  <loading-indicator v-if="isLoading"></loading-indicator>
  <div :class="isFetched ? 'is-loaded' : 'is-loading'">
    <div>
      <div class="posts" v-if="postsPaginated.length">
        <post :post="p" v-for="p in postsPaginated" :key="p.uuid"></post>
      </div>
      <div v-else>
        <p>Es sind keine Beiträge vorhanden...</p>
      </div>
      <nav class="pagination">
        <ul>
          <li v-for="(pageNumber, i) in pages" :key="i" >
            <a 
              href=""
              :class="[pageNumber == page ? 'is-active' : '', 'page-item__button']"
              @click.prevent="page = pageNumber">
              <em>{{pageNumber}}</em>
            </a>
          </li>
        </ul>
      </nav>	
    </div>
  </div>
</div>
</template>
<script>
import Posts from "@/mixins/Posts"; 

export default {

  mixins: [Posts],

  methods: {

    fetch() {
      this.pages = [];
      this.isLoading = true;
      this.axios.get(`/api/posts/trashed`).then(response => {
        this.posts = response.data.data;
        this.isFetched = true;
        this.isLoading = false;
        this.setPages();
      });
    },

  },
}
</script>