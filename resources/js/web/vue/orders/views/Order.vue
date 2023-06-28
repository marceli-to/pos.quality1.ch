<template>
  <div>
    <loading-indicator v-if="$store.state.isLoading"></loading-indicator>
    <template v-if="!hasForm">
      <div class="flex justify-center">
        <a href="javascript:;" class="btn-primary is-inline" @click.prevent="toggleForm()">
          {{l18n('btn_order_now')}}
        </a>
      </div>
    </template>
    <template v-else>
      <div class="order-form js-landing-form">
        <div>
          <div class="form-group is-grid">
            <div>
              <input type="text" name="company" v-model="order.company" :placeholder="l18n('placeholder_company')">
            </div>
            <div>
              <input type="text" name="name" v-model="order.name" :placeholder="l18n('placeholder_name')">
            </div>
          </div>
          <div class="form-group">
            <input type="email" name="email" v-model="order.email" :placeholder="l18n('placeholder_email')">
          </div>
          <div class="form-buttons">
            <a href="javascript:;" @click.prevent="cancel()">{{ l18n('btn_cancel') }}</a>
            <input type="submit" :value="l18n('btn_submit_order')" class="btn-primary" @click="submit()">
          </div>
        </div>
      </div>
    </template>
  </div>
  </template>
  <script>
  // import ErrorHandling from "@shared/mixins/ErrorHandling";
  import Validation from "@shared/mixins/Validation";
  import l18n from "@shared/l18n";
  
  export default {
  
    mixins: [Validation, l18n],
  
    components: {
    },
  
    data() {
      return {
  
        // Post
        order: {
          company: null,
          name: null,
          email: null,
        },
    
        // Validation errors
        errors: {
          company: null,
          name: null,
        },
  
        hasForm: false,
        isLoading: false,
      };
    },
  
    methods: {
  
      toggleForm() {
        this.hasForm = !this.hasForm;
      },
  
      cancel() {
        this.reset();
        this.toggleForm();
      },
  
      reset() {
        this.post = {
          company: null,
          name: null,
          email: null,
        }
        this.errors = [];
      },
  
      submit() {

        this.$store.commit('isLoading', true); 
        this.axios.post('/api/order/save', {
          company: this.orders,
          name: this.order.name,
          email: this.order.email,
        }).then(response => {
          this.$store.commit('isLoading', false); 
          this.reset();
          this.$notify({ type: "success", text: this.l18n('notification_success') });
        })
        .catch(error => {
          this.$store.commit('isLoading', false); 
          // this.handleValidationErrors(error.response.data);
        });
      },
    },
  
    computed: {

    }
  }
  </script>
  