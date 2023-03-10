<template>
    <app-modal modal-id="deal-activity-modal" modal-size="large" modal-alignment="top" @close-modal="closeModal">
        <template slot="header">
            <h5  class="modal-title">{{selectedUrl ? $t("edit") : $t("add")}} {{$t('activity_lowercase')}}</h5>
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
            <form v-if="dataLoaded" ref="form" :data-url="selectedUrl ? selectedUrl : route('activities.store')">
                <div class="form-group">
                    <div class="form-row">
                        <label class="col-2 mb-0 d-flex align-items-center">
                            {{ $t('activity') }}
                        </label>
                        <div class="col-10">
                            <app-input type="radio-buttons"
                                       list-value-field='name'
                                       :list="activityTypeList"
                                       v-model="activity.activity_type_id"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <label class="col-2 mb-0 d-flex align-items-center">
                            {{ $t('title') }}
                        </label>
                        <div class="col-10">
                            <app-input type="text"
                                       :placeholder="$t('enter_title')"
                                       v-model="activity.title"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <label class="mb-0 col-sm-2">{{ $t('description') }}</label>
                        <div class="col-sm-10">
                            <app-input
                                    type="textarea"
                                    :text-area-rows="5"
                                    :placeholder="$t('description_here')"
                                    v-model="activity.description"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <label class="col-sm-2 mb-0 d-flex align-items-center">{{
                            $t("set_schedule")
                            }}</label>
                        <div class="col-sm-10">
                            <div class="d-flex align-items-center flex-column flex-sm-row">
                                <div class="row">
                                    <div class="col-lg-7 pr-lg-0">
                                        <app-input
                                                type="date"
                                                :placeholder="$t('start_date')"
                                                v-model="formData.started_at"
                                                @input="setEndDateAsStartDate"
                                        />
                                    </div>
                                    <div class="col-lg-5 pl-lg-0">
                                        <app-input
                                                type="time"
                                                :placeholder="$t('start_time')"
                                                v-model="activity.start_time"
                                                @input="setStart($event)"
                                        />
                                    </div>
                                </div>
                                <div
                                        class="d-flex align-items-center justify-content-center schedule-divider"
                                />
                                <div class="row">
                                    <div class="col-lg-7 pr-lg-0">
                                        <app-input
                                                type="date"
                                                :min-date="formData.started_at"
                                                :placeholder="$t('end_date')"
                                                v-model="formData.ended_at"
                                        />
                                    </div>
                                    <div class="col-lg-5 pl-lg-0">
                                        <app-input
                                                type="time"
                                                :placeholder="$t('end_time')"
                                                v-model="activity.end_time"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Participants input -->
                <div class="form-group">
                    <div class="form-row">
                        <label class="mb-0 col-sm-2 d-flex align-items-center">{{ $t('participants') }}</label>
                        <div class="col-sm-10">
                            <app-input
                                    type="multi-select"
                                    list-value-field="name"
                                    :list="personList"
                                    v-model="formData.person_id"
                                    :is-animated-dropdown="true"
                            />
                        </div>
                    </div>
                </div>
                <!-- end of Participants input -->

                <!-- Collaborators input -->
                <div class="form-group">
                    <div class="form-row">
                        <label class="mb-0 col-sm-2 d-flex align-items-center">{{ $t('collaborators') }}</label>
                        <div class="col-sm-10">

                            <app-input type="multi-select"
                                       list-value-field="full_name"
                                       :list="ownerList"
                                       :required="true"
                                       v-model="formData.owner_id"
                                       :is-animated-dropdown="true"/>
                        </div>
                    </div>
                </div>
                <!-- end of Collaborators input -->

                <!-- Activity reminder -->
                <div class="form-group">
                    <div class="form-row">
                        <label class="mb-0 col-sm-2 d-flex align-items-center">{{ $t("set_reminder") }}</label>
                        <div class="col-sm-5">
                            <app-input
                                type="select"
                                list-value-field="title"
                                :list="setReminderType"
                                :placeholder="$t('choose_your_activity_type')"
                                v-model="formData.reminder_type"
                            />
                            <small class="text-danger" v-if="errors.reminder_type">{{
                                    errors.reminder_type[0]
                                }}</small>
                        </div>
                        <div class="col-sm-5" v-if="formData.reminder_type == 'custom'">
                            <app-input
                                type="date"
                                date-mode="dateTime"
                                :min-date="new Date()"
                                :max-date="formData.started_at"
                                :placeholder="$t('set_reminder')"
                                v-model="formData.reminder_on"
                            />
                            <small class="text-danger" v-if="errors.reminder_on">{{
                                    errors.reminder_on[0]
                                }}</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <app-note :notes="reminderNotification"
                                      :show-title="false"
                                      :content-type="'html'"
                                      class="mt-2"
                                      note-type="note-warning"/>
                        </div>
                    </div>
                </div>
            </form>
            <app-overlay-loader v-else />
        </template>
        <template slot="footer">
            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" @click.prevent="closeModal">
                {{ $t('cancel') }}
            </button>
            <button type="button" class="btn btn-primary" @click.prevent="submitData">
                        <span class="w-100">
                            <app-submit-button-loader v-if="loading"></app-submit-button-loader>
                        </span>
                <template v-if="!loading">{{ $t('save') }}</template>
            </button>
        </template>
    </app-modal>
