<template>
  <div class="listing__item-action">

    <div v-if="hasPreview">
      <a
        :href="'/projekt/' + id"
        class="feather-icon"
        target="_blank"
      >
        <arrow-up-right-icon size="18"></arrow-up-right-icon>
      </a>
    </div>

    <div v-if="hasGrid">
      <router-link
        :to="{name: routes.grid, params: { id: id }}"
        class="feather-icon"
      >
        <grid-icon size="18"></grid-icon>
      </router-link>
    </div>

    <div v-if="hasDownload">
      <a
        :href="routes.download"
        class="feather-icon"
        target="_blank"
      >
        <download-cloud-icon size="18"></download-cloud-icon>
      </a>
    </div>

    <div v-if="hasToggle">
      <a
        href="javascript:;"
        @click.prevent="toggle(id,$event)"
      >
        <span v-if="record.publish" class="feather-icon">
          <eye-icon size="18"></eye-icon>
        </span>
        <span v-else>
          <eye-off-icon size="18" class="feather-icon"></eye-off-icon>
        </span>
      </a>
    </div>

    <div v-if="hasEdit">
      <router-link
        :to="{name: routes.edit, params: { id: id }}"
        class="feather-icon"
      >
        <edit-icon size="18"></edit-icon>
      </router-link>
    </div>

    <div v-if="hasEditInline">
      <a
        href="javascript:;"
        class="feather-icon"
        @click.prevent="find(id,$event)"
      >
        <edit-icon size="18"></edit-icon>
      </a>
    </div>

    <div v-if="hasEditOverlay">
      <a
        href="javascript:;"
        class="feather-icon"
        @click.prevent="showOverlay(id,$event)"
      >
        <edit-icon size="18"></edit-icon>
      </a>
    </div>

    <div v-if="hasCopy">
      <a
        href="javascript:;"
        class="feather-icon"
        @click.prevent="copy(id,$event)"
      >
        <copy-icon size="18"></copy-icon>
      </a>
    </div>

    <div v-if="hasDestroy">
      <a
        href="javascript:;"
        class="feather-icon"
        @click.prevent="destroy(id,$event)"
      >
        <trash2-icon size="18"></trash2-icon>
      </a>
    </div>

    <div v-if="hasRestore">
      <a
        href="javascript:;"
        class="feather-icon"
        @click.prevent="restore(id,$event)"
      >
        <refresh-cw-icon size="18"></refresh-cw-icon>
      </a>
    </div>

  </div>
</template>
<script>

// Icons
import { 
  EyeIcon,
  EyeOffIcon,
  EditIcon,
  Trash2Icon,
  CopyIcon,
  DownloadCloudIcon,
  GridIcon,
  ArrowUpRightIcon,
  RefreshCwIcon

} from 'vue-feather-icons';

export default {

  components: {
    EyeIcon,
    EyeOffIcon,
    EditIcon,
    Trash2Icon,
    CopyIcon,
    DownloadCloudIcon,
    GridIcon,
    ArrowUpRightIcon,
    RefreshCwIcon
  },

  props: {

    id: {
      type: Number,
      default: null
    },

    hasEdit: {
      type: Boolean,
      default: true
    },

    hasEditInline: {
      type: Boolean,
      default: false
    },

    hasGrid: {
      type: Boolean,
      default: false
    },
    
    hasDestroy: {
      type: Boolean,
      default: true
    },
    
    hasToggle: {
      type: Boolean,
      default: true
    },

    hasDownload: {
      type: Boolean,
      default: false
    },

    hasPreview: {
      type: Boolean,
      default: false
    },
    
    hasRestore: {
      type: Boolean,
      default: false
    },

    hasCopy: {
      type: Boolean,
      default: false
    },

    isDraggable: {
      type: Boolean,
      default: false
    },

    hasEditOverlay: {
      type: Boolean,
      default: false
    },

    routes: Object,
    record: Object,
  },

  methods: {

    toggle(id,$event) {
      let parent = this.$props.isDraggable ? this.$parent.$parent : this.$parent;
      parent.toggle(id, $event);
    },

    destroy(id,$event) {
      let parent = this.$props.isDraggable ? this.$parent.$parent : this.$parent;
      parent.destroy(id, $event);
    },

    restore(id,$event) {
      let parent = this.$props.isDraggable ? this.$parent.$parent : this.$parent;
      parent.restore(id, $event);
    },

    find(id,$event) {
      let parent = this.$props.isDraggable ? this.$parent.$parent : this.$parent;
      parent.find(id, $event);
    },

    copy(id,$event) {
      let parent = this.$props.isDraggable ? this.$parent.$parent : this.$parent;
      parent.copy(id,$event);
    },

    showOverlay(id, $event) {
      this.$parent.showOverlay(id);
    }
  },
}
</script>

