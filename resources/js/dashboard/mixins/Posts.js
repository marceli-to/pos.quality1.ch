import ErrorHandling from "@/mixins/ErrorHandling";
import Helpers from "@/mixins/Helpers";
import ListActions from "@/components/ui/ListActions.vue";
import Post from "@/components/Post.vue";

export default {

  components: {
    Post,
    ListActions,
  },

  mixins: [ErrorHandling, Helpers],

  data() {
    return {
      // States
      isLoading: false,
      isFetched: false,
      hasOverlay: false,

      // Data
      posts: [],

      // Pagination
      perPage: 50,
      pages: [],

      page: 1,
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    toggle(id,event) {
      let uri = `/api/post/state/${id}`;
      this.isLoading = true;
      this.axios.get(uri).then(response => {
        this.fetch();
        this.$notify({ type: "success", text: "Status geändert" });
        this.isLoading = false;
      });
    },

    destroy(id, event, model) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/post/${id}`;
        this.isLoading = true;
        this.axios.delete(uri).then(response => {
          this.fetch();
          this.isLoading = false;
          this.$notify({ type: "success", text: "Foto gelöscht" });
        });
      }
    },

    update() {
      let uri = `/api/post/${this.post.id}`;
      this.isLoading = true;
      this.axios.put(uri, this.post).then(response => {
        this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        this.hasOverlay = false;
        this.post = null;
        this.fetch();
      });
    },

    restore(id,event) {
      let uri = `/api/post/restore/${id}`;
      this.isLoading = true;
      this.axios.get(uri).then(response => {
        this.fetch();
        this.$notify({ type: "success", text: "Foto wiederhergestellt" });
        this.isLoading = false;
      });
    },

		setPages() {
			let pages = Math.ceil(this.posts.length / this.perPage);
			for (let idx = 1; idx <= pages; idx++) {
				this.pages.push(idx);
      }
    },

		paginate(posts) {
			let page = this.page;
			let perPage = this.perPage;
			let from = (page * perPage) - perPage;
      let to = (page * perPage);
			return posts.slice(from, to);
		}
  },
  
	computed: {
		postsPaginated() {
			return this.paginate(this.posts);
    },
	},
};