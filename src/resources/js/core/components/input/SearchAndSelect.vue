<template>
    <div class="single-filter search-filter-dropdown">
        <div class="dropdown dropdown-with-animation" :class="{'disabled':data.disabled}">
            <div :id="inputFieldId"
                 data-toggle="dropdown"
                 aria-haspopup="true"
                 aria-expanded="false">
                <input type="text"
                       class="form-control cursor-pointer"
                       :placeholder="data.placeholder"
                       :disabled="data.disabled"
                       @click="startNavigation"
                       :value="showValue">
            </div>

            <div class="dropdown-menu py-0 my-1 w-100" :class="data.listClass" :aria-labelledby="inputFieldId">
                <div class="form-group form-group-with-search">
                    <span class="form-control-feedback">
                        <app-icon name="search"/>
                    </span>
                    <input type="text"
                           ref="searchInput"
                           :class="'form-control '+data.listItemInputClass"
                           :placeholder="$t('search')"
                           v-model="searchValue"
                           @input="search($event)"
                           @keydown.down="navigateDown"
                           @keydown.up="navigateUp"
                           @keydown.enter.prevent="enterSelectedValue"
                           :autofocus="startNavigation">
                </div>
                <div class="dropdown-divider my-0"/>
                <div class="dropdown-search-result-wrapper custom-scrollbar" ref="optionList" @scroll="loadMore">
                    <a class="dropdown-item"
                       href="#"
                       v-for="(item,index) in list"
                       :class="{'active': index === activeIndex, [data.listItemClass]: !isUndefined(data.listItemClass), 'selected': item.id === value, 'disabled': item.disabled}"
                       @click.prevent="changeSelectedValue(item)"
                       :key="`${inputFieldId}-${index}`">
                        {{ item[data.listValueField] }}
                        <span class="check-sign float-right">
                            <app-icon name="check" class="menu-icon"/>
                        </span>
                    </a>
                    <div style="min-height: 30px;">
                        <div v-if="isLoading" class="dropdown-item position-relative">
                            <app-pre-loader v-if="data.options.loader === 'app-pre-loader'" />
                            <app-overlay-loader v-else />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {InputMixin} from './mixin/InputMixin.js';
import {NavigationMixin} from "./mixin/NavigationMixin";
import CoreLibrary from "../../helpers/CoreLibrary";

export default {
    name: "SearchAndSelect",
    mixins: [InputMixin, NavigationMixin],
    extends: CoreLibrary,
    data() {
        return {
            selectedValue: '',
            searchValue: '',
            list: [],
            loadedIndex: this.data.loadedPerTime,
            moreTagLoading: false,
            isLoading: false,
            noMoreData: false,
            pageNumber: 1,
            per_page: 10,
            query_name: 'search'
        }
    },
    mounted() {
        $('.dropdown').on('hide.bs.dropdown', () => {
            this.searchValue = ''
            this.loadedIndex = this.data.loadedPerTime;
        });
        this.addToList(this.searchValue);
    },
    created() {
        const { per_page, query_name } = this.data.options;
        if(per_page)this.per_page = per_page;
        if(query_name)this.query_name = query_name;
    },
    computed: {
        showValue() {
            let item = this.list.filter(item => {
                return item.id == this.value;
            });
            return item.length === 1 ? item[0][this.data.listValueField] : '';
        }
    },
    methods: {
        changed() {
            this.$emit('input', this.selectedValue);
        },
        changeSelectedValue(value) {
            this.selectedValue = value.id;
            this.searchValue = "";
            this.navigationStart = false;
            this.changed();
        },
        enterSelectedValue() {
            this.options.filter((item, index) => {
                if (index == this.activeIndex) {
                    this.changeSelectedValue(item)
                }
            });
            this.endNavigation();
        },
        clear() {
            this.selectedValue = '';
            this.changed();
        },
        addToList(searchText){
            let url = `${this.data.options.url}?${this.query_name}=${searchText}&` + new URLSearchParams({ page: this.pageNumber, per_page: this.per_page, ...this.data.options.params});
            this.isLoading = true;
            setTimeout(()=> {
                fetch(url).then(res => {
                    if(res.ok){
                        return res.json()
                    }
                }).then(res => {
                    if (this.data.options.modifire) this.list = [...this.list , ...res.data.map(item => this.data.options.modifire(item))]
                    else this.list = [...this.list, ...res.data]
                    this.isLoading = false;
                    this.noMoreData = res.data.length !== this.per_page
                })
            }, 1000)
        },
        searchAndSet(searchText){
            this.selectedValue = '';
            this.noMoreData = false;
            this.pageNumber = 1;
            this.list = [];
            this.addToList(searchText);
        },
        addMore(searchText){
            if(!this.noMoreData){
                this.pageNumber = this.pageNumber+1;
                this.addToList(searchText);
            }
        },
        search: _.debounce(function(key) {
            this.searchAndSet(key.target.value);
        }, 500),
        loadMore: _.debounce(function(e) {
            if (!this.isLoading) {
                let scrollBar = e.target;
                let isReachBottom = (scrollBar.scrollTop + scrollBar.clientHeight >= scrollBar.scrollHeight - 20);
                isReachBottom && this.addMore(this.searchValue);
            }
        }, 500),
    },
}
</script>