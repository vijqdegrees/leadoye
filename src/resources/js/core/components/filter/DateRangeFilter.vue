<template>
    <date-range-picker
        :label="label"
        :preset-ranges="presetRanges"
        :i18n="'custom'"
        @changed="changed"
        :visible-value="visibleValue"
        :table-id="tableId"
        :active="active"
    />
</template>

<script>
    import { FilterMixin } from './mixins/FilterMixin';
    import DateRangePicker from "../date-range-picker/DateRangePicker";
    export default {
        name: "DateRangeFilter",
        mixins:[FilterMixin],
        components:{DateRangePicker},
        props:{
            label:{type:String},
            presetRanges:{type:Array},
            visibleValue:{type:Boolean}
        },
        methods: {
            changed(value) {
                this.returnValue(value)
            },
        },
    }
</script>
