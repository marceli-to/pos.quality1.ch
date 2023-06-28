<template>
  <figure class="post">
    <header>
      <div>
        <!-- <a href="javascript:;" class="icon-vote" @click="toggleVote(post.uuid)">
          <icon-heart :cls="post.votes.hasVote ? 'has-vote' : ''" />
          <span v-if="post.votes.count > 0">{{post.votes.count}}</span>
          <span v-else>{{ l18n('like') }}</span>
        </a> -->
        <a href="javascript:;" class="icon-share" @click.prevent="showShare(post.uuid)">
          <span>{{ l18n('share') }}</span>
          <icon-share />
        </a>
      </div>
    </header>
    <img :src="`/image/polaroid/${post.image}`" width="480" height="480" :alt="post.name">
    <figcaption>
      <div v-if="post.company">{{ post.company }}</div>
      <div v-if="post.name">{{ post.name }}</div>
      <div class="post__message" v-if="post.message"><strong>{{ post.message }}</strong></div>
    </figcaption>
    <loading-indicator :class="'is-widget'" v-if="isLoading"></loading-indicator>
  </figure>
</template>
<script>
import IconHeart from "@shared/components/icons/Heart.vue";
import IconShare from "@shared/components/icons/Share.vue";
import l18n from "@shared/l18n";

export default {

  mixins: [l18n],

  components: {
    IconHeart,
    IconShare
  },
  
  props: {
    post: {
      type: Object,
      default: null,
    }
  },
  
  data() {
    return {
      isLoading: false,
    }
  },

  methods: {
    // toggleVote(uuid) {
    //   this.isLoading = true;
    //   this.axios.post('/api/vote', {hash: this.$parent.hash, uuid: uuid}).then(response => {
    //     this.post.votes.hasVote = response.data.hasVote;
    //     this.post.votes.count = response.data.votes;
    //     this.isLoading = false;
    //   })
    //   .catch((error) => {
    //     if(error.response) {
    //       if (error.response.status && error.response.status == 419) {
    //         this.$notify({ type: "error", text: this.l18n('session_expired') });
    //         let _that = this;
    //         setTimeout(function(){
    //           document.location.href = '/' + _that.getLocale();
    //         }, 2000);
    //       }
    //     }
    //     this.isLoading = false;
    //   });
    // },

    showShare(uuid) {
      this.$parent.showShare(uuid);
    }
  }
}
</script>
