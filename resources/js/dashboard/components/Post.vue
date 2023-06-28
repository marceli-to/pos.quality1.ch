<template>
  <figure class="post">
    <img :src="`/image/polaroid/${post.image}`" width="480" height="480">
    <figcaption>
      {{post.company}}<br>
      {{post.name}}<br>
      {{post.email}}<br>
      <strong>{{post.message}}</strong>
    </figcaption>
      <nav>
        <a
          href="javascript:;"
          @click.prevent="toggle(post.id,$event)"
        >
          <span v-if="post.publish" class="feather-icon">
            <eye-icon size="20"></eye-icon>
          </span>
          <span v-else>
            <eye-off-icon size="20" class="feather-icon"></eye-off-icon>
          </span>
        </a>
        <a
          href="javascript:;"
          class="feather-icon"
          @click.prevent="destroy(post.id,$event)"
          v-if="!post.deleted_at"
        >
          <trash2-icon size="20"></trash2-icon>
        </a>
        <a
          href="javascript:;"
          class="feather-icon"
          @click.prevent="restore(post.id,$event)"
          v-if="post.deleted_at"
        >
          <refresh-cw-icon size="18"></refresh-cw-icon>
        </a>
      </nav>
  </figure>
</template>
<script>

// Icons
import { EyeIcon, EyeOffIcon, Trash2Icon, RefreshCwIcon} from 'vue-feather-icons';

export default {

  components: {
    EyeIcon,
    EyeOffIcon,
    Trash2Icon,
    RefreshCwIcon
  },

  props: {
    post: {
      type: Object,
      default: null,
    }
  },

  methods: {

    toggle(id,$event) {
      this.$parent.toggle(id, $event);
    },

    destroy(id,$event) {
      this.$parent.destroy(id, $event);
    },

    restore(id,$event) {
      this.$parent.restore(id, $event);
    },
  }
}
</script>
