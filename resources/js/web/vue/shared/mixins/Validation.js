export default {
  
  methods: {

    handleValidationErrors(data) {
      // let errors = [];
      // for (let key in data.errors) {
      //   errors[data.errors[key][0]['field']] = data.errors[key][0]['error'];
      // }
      // this.errors = errors;
      // let message = this.l18n('validation_global');

      // if (this.errors.length > 0) {
      //   message += '<ul>';
      //   let _that = this;
      //   this.errors.forEach(function(error){
      //     message += '<li>'+_that.l18n(error)+'</li>';
      //   });
      //   message += '</ul>';
      // }


      //this.$notify({ type: "error", text: message, duration: -1});


    },

    removeValidationError(field) {
      this.errors[field] = null;
    }
  },
};
