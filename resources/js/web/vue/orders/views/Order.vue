<template>
  <div>
    <loading-indicator v-if="$store.state.isLoading"></loading-indicator>
    <notifications classes="notification" />
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
          <form>
            <div class="form-group">
              <label><strong>{{ l18n('plate_front')}}</strong></label>
              <div class="select-wrapper">
                <select v-model="order.plate_front">
                  <option :value="0">{{ l18n('choose')}}</option>
                  <option :value="5">5 {{ l18n('pcs')}}</option>
                  <option :value="10">10 {{ l18n('pcs')}}</option>
                  <option :value="15">15 {{ l18n('pcs')}}</option>
                  <option :value="20">20 {{ l18n('pcs')}}</option>
                  <option :value="25">25 {{ l18n('pcs')}}</option>
                  <option :value="30">30 {{ l18n('pcs')}}</option>
                  <option :value="35">35 {{ l18n('pcs')}}</option>
                  <option :value="40">40 {{ l18n('pcs')}}</option>
                  <option :value="45">45 {{ l18n('pcs')}}</option>
                  <option :value="50">50 {{ l18n('pcs')}}</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label><strong>{{ l18n('plate_back')}}</strong></label>
              <div class="select-wrapper">
                <select v-model="order.plate_back">
                  <option :value="0">{{ l18n('choose')}}</option>
                  <option :value="5">5 {{ l18n('pcs')}}</option>
                  <option :value="10">10 {{ l18n('pcs')}}</option>
                  <option :value="15">15 {{ l18n('pcs')}}</option>
                  <option :value="20">20 {{ l18n('pcs')}}</option>
                  <option :value="25">25 {{ l18n('pcs')}}</option>
                  <option :value="30">30 {{ l18n('pcs')}}</option>
                  <option :value="35">35 {{ l18n('pcs')}}</option>
                  <option :value="40">40 {{ l18n('pcs')}}</option>
                  <option :value="45">45 {{ l18n('pcs')}}</option>
                  <option :value="50">50 {{ l18n('pcs')}}</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label><strong>{{ l18n('flag')}}</strong></label>
              <div class="select-wrapper">
                <select v-model="order.flag">
                  <option :value="0">{{ l18n('choose')}}</option>
                  <option :value="1">1 {{ l18n('pcs')}}</option>
                </select>
              </div>
            </div>
            <h3>Versand an:</h3>
            <div class="form-group">
              <input type="text" name="company" v-model="order.company" :placeholder="l18n('placeholder_company')">
            </div>
            <div class="form-group">
              <input type="text" name="name" v-model="order.name" :placeholder="l18n('placeholder_name')">
            </div>
            <div class="form-group">
              <input type="text" name="street" v-model="order.street" :placeholder="l18n('placeholder_street')">
            </div>
            <div class="form-group is-grid">
              <div>
                <input type="text" name="zip" v-model="order.zip" :placeholder="l18n('placeholder_zip')">
              </div>
              <div>
                <input type="text" name="city" v-model="order.city" :placeholder="l18n('placeholder_city')">
              </div>
            </div>
            <div class="form-group">
              <input type="email" name="email" v-model="order.email" :placeholder="l18n('placeholder_email')">
            </div>
            <div class="form-buttons">
              <a href="javascript:;" @click.prevent="cancel()">{{ l18n('btn_cancel') }}</a>
              <input type="submit" :value="l18n('btn_submit_order')" class="btn-primary" @click.prevent="submit()">
            </div>
          </form>
        </div>
      </div>
    </template>
  </div>
  </template>
  <script>
  import l18n from "@shared/l18n";
  
  export default {
  
    mixins: [l18n],
  
    components: {
    },
  
    data() {
      return {
  
        // Post
        order: {
          plate_front: 0,
          plate_back: 0,
          flag: 0,
          company: null,
          name: null,
          street: null,
          zip: null,
          city: null,
          email: null,
        },
    
        // Validation errors
        errors: {
          company: null,
          name: null,
          street: null,
          zip: null,
          city: null,
        },
  
        hasForm: false,
        orderComplete: false,
        isLoading: false,
      };
    },
  
    methods: {
  
      toggleForm() {
        this.hasForm = !this.hasForm;
      },

      hideForm() {
        this.hasForm = false;
        const el = document.querySelector('.landing-order');
        window.scrollTo({ top: el.offsetTop, behavior: 'smooth' });
      },
  
      cancel() {
        this.reset();
        this.hideForm();
      },
  
      reset() {
        this.order = {
          plate_front: 0,
          plate_back: 0,
          flag: 0,
          company: null,
          name: null,
          street: null,
          zip: null,
          city: null,
          email: null,
        }
        this.errors = [];
      },
  
      submit() {
        this.$store.commit('isLoading', true); 
        this.axios.post('/api/order/save', {
          plate_front: this.order.plate_front ? this.order.plate_front : null,
          plate_back: this.order.plate_back ? this.order.plate_back : null,
          flag: this.order.flag ? this.order.flag : null,
          company: this.order.company,
          name: this.order.name,
          street: this.order.street,
          zip: this.order.zip,
          city: this.order.city,
          email: this.order.email,
        }).then(response => {
          this.$store.commit('isLoading', false); 
          this.reset();
          this.hideForm();
          this.orderComplete = true;
          const el = document.querySelector('.landing-order');
          window.scrollTo({ top: el.offsetTop, behavior: 'smooth' });
          this.$notify({ type: "success", text: 'Vielen Dank für Ihre Bestellung. Sie erhalten das bestellte Material in Kürze.', duration: 2000});
        })
        .catch(error => {
          this.$store.commit('isLoading', false); 
        });
      },
    },
  
    computed: {

    }
  }
  </script>
  