</template>

<script>
    import {FormMixin} from "@core/mixins/form/FormMixin";
    import { mapGetters } from 'vuex'
    import index from "../../../../Store";
    import {
        time_format,
        formatted_date,
        onlyTime,
        formatted_time,
    } from "@app/Helpers/helpers";
    import moment from "moment";
    import {formatDateTimeForServer} from "../../../../Helpers/helpers";

    export default {
        name: "DealActivityModal",
        props:['activity'],
        mixins: [FormMixin],
        data(){
          return{
              reminderNotification: [
                  `${this.$t('activity_cron_job_note')} <a href="https://pipex.gainhq.com/documentation/important-settings.html#scheduler-queue" target="_blank">
                                <app-icon name="alert-circle" class="size-18 mr-2"/>
                                ${this.$t('see_documentation')}</a>`
              ],
              route,
              errors: {},
            dataLoaded: false,
            loading: false,
            activityTypeList: [],
            formData:{
              person_id: [],
              owner_id: [],
            },
          }
        },
        computed:{
            ...mapGetters({
                personList: "getPerson",
                ownerList: "getOwner",
            }),
            setReminderType() {
                return [
                    {
                        id: '',
                        title: this.$t("none"),
                    },
                    {
                        id: '15mins',
                        title: this.$t("15mins"),
                    },
                    {
                        id: '1hr',
                        title: this.$t("1hr"),
                    },
                    {
                        id: '1day',
                        title: this.$t("1day"),
                    },
                    {
                        id: 'custom',
                        title: this.$t("custom"),
                    },
                ];
            },
        },
        methods:{
            setEndDateAsStartDate() {
                let s = moment(moment(this.formData.started_at).format("YYYY-MM-DD")),
                    e = moment(moment(this.formData.ended_at).format("YYYY-MM-DD")),
                    diff = e.diff(s, "days");
                if (diff < 0){
                    this.formData.ended_at = this.formData.started_at;
                }
            },
            setStart(v) {
                if (
                    this.formData.started_at.toDateString() ==
                    this.formData.ended_at.toDateString()
                ) {
                    this.activity.end_time =
                        this.convertTime12to24(v) > this.convertTime12to24(this.activity.end_time)
                            ? this.activity.start_time
                            : this.activity.end_time;
                }
            },
            convertTime12to24(time12h) {
                if (formatted_time() == 24) {
                    return time12h;
                }
                const [time, modifier] = time12h.split(" ");

                let [hours, minutes] = time.split(":");

                if (hours === "12") {
                    hours = "00";
                }

                if (modifier === "PM") {
                    hours = parseInt(hours, 10) + 12;
                }

                return `${hours}:${minutes}`;
            },
            submitData(){
                this.loading = true;
                let started_at = moment(this.formData.started_at).format(
                    "YYYY-MM-DD"
                );
                let start_time = this.convertTime12to24(this.activity.start_time);
                let start = formatDateTimeForServer(moment(started_at + ' ' + start_time, "YYYY-MM-DD HH:mm"))

                let ended_at = moment(this.formData.ended_at).format(
                    "YYYY-MM-DD"
                );
                let end_time = this.convertTime12to24(this.activity.end_time);
                let end = formatDateTimeForServer(moment(ended_at + ' ' + end_time, "YYYY-MM-DD HH:mm"))

                const activityData = this.formData;
                activityData.activity_type_id = this.activity.activity_type_id;
                activityData.title = this.activity.title;
                activityData.description = this.activity.description;
                activityData.reminder_type = this.formData.reminder_type;
                activityData.reminder_on =  formatDateTimeForServer(this.formData.reminder_on)
                activityData.started_at = moment(start).format(
                    "YYYY-MM-DD"
                );
                activityData.start_time = moment(start).format(
                    "HH:mm"
                );
                activityData.ended_at = moment(end).format(
                    "YYYY-MM-DD"
                );
                activityData.end_time = moment(end).format(
                    "HH:mm"
                );
                activityData.contextable_id = this.activity.contextable_id;
                activityData.contextable_type = this.activity.contextable_type;
                activityData.person_id = this.formData.person_id;
                activityData.owner_id = this.formData.owner_id;
                 this.axiosPatch({
                     url:route('activities.update', this.activity.id),
                     data:activityData
             }).then(response => {
                 this.$toastr.s(response.data.message);
                 this.loading = false;
                 this.$hub.$emit('activity-list', `status=11`);
                 this.closeModal();
             }).catch((error) => console.log(error))
            },
            closeModal(value){
                this.$emit("close-modal", value);
            },
            afterSuccessFromGetEditData(response) {
                let start = moment(response.data.started_at + ' ' + response.data.start_time).utc(true)
                    .local()

                this.formData.started_at = response.data.started_at
                    ? new Date(start)
                    : "";
                this.activity.start_time = response.data.start_time
                    ? moment(start).format(`${time_format()}`)
                    : "";

                let end = moment(response.data.ended_at + ' ' + response.data.end_time).utc(true)
                    .local()

                this.formData.ended_at = response.data.ended_at
                    ? new Date(end)
                    : "";
                this.activity.end_time = response.data.end_time
                    ? moment(end).format(`${time_format()}`)
                    : "";
                this.formData.reminder_on = new Date(moment(this.activity.reminder_on).utc(true)
                    .local())

                response.data.collaborators.map((v, i) => {
                    this.formData.owner_id.push(v.id)
                });
                response.data.participants.map((v, i) => {
                    this.formData.person_id.push(v.id)
                });
            },
            pipeline(funcArr) {
                funcArr.forEach((obj) => {
                    if (Promise.resolve(obj) !== obj) {
                        throw new Error(
                            "Expects all methods are passed in parameter array should return Promise"
                        );
                    }
                });
                return Promise.all(funcArr);
            },
            getActivityType() {
                return this.axiosGet(route('activity_types.index'))
                    .then((response) => {
                        this.activityTypeList = this.collection(response.data.data).shaper(
                            "name"
                        );
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
        },
        mounted(){
            if (this.activity) {
                let start = moment(this.activity.started_at + ' ' + this.activity.start_time).utc(true)
                    .local()

                this.formData.started_at = this.activity.started_at
                    ? new Date(start)
                    : "";
                this.activity.start_time = this.activity.start_time
                    ? moment(start).format(`${time_format()}`)
                    : "";

                let end = moment(this.activity.ended_at + ' ' + this.activity.end_time).utc(true)
                    .local()

                this.formData.ended_at = this.activity.ended_at
                    ? new Date(end)
                    : "";
                this.activity.end_time = this.activity.end_time
                    ? moment(end).format(`${time_format()}`)
                    : "";
                this.formData.reminder_type = this.activity.reminder_type;
                this.formData.reminder_on = new Date(moment(this.activity.reminder_on).utc(true)
                    .local())
            }

            this.pipeline([this.getActivityType()])
                .then(() => {
                    this.dataLoaded = true;
                })
                .catch((err) => console.log(err));

        },

    }
</script>

<style scoped>

</style>
