<template>
  <div class="content-wrapper">
    <app-breadcrumb
      :page-title="$t('dashboard')"
      :directory="$t('dashboard')"
      :icon="'pie-chart'"
    />
    <div v-if="initialResponseCount < 2" class="card border-0 min-height-400">
      <app-overlay-loader />
    </div>
    <template v-else>
      <div class="row">
        <div class="col-xl-8 mb-primary">
          <div class="card card-with-shadow border-0 h-100">
            <div
              class="card-header bg-transparent p-primary d-flex justify-content-between align-items-center"
            >
              <h5 class="card-title mb-0">{{ $t("deals_overview") }}</h5>
              <ul class="nav tab-filter-menu justify-content-flex-end">
                <li
                  class="nav-item"
                  v-for="(item, index) in chartFilterOptions"
                  :key="index"
                >
                  <a
                    href="#"
                    class="nav-link py-0"
                    :class="[
                      dealsFilter == item.id
                        ? 'active'
                        : index === 0 && dealsFilter === ''
                        ? 'active'
                        : '',
                    ]"
                    @click.prevent="dealsFilterValue(item.id)"
                  >
                    {{ item.value }}
                  </a>
                </li>
              </ul>
            </div>

            <div class="card-body min-height-300">
              <app-overlay-loader v-if="lineChartLoad" />
              <template v-else>
                <app-chart
                  class="mb-primary"
                  type="custom-line-chart"
                  :height="230"
                  :labels="lineChartLabels"
                  :data-sets="lineChartData"
                />

                <div class="chart-data-list d-flex flex-wrap justify-content-center">
                  <div class="data-group-item" style="color: #4466f2">
                    <span class="square" style="background-color: #4466f2" />
                    {{ $t("open") }}

                    <span class="value">{{ openDeal }}</span>
                  </div>
                  <div class="data-group-item" style="color: #27ae60">
                    <span class="square" style="background-color: #27ae60" />
                    {{ $t("won") }}

                    <span class="value">{{ wonDeal }}</span>
                  </div>
                  <div class="data-group-item" style="color: #fc5710">
                    <span class="square" style="background-color: #fc5710" />
                    {{ $t("lost") }}

                    <span class="value">{{ lostDeal }}</span>
                  </div>
                  <div class="data-group-item" style="color: #a45ffd">
                    <span class="square" style="background-color: #a45ffd" />
                    {{ $t("total") }}

                    <span class="value">{{ totalDealOverview }}</span>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>
        <div class="col-xl-4 mb-primary">
          <div class="card card-with-shadow border-0 h-100">
            <div
              class="card-header bg-transparent p-primary d-flex justify-content-between align-items-center"
            >
              <h5 class="card-title mb-0">{{ $t("total_deals") }}</h5>
              <div class="badge dashboard-badge badge-pill text-capitalize">
                {{ totalDeal }}
              </div>
            </div>
            <app-overlay-loader v-if="dataload" />
            <div class="card-body" v-else>
              <app-chart
                class="mb-primary"
                type="dough-chart"
                :height="230"
                :labels="totalDealsLabels"
                :data-sets="totalDealsDataSet"
              />
              <div class="chart-data-list">
                <div class="d-flex justify-content-center">
                  <div v-for="(item, index) in totalDealsChartElement" :key="index">
                    <div class="data-group-item" :style="item.color">
                      <span class="square" :style="item.background_color" />
                      {{ item.key }}
                      <span class="value">{{ item.value }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <template v-if="$can('manage_public_access')">
        <div class="row">
          <div class="col-xl-4 mb-primary">
            <div class="card card-with-shadow border-0">
              <div
                class="card-header bg-transparent p-primary d-flex justify-content-between align-items-center"
              >
                <h5 class="card-title mb-0">{{ $t("total_contacts") }}</h5>
                <div class="badge dashboard-badge badge-pill text-capitalize">
                  {{ totalContact }}
                </div>
              </div>
              <div class="card-body p-primary">
                <div
                  v-for="(item, index) in contactList"
                  :key="index"
                  :class="index == contactList.length - 1 ? '' : 'pb-primary'"
                  class="dashboard-widgets dashboard-icon-widget"
                >
                  <div class="icon-wrapper">
                    <app-icon :key="item.icon" :name="item.icon" />
                  </div>
                  <div class="widget-data">
                    <h6>{{ item.value }}</h6>
                    <p>{{ item.title }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 mb-primary">
            <div class="card card-with-shadow border-0">
              <div
                class="card-header bg-transparent p-primary d-flex justify-content-between align-items-center"
              >
                <h5 class="card-title mb-0">{{ $t("total_employees") }}</h5>
                <div class="badge dashboard-badge badge-pill text-capitalize">
                  {{ totalEmployees }}
                </div>
              </div>
              <div class="card-body p-primary">
                <div
                  v-for="(item, index) in employeesList"
                  :key="index"
                  :class="index == employeesList.length - 1 ? '' : 'pb-primary'"
                  class="dashboard-widgets dashboard-icon-widget"
                >
                  <div class="icon-wrapper">
                    <app-icon :key="item.icon" :name="item.icon" />
                  </div>
                  <div class="widget-data">
                    <h6>{{ item.value }}</h6>
                    <p>{{ item.title }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 mb-primary">
            <div class="row dashboard-without-icon-widget mb-primary">
              <div class="col-xl-6 mb-4 mb-xl-0">
                <app-widget
                  :type="'app-widget-without-icon'"
                  :label="$t('total_sent_proposal')"
                  :number="totalSendProposal"
                />
              </div>
              <div class="col-xl-6">
                <app-widget
                  :type="'app-widget-without-icon'"
                  :label="$t('total_accepted_proposal')"
                  :number="totalAcceptedProposal"
                />
              </div>
            </div>
            <div class="row dashboard-circle-widget">
              <div class="col-xl-6 mb-4 mb-xl-0">
                <app-widget
                  :type="'app-widget-with-circle'"
                  :label="$t('sending_rate')"
                  :number="sendingRate"
                />
              </div>
              <div class="col-xl-6">
                <app-widget
                  :type="'app-widget-with-circle'"
                  :label="$t('acceptance_rate')"
                  :number="acceptanceRate"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-8 mb-4 mb-xl-0">
            <div class="card card-with-shadow border-0 h-100">
              <div
                class="card-header bg-transparent p-primary d-flex justify-content-between align-items-center"
              >
                <h5 class="card-title mb-0">{{ $t("deals_on_pipeline") }}</h5>
                <ul class="nav tab-filter-menu justify-content-flex-end">
                  <li
                    class="nav-item"
                    v-for="(item, index) in lineChartFilterOption"
                    :key="index"
                  >
                    <a
                      href="#"
                      class="nav-link py-0"
                      :class="[
                        lineChartFilterValue == item.id
                          ? 'active'
                          : index === 0 && lineChartFilterValue === ''
                          ? 'active'
                          : '',
                      ]"
                      @click.prevent="getLineChartFilterValue(item.id)"
                    >
                      {{ item.value }}
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body min-height-480">
                <app-overlay-loader v-if="pipelineDataload" />
                <app-chart
                  type="horizontal-line-chart"
                  v-else
                  :height="480"
                  :labels="HorizontalLineChartLabel"
                  :data-sets="HorizontalLineChartData"
                />
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="mb-primary">
              <app-widget
                :type="'app-widget-with-icon'"
                :label="$t('total_pipeline')"
                :number="totalPipeline"
                :icon="'sun'"
              />
            </div>
            <div class="card card-with-shadow border-0">
              <div
                class="card-header bg-transparent p-primary d-flex justify-content-between align-items-center"
              >
                <h5 class="card-title mb-0">{{ $t("top_five_owners") }}</h5>
              </div>
              <div class="card-body min-height-340">
                <app-overlay-loader v-if="dataload" />
                <app-chart
                  type="bar-chart"
                  v-else
                  :height="340"
                  :labels="barChartLabel"
                  :data-sets="barChartData"
                />
              </div>
            </div>
          </div>
        </div>
      </template>
    </template>
  </div>
</template>

<script>
import { FormMixin } from "../../../../core/mixins/form/FormMixin";

export default {
  name: "Dashboard",
  mixins: [FormMixin],
  data() {
    return {
      dataload: false,
      lineChartLoad: false,
      pipelineDataload: false,
      initialResponseCount: 0,

      // deals Overview - line chart
      chartFilterOptions: [
        { id: "last_seven_days", value: this.$t("last_seven_days") },
        { id: "this_week", value: this.$t("this_week") },
        { id: "last_week", value: this.$t("last_week") },
        { id: "this_month", value: this.$t("this_month") },
        { id: "last_month", value: this.$t("last_month") },
        { id: "this_year", value: this.$t("this_year") },
        { id: "total", value: this.$t("total") },
      ],
      dealsFilter: "last_seven_days",
      lineChartLabels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      lineChartData: [
        {
          title: this.$t("Open"),
          fill: false,
          borderWidth: 1.5,
          borderColor: "#4466F2",
          backgroundColor: "#4466F2",
          data: [20, 30, 40, 50, 60, 20, 50],
        },
        {
          title: this.$t("won"),
          fill: false,
          borderWidth: 1.5,
          borderColor: "#27AE60",
          backgroundColor: "#27AE60",
          data: [68, 57, 41, 66, 43, 59, 51],
        },
        {
          title: this.$t("lost"),
          fill: false,
          borderWidth: 1.5,
          borderColor: "#FC5710",
          backgroundColor: "#FC5710",
          data: [50, 100, 110, 50, 60, 20, 50],
        },
        {
          title: this.$t("total"),
          fill: false,
          borderWidth: 1.5,
          borderColor: "#A45FFD",
          backgroundColor: "#A45FFD",
          data: [10, 30, 30, 25, 10, 5, 6],
        },
      ],
      // Total deals - pie chart
      totalDealsLabels: [this.$t("open"), this.$t("won"), this.$t("lost")],
      totalDealsDataSet: [
        {
          backgroundColor: ["#4466F2", "#27AE60", "#FC5710"],
          data: [],
          borderWidth: 0,
        },
      ],
      totalDealsChartElement: [
        {
          key: this.$t("open"),
          value: 20,
          background_color: "background-color: #4466F2;",
          color: "color: #4466F2;",
        },
        {
          key: this.$t("won"),
          value: 25,
          background_color: "background-color: #27AE60;",
          color: "color: #27AE60;",
        },
        {
          key: this.$t("lost"),
          value: 40,
          background_color: "background-color: #FC5710;",
          color: "color: #FC5710;",
        },
      ],
      // Total Contacts - App widget
      contactList: [
        {
          icon: "briefcase",
          title: this.$t("total_organizations"),
          value: 10247,
        },
        {
          icon: "user",
          title: this.$t("people"),
          value: 10247,
        },
        {
          icon: "message-circle",
          title: this.$t("total_participants"),
          value: 10247,
        },
      ],
      // Total Employees - App widget
      employeesList: [
        {
          icon: "award",
          title: this.$t("work_as_owner"),
          value: 10247,
        },
        {
          icon: "user-plus",
          title: this.$t("work_as_collaborator"),
          value: 10247,
        },
        {
          icon: "users",
          title: this.$t("works_as_both_owner_and_collaborator"),
          value: 10247,
        },
      ],
      // Deals on pipeline - Horizontal line chart
      lineChartFilterOption: [
        { id: "status_open", value: this.$t("open") },
        { id: "status_won", value: this.$t("won") },
        { id: "status_lost", value: this.$t("lost") },
      ],
      lineChartFilterValue: "status_open",
      HorizontalLineChartLabel: [],
      HorizontalLineChartData: [
        {
          label: "Data",
          backgroundColor: [],
          barThickness: 25,
          data: [],
          borderWidth: 0,
        },
      ],
      // Top five owners - bar chart
      barChartLabel: [],
      barChartData: [
        {
          label: "Data",
          backgroundColor: "#4466F2",
          barThickness: 15,
          data: [],
          borderWidth: 0,
        },
      ],

      totalContact: null,
      totalEmployees: null,
      sendingRate: null,
      acceptanceRate: null,
      totalSendProposal: null,
      totalAcceptedProposal: null,
      totalPipeline: null,
      totalDeal: null,
      openDeal: null,
      wonDeal: null,
      lostDeal: null,
      totalDealOverview: null,
    };
  },
  mounted() {
    this.dashboardGetData();
    this.dealOverViewLineChartData();
  },
  methods: {
    dashboardGetData() {
      this.dataload = true;
      this.pipelineDataload = true;
      this.axiosGet(route("dashboard") + `?status=${this.lineChartFilterValue}`)
        .then((response) => {
          // Deal Chart
          this.totalDeal = response.data.total_deal; // Total Deal

          this.totalDealsDataSet.forEach((value, index) => {
            value.data = response.data.deals_chart;
          });

          this.totalDealsChartElement.forEach((element, index) => {
            element.value = response.data.total_deals_chart_element[index].value;
          });

          if (this.$can("manage_public_access")) {
            // Contact
            this.totalContact = response.data.total_contact;
            this.contactList.forEach((item, index) => {
              item.value = response.data.contacts[index].value;
            });

            // Employees
            this.totalEmployees = response.data.total_employee;
            this.employeesList.forEach((employee, index) => {
              employee.value = response.data.employees[index].value;
            });

            // Total send proposal
            this.totalSendProposal = response.data.total_send_proposal;

            // total accepted proposal
            this.totalAcceptedProposal = response.data.total_accepted_proposal;

            // Sending Rate
            this.sendingRate = response.data.sending_rate;

            //acceptance rate
            this.acceptanceRate = response.data.acceptance_rate;

            // Total Pipeline

            this.totalPipeline = response.data.total_pipeline;

            // Deal on Pipeline

            this.HorizontalLineChartLabel = response.data.deals_on_pipeline_name;

            this.HorizontalLineChartData.forEach((bgColor, index) => {
              bgColor.backgroundColor = response.data.background_color;
            });

            this.HorizontalLineChartData.forEach((element, index) => {
              element.data = response.data.pipeline_total_deals;
            });
            this.HorizontalLineChartData[0].data.push(0);

            // Top Five owner name
            this.barChartLabel = response.data.top_five_owners_name;
            this.barChartData.forEach((element, index) => {
              element.data = response.data.five_owner_deal;
            });
            this.barChartData[0].data.push(0);
          }
        })
        .finally(() => {
          this.dataload = false;
          this.pipelineDataload = false;
          this.initialResponseCount++;
        });
    },

    dealOverViewLineChartData() {
      this.lineChartLoad = true;
      this.axiosGet(route("deal.overview") + "?" + this.dealsFilter)
        .then((response) => {
          this.lineChartData.forEach((element, index) => {
            element.data = response.data.deal_over_view[index];
          });

          this.openDeal = response.data.open_deal; // Total Open Deal
          this.wonDeal = response.data.won_deal; // Total won Deal
          this.lostDeal = response.data.lost_deal; // Total lost Deal
          this.totalDealOverview = response.data.total_deal_overview;
        })
        .finally(() => {
          this.lineChartLoad = false;
          this.initialResponseCount++;
        });
    },

    dealsFilterValue(value) {
      this.dealsFilter = value;
      this.lineChartLoad = true;
      this.axiosGet(route("deal.overview") + "?" + this.dealsFilter)
        .then((response) => {
          if (
            this.dealsFilter == "last_seven_days" ||
            this.dealsFilter == "this_week" ||
            this.dealsFilter == "last_week"
          ) {
            this.lineChartLabels = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
          } else if (
            this.dealsFilter == "this_month" ||
            this.dealsFilter == "last_month"
          ) {
            this.lineChartLabels = response.data.deal_over_view[0].map((e, i) => {
              return i + 1;
            });
          } else if (this.dealsFilter == "this_year" || this.dealsFilter == "total") {
            this.lineChartLabels = [
              "Jan",
              "Feb",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec",
            ];
          }

          this.lineChartData.forEach((element, index) => {
            element.data = response.data.deal_over_view[index];
          });

          this.openDeal = response.data.open_deal; // Total Open Deal
          this.wonDeal = response.data.won_deal; // Total won Deal
          this.lostDeal = response.data.lost_deal; // Total lost Deal
          this.totalDealOverview = response.data.total_deal_overview;
        })
        .finally(() => {
          this.lineChartLoad = false;
        });
    },

    getLineChartFilterValue(value) {
      this.lineChartFilterValue = value;
      this.pipelineDataload = true;
      this.axiosGet(route("dashboard") + `?status=${this.lineChartFilterValue}`)
        .then((response) => {
          this.HorizontalLineChartLabel = response.data.deals_on_pipeline_name;

          this.HorizontalLineChartData.forEach((bgColor, index) => {
            bgColor.backgroundColor = response.data.background_color;
          });

          this.HorizontalLineChartData.forEach((element, index) => {
            element.data = response.data.pipeline_total_deals;
          });
          this.HorizontalLineChartData[0].data.push(0);
        })
        .finally(() => {
          this.pipelineDataload = false;
        });
    },
  },
};
</script>
