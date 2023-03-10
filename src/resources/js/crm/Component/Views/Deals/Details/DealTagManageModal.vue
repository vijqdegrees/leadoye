<template>
    <app-modal :modal-scroll="false" modal-id="tag-modal" @close-modal="closeModal">
        <template slot="header">
            <h5 class="modal-title">{{ $t("manage_tag") }}</h5>
            <button
                type="button"
                class="close outline-none"
                data-dismiss="modal"
                aria-label="Close"
            >
          <span>
            <app-icon :name="'x'"></app-icon>
          </span>
            </button>
        </template>
        <template slot="body">
            <app-tag-manager
                :tags="tags"
                :list="allTags"
                list-value-field="name"
                color-value-field="color_code"
                :tag-preloader="tagPreloader"
                @storeTag="storeAndAttachTag"
                @attachTag="attachTag"
                @detachTag="detachTag"
            />
        </template>
        <template slot="footer">
            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" @click.prevent="closeModal">
                {{ $t('close') }}
            </button>
        </template>
    </app-modal>
</template>

<script>
import {FormMixin} from "@core/mixins/form/FormMixin";
export default {
    name: "DealTagManageModal",
    mixins: [FormMixin],
    props:['taggableId', 'tagList', 'postUrl'],
    data() {
        return {
            tags: [],
            tagOptions: [],
            tagPreloader: false,
        }
    },
    mounted() {
        this.$store.dispatch('getAllTags');
    },
    watch: {
        'tagList': {
            handler: function (tags) {
                this.tags = tags.map(item => item)
            },
            immediate: true
        }
    },
    computed: {
        allTags() {
            return this.$store.getters.getAllTags.map((tag)=>{
                return {
                    id: tag.id,
                    color_code: tag.color_code,
                    name: tag.name
                };
            });
        }
    },
    methods: {
        storeAndAttachTag({name, color_code}) {
            this.tagPreloader = true;
            this.axiosPost({
                url: route('tags.store'),
                data: {name, color_code}
            }).then(response => {
                this.$store.dispatch('getAllTags');
                this.attachTag(response.data);
            }).catch((error) => this.$toastr.e(error.response.data.errors.name[0]));
        },
        attachTag(tag) {
            this.tagPreloader = true;
            this.axiosPost({
                url: this.postUrl + this.taggableId,
                data: {tag_id:tag.id}
            }).then(response => {
                this.$toastr.s(response.data.message);
                this.tags.push(tag);
                this.$emit("changed-tag-list", true);
                this.tagPreloader = false;
            });
        },
        detachTag(tag) {
            this.tagPreloader = true;
            this.axiosPut({
                url: this.postUrl + this.taggableId,
                data: {tag_id:tag.id}
            }).then(response => {
                this.$toastr.s(response.data.message);
                let index = this.tags.indexOf(tag);
                this.tags.splice(index, 1);
                this.$emit("changed-tag-list", true);
                this.tagPreloader = false;
            })
        },
        closeModal(value){
            this.$emit("close-modal", value);
        },
    },
}
</script>
