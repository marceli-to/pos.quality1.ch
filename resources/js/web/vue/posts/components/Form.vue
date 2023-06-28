<template>
<div>
  <loading-indicator v-if="$store.state.isLoading"></loading-indicator>
  <div class="landing-upload">
    <vue-dropzone
      ref="dropzone"
      id="dropzone"
      :options="config"
      @vdropzone-success="uploadSuccess"
      @vdropzone-complete="uploadComplete"
      @vdropzone-max-files-exceeded="maxFilesExceeded"
      :useCustomSlot=true
      v-if="!this.hasUpload"
    >
      <div>
        <strong>{{ l18n('dropzone_label') }}</strong><br>
        <small>{{ l18n('dropzone_restrictions') }}</small>
      </div>
    </vue-dropzone>
    <figure class="post post--preview" v-if="this.hasUpload">
      <header>
        <div>
          <div>{{ l18n('preview') }}</div>
          <a href="javascript:;" class="icon-trash" @click.prevent="removeImage();">
            <span>{{ l18n('delete_preview') }}</span>
          </a>
        </div>
      </header>
      <img :src="`/image/polaroid/${post.image}`" width="480" height="480">
      <figcaption>
        <div>{{ post.company ? post.company : l18n('placeholder_company') }}</div>
        <div>{{ post.name ? post.name : l18n('placeholder_name') }}</div>
        <div class="post__message"><strong>{{ post.message ? post.message : l18n('placeholder_message') }}</strong></div>
      </figcaption>
    </figure>
  </div>
  <div class="landing-form js-landing-form">
    <div>
      <div class="form-group is-grid">
        <div>
          <input type="text" name="company" v-model="post.company" :placeholder="l18n('placeholder_company')">
        </div>
        <div>
          <input type="text" name="name" v-model="post.name" :placeholder="l18n('placeholder_name')">
        </div>
      </div>
      <div class="form-group">
        <input type="email" name="email" v-model="post.email" :placeholder="l18n('placeholder_email')">
      </div>
      <div class="form-group">
        <input type="text" name="message" maxlength="100" v-model="post.message" :placeholder="l18n('placeholder_message')">
        <span>{{messageLength}}</span>
      </div>
      <div class="form-group">
        <label class="form-control-checkbox" id="accept_tos">
          <input type="checkbox" name="accept_tos" v-model="accept_tos" />
          {{ l18n('tos') }}
        </label>
      </div>
      <div class="form-buttons">
        <a href="javascript:;" @click.prevent="cancel()">{{ l18n('btn_cancel') }}</a>
        <input type="submit" :value="l18n('btn_upload_now')" class="btn-primary" @click="submit()">
      </div>
    </div>
  </div>
</div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import Validation from "@shared/mixins/Validation";
import l18n from "@shared/l18n";

export default {

  mixins: [Validation, l18n],

  components: {
    vueDropzone: vue2Dropzone,
  },

  data() {
    return {

      // Post
      post: {
        company: null,
        name: null,
        email: null,
        message: null,
        image: null,
      },

      accept_tos: null,

      // Validation errors
      errors: {
        company: null,
        name: null,
        message: null,
        image: null
      },

      // Dropzone config
      config: {
        url: "/api/post/image",
        method: 'post',
        maxFilesize: 9,
        maxFiles: 1,
        createImageThumbnails: false,
        autoProcessQueue: true,
        acceptedFiles: '.png, .jpg, .jpeg',
        previewTemplate: this.template(),
        headers: {
          'x-csrf-token': document.head.querySelector('meta[name="csrf-token"]').content
        }
      },

      hasUpload: false,
      isLoading: false,
    };
  },

  methods: {

    uploadSuccess(file, response) {
      let res = JSON.parse(file.xhr.response);
      this.hasUpload = true;
      this.post.image = res.file;
      setTimeout(function(){
        window.scrollBy({
          top: window.innerHeight,
          behavior: 'smooth'
        });
      }, 2000);
    },

    uploadComplete(file) {
      if (file.status == "error") {

        if (file.xhr !== undefined) {
          let res = JSON.parse(file.xhr.response);
          if (res.errors.file) {
            res.errors.file.forEach(error => this.$notify({ type: "error", text: this.l18n(error), duration: 2000 }));
            this.$refs.dropzone.removeFile(file);
          }
        }
        else {
          if (file.accepted == false) {
            if (file.size > 9000000) {
              this.$notify({ type: "error", text: this.l18n('image_exceeds_max_size'), duration: 2000 });
            }
            else {
              this.$notify({ type: "error", text: this.l18n('image_type_not_allowed'), duration: 2000 });
            }

            this.$refs.dropzone.removeFile(file);
          }
        }
      }
    },

    removeImage() {
      this.post.image = null;
      this.hasUpload = false;
    },

    cancel() {
      this.hasUpload = false;
      this.reset();
      this.$parent.toggleForm();
    },

    reset() {
      this.post = {
        company: null,
        name: null,
        email: null,
        message: null,
        image: null,
      }
      this.hasUpload = false;
      this.errors = [];
    },

    submit() {

      if (!this.accept_tos) {
        this.$notify({ type: "error", text: this.l18n('accept_tos') });
        return;
      }

      this.$store.commit('isLoading', true); 
      this.axios.post('/api/post/save', {
        company: this.post.company,
        name: this.post.name,
        email: this.post.email,
        message: this.post.message,
        image: this.post.image,
      }).then(response => {
        this.$store.commit('isLoading', false); 
        this.reset();
        this.$notify({ type: "success", text: this.l18n('notification_success') });
        this.$emit('done');
      })
      .catch(error => {
        this.handleValidationErrors(error.response.data);
      });
    },

    maxFilesExceeded(file) {
      this.$refs.dropzone.removeAllFiles(true);
      this.$notify({ type: "error", text: this.l18n('image_max_files_exceeded'), duration: 2000 });
    },

    template: function () {
      return `<div class="dz-preview dz-file-preview">
              <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
              <div class="dz-error-message"><span data-dz-errormessage></span></div>
              <div class="dz-success-mark"><i class="fa fa-check"></i></div>
              <div class="dz-error-mark"><i class="fa fa-close"></i></div>
          </div>
      `;
    },
  },

	computed: {
		messageLength() {
      if (this.post.message) {
  			return `${this.post.message.length} ${this.l18n('characters')}`;
      }
      return this.l18n('characters_limit');
    },
  }
}
</script>
