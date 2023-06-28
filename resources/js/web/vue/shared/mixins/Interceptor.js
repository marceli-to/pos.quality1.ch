import l18n from "@shared/l18n";

export default {
  mixins: [l18n],

  data() {
    return { 
      errors: null,
    }
  },
  mounted() {
    window.intercepted.$on('response:200', data => {
      this.success(data);
    });

    window.intercepted.$on('response:401', data => {
      this.unauthorized(data);
    });

    window.intercepted.$on('response:403', data => {
      this.forbiddenError(data);
    });

    window.intercepted.$on('response:404', data => {
      this.notFoundError(data);
    });

    window.intercepted.$on('response:405', data => {
      this.notAllowed(data);
    });

    window.intercepted.$on('response:413', data => {
      this.contentTooLarge(data);
    });

    window.intercepted.$on('response:418', data => {
      this.validationError(data);
    });

    window.intercepted.$on('response:419', data => {
      this.unauthorized(data);
    });

    window.intercepted.$on('response:422', data => {
      this.validationError(data);
    });

    window.intercepted.$on('response:500', data => {
      this.serverError(data);
    });

  },

  beforeDestroy(){
    window.intercepted.$off('response:200', this.listener);
    window.intercepted.$off('response:401', this.listener);
    window.intercepted.$off('response:403', this.listener);
    window.intercepted.$off('response:404', this.listener);
    window.intercepted.$off('response:405', this.listener);
    window.intercepted.$off('response:419', this.listener);
    window.intercepted.$off('response:422', this.listener);
    window.intercepted.$off('response:500', this.listener);
  },

  methods: {

    success() {
      this.$store.commit('isLoading', false); 
    },

    validationError(data) {
      this.errors = data.body;
      let message = this.l18n('validation_global');

      if (this.errors.length > 0) {
        message += '<ul>';
        let _that = this;
        this.errors.forEach(function(error){
          message += '<li>'+_that.l18n(error)+'</li>';
        });
        message += '</ul>';
      }
      this.$notify({ type: "error", text: message, duration: -1});
      this.$store.commit('isLoading', false); 
    },

    serverError(data) {
      this.$store.commit('isLoading', false);
      this.$toast.open({
        'message': `${data.status} ${data.code}<br>${data.body.message}`,
        'type': 'error',
        'duration': 0
      });  
    },

    contentTooLarge(data) {
      this.$store.commit('isLoading', false);
      this.$toast.open({
        'message': `${data.status} ${data.code}<br>${data.body.message}`,
        'type': 'error',
        'duration': 0
      });
    },

    notFoundError(data) {
      this.$store.commit('isLoading', false);
      this.$router.push({ name: 'not-found' });
    },

    notAllowed(data) {
      this.$store.commit('isLoading', false);
      this.$toast.open({
        'message': `${data.status} ${data.code}<br>${data.body.message}`,
        'type': 'error',
        'duration': 0
      });
    },

    forbiddenError(data) {

      this.$store.commit('isLoading', false);
      this.$router.push({ name: 'forbidden' });
    },

    unauthorized(data) {

      this.$store.commit('isLoading', false);
      document.location.href = '/login';
    },
  },
};
