<template>
  <div>
    <notifications classes="notification" />
    <div class="flex justify-center" v-if="!hasForm">
      <a href="javascript:;" class="btn-primary is-inline" @click.prevent="toggleForm()">
        {{l18n('btn_upload_picture')}}
      </a>
    </div>

    <template v-if="hasForm">
      <post-form @done="toggleForm()"></post-form>
    </template>
    
    <template v-if="!hasForm && showSingle && uuid">
      <div class="landing-post">
        <a href="javascript:;" class="icon-close" @click.prevent="hideSingle()">
          <icon-close />
        </a>
        <div>
          <post :post="post"></post>
        </div>
      </div>
    </template>
    
    <div class="landing-posts" v-if="!hasForm && isFetched">
      <post :post="p" v-for="(p, idx) in posts" :key="idx"></post>
    </div>
    <div class="landing-posts-btn" v-if="!hasForm && isFetched &&hasMore">
      <a href="javascript:;" class="btn-primary" @click.prevent="getMorePosts()">{{l18n('btn_more')}}</a>
    </div>

    <template v-if="hasShare">
      <div class="share">
        <header>
          <a href="javascript:;" @click.prevent="hideShare()" class="icon-close">
            <icon-close :cls="'has-bg'" />
          </a>
        </header>
        <div>
          <div class="share__icons">
            <a :href="'whatsapp://send?text=' + l18n('share_title') + '%0D%0A' + this.shareUrl" class="icon-whatsapp" @click="hideShare()">
              <icon-whatsapp />
              <label>Whatsapp</label>
            </a>
            <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + this.shareUrl" class="icon-facebook" target="_blank" @click="hideShare()">
              <icon-facebook />
              <label>Facebook</label>
            </a>
            <a :href="'mailto:?subject=' + l18n('share_title') + '&body=' + this.shareUrl" class="icon-email" target="_blank" @click="hideShare()">
              <icon-email />
              <label>E-Mail</label>
            </a>
            <a href="javascript:;" class="icon-copy" v-clipboard="this.shareUrl" v-clipboard:success="clipboardSuccess">
              <icon-copy />
              <label>{{ l18n('url_copy')}}</label>
            </a>
          </div>
        </div>
      </div>
    </template>
  </div>
</template>
<script>
import Post from '@posts/components/Post.vue';
import PostForm from "@posts/components/Form.vue";
import IconCross from "@shared/components/icons/Cross.vue";
import IconClose from "@shared/components/icons/Close.vue";
import IconWhatsapp from "@shared/components/icons/Whatsapp.vue";
import IconEmail from "@shared/components/icons/Email.vue";
import IconFacebook from "@shared/components/icons/Facebook.vue";
import IconCopy from "@shared/components/icons/Copy.vue";
import l18n from "@shared/l18n";

export default {

  mixins: [l18n],

  components: {
    Post,
    PostForm,
    IconCross,
    IconClose,
    IconWhatsapp,
    IconEmail,
    IconFacebook,
    IconCopy
  },

  props: {
    uuid: {
      type: String,
      default: null,
    }
  },

  data() {
    return {

      post: {
        type: Object,
        default: null
      },

      posts: {
        type: Object,
        default: null,
      },

      // States
      hasForm: false,
      hasShare: false,
      isFetched: false,
      showSingle: false,
      hasMore: false,

      // Limit & Offset
      step: 12,
      offset: 0,

      // Share
      shareUrl: null,

    };
  },

  mounted() {
    this.getPosts();
    
    if (this.$props.uuid) {
      this.getPost();
    }
  },

  created() {
    const onEscape = (e) => {
      if (this.showSingle && e.keyCode === 27) {
        this.hideSingle();
      }
      if (this.hasShare && e.keyCode === 27) {
        this.hideShare();
      }
    }
    document.addEventListener('keydown', onEscape);
  },

  methods: {

    toggleForm() {
      this.hasForm = this.hasForm ? false : true;
    },

    getPost() {

      let uri = `/api/post/find/${this.$props.uuid}`;
      this.axios.get(uri).then(response => {
        this.post = response.data.post;
        this.showSingle = true;
      })
      .catch(error => {
        this.showSingle = false;
      });
    },

    getPosts() {

      let uri = `/api/posts/get/${this.offset}`;
      this.axios.get(uri).then(response => {
        this.posts = response.data.posts;
        this.isFetched = true;
        this.offset = this.offset + this.step;
        this.hasMore = response.data.hasMore;
      })
      .catch(error => {
        this.isFetched = false;
      });
    },

    getMorePosts() {
      let uri = `/api/posts/get/${this.offset}`;
      this.axios.get(uri).then(response => {
        this.posts = [...this.posts, ...response.data.posts];
        this.offset = this.offset + this.step;
        this.hasMore = response.data.hasMore;
      })
      .catch(error => {
        console.log(error.response);
      });
    },

    hideSingle() {
      this.showSingle = false;
    },

    showShare(uuid) {
      this.shareUrl = `${location.protocol}//${location.host}/${this.getLocale()}/${uuid}`;
      this.hasShare = true;
    },

    hideShare() {
      this.hasShare = false;
    },

    clipboardSuccess() {
      this.hideShare();
      this.$notify({ type: "success", text: this.l18n('url_copied') });
    }
  }
}
</script>


