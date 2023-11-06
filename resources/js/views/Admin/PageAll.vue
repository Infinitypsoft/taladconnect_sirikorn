<template>
    <v-app>
        <Navbar />
        <router-view />
    </v-app>
</template>
<script>
import Navbar from '../Admin/Navbar.vue'
export default {
    name: 'pageAll',
    components: {
        Navbar,
    }
}
</script>

<style lang="scss">
.container-title-left {
    display: flex;
    justify-content: flex-end;

    // margin-top: 16px;
    @media screen and (max-width: 960px) {
        justify-content: start;
        margin-top: -16px;
    }
}

.container-input-contact {
    @media screen and (max-width: 960px) {
        display: flex;
        flex-direction: column;
    }
}

.v-data-table-header {
    background: rgba(116, 176, 136, 0.19);
}

.theme--light.v-data-table>.v-data-table__wrapper>table>thead>tr:last-child>th {
    color: #707070;
    font-size: 16px;
    font-weight: 500;
}

.v-tabs-bar .v-tab {
    font-size: 18px;
}

.btn-back {
    border-radius: 30px !important;
    border: 1px solid var(--primary-button, #86D780) !important;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) !important;

    color: #60A577 !important;
    font-size: 16px !important;
    font-style: normal !important;
    font-weight: 500 !important;
    line-height: normal !important;
}

.title-color-bar {
    height: 37px;
    background: #86D780;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
}

.row-list {
    display: flex;
    justify-content: flex-start;

    @media screen and (max-width: 960px) {
        flex-direction: column;

        .image-list-slide {
            display: flex;
            justify-content: center;
            width: 100% !important;
            max-width: 100% !important;
        }
    }

    .col-list {
        width: fit-content;
        max-width: fit-content;

    }
}

.v-data-table__wrapper>table tbody td {
    font-size: 16px !important;
    color: #707070 !important;
    font-style: normal !important;
    font-weight: 500 !important;
    line-height: normal !important;
}

.custom-cancel-status {
    padding: 2px 24px;
    flex-shrink: 0;
    border-radius: 10px !important;
    background: linear-gradient(90deg, #E10122 0%, #9D0A0F 100%) !important;
    color: #FFF !important;
    text-align: center !important;
    font-size: 12px !important;
    font-style: normal;
    font-weight: 500 !important;
    line-height: normal;
}

.v-application p {
    padding-bottom: 0 !important;
    // margin-bottom: 0 !important;
}
</style>

<style>
@import url("https://fonts.googleapis.com/css?family=Sarabun&display=swap");
@import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap');

html,
body,
#app {
    font-family: 'Kanit', sans-serif !important;
    /* font-family: 'Sarabun', sans-serif !important; */
    font-size: 14px !important;
    height: 100vh;
    background-color: #f8f8f8;
}

.container {
    padding: 0 40px !important;
    margin: 0 !important;
    max-width: 100% !important;
}

.object-fit-cover {
    object-fit: cover;
}

.font-bold {
    font-weight: 600 !important;
}

.font-20 {
    font-size: 20px !important;
}

.font-18 {
    font-size: 18px !important;
}

.font-16 {
    font-size: 16px !important;
}

.font-14 {
    font-size: 14px !important;
}

.font-12 {
    font-size: 12px !important;
}

.icon-5x {
    font-size: 5em !important;
}

.mr-10 {
    margin-right: 10px !important;
}

.m-0 {
    margin: 0px !important;
}

.br-10 {
    border-radius: 10px !important;
}

.br-5 {
    border-radius: 5px !important;
}

.font-weight-400 {
    font-weight: 400;
}

.text-error {
    color: #E60023;
}

.text-footer-table {
    color: #B7B7B7;
    font-family: Kanit;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.radius-30 {
    border-radius: 30px !important;
}

.v-breadcrumbs__item {
    color: var(--primary-text, #707070) !important;
    font-size: 16px !important;
    font-weight: 500 !important;
}

.v-card__title {
    color: #707070;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.text-card-title {
    color: #707070 !important;
    font-size: 18px !important;
    font-style: normal;
    font-weight: 600 !important;
    line-height: normal;
}


.text-ex {
    color: #707070;
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    margin-bottom: 16px !important;
}

/* Color */
.color-title-modal {
    border-radius: 5px 0px;
    background: #F8F8F8;
}

.color-title-modal>h3 {
    color: #000;
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.color-title-card {
    color: #60A577;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.color-title-detail {
    color: #707070;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.color-search-title {
    color: #8AB4F7;
}

/* Button */
.btn-save {
    border-radius: 30px;
    background: linear-gradient(90deg, #86D780 0%, #60A577 100%) !important;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) !important;
}

.btn-save>span {

    color: #FFF;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.btn-close-modal {
    position: absolute !important;
    top: -17px;
    right: -30px;
    z-index: 999;
    border-radius: 5px !important;
    background: #F8F8F8;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) !important;
    width: 50px !important;
    min-width: 50px !important;
    height: 50px !important;
    padding: 0 !important;
}

.position-absolute {
    position: absolute;
}

.position-relative {
    position: relative;
}

/* Screen */

.screen-column-960 {
    @media screen and (max-width: 960px) {
        flex-direction: column;
    }
}

.mag-modal {
    color: #000;
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    margin-bottom: 0;
}

.ml-0 {
    margin-left: 0;
}

.mr-0 {
    margin-right: 0;
}

.mb-32 {
    margin-bottom: 32px;
}

.mb-40 {
    margin-bottom: 40px;
}

.mb-70 {
    margin-bottom: 70px;
}

.mt-120 {
    margin-top: 120px !important;
}

.mt-105 {
    margin-top: 105px !important;
}

/* Width */
.w-100 {
    width: 100% !important;
}

.w-104 {
    width: 104px !important;
}

.w-424 {
    width: 424px !important;
}

.max-w-419 {
    max-width: 419px !important;
}

.max-w-540 {
    max-width: 540px !important;
}

.max-w-100 {
    max-width: 100% !important;
}

.w-925 {
    width: 925px !important;
}

.w-1226 {
    width: 1226px !important;
}

/* Height */
.h-100 {
    height: 100% !important;
}

.h-478 {
    height: 478px !important;
}

.h-65 {
    height: 65px !important;
}

.h-1781 {
    height: 1781px !important;
}

.max-h-250 {
    max-height: 250px !important;
}

.max-h-238 {
    max-height: 238px !important;
}

.max-h-245 {
    max-height: 245px !important;

}

.max-h-500 {
    max-height: 500px !important;

}

.mt-0 {
    margin-top: 0 !important;
}

.br-1 {
    border-radius: 4px;
}

.br-23 {
    border-radius: 23px !important;
}

.bg-none {
    background: none !important;
    ;
}

.box-shadow-none {
    box-shadow: none !important;
    ;
}

.hfc {
    height: fit-content !important;
}

.ofh {
    overflow: hidden !important;
}

.p-20 {
    padding: 20px !important;
}

.fs-12 {
    font-size: 12px !important;
}

.fs-20 {
    font-size: 20px !important;
}

.fs-46 {
    font-size: 46px !important;
}

.p-0 {
    padding: 0px !important;
}

.pl-30 {
    padding-left: 30px !important;
}

.pt-25 {
    padding-top: 25px !important;
}

.pr-30 {
    padding-right: 30px !important;
}

.pb-100 {
    padding-bottom: 100px !important;
}

.pl-60 {
    padding-left: 60px;
}

.pl-120 {
    padding-left: 120px;
}

.pr-120 {
    padding-right: 120px !important;
}

.pr-60 {
    padding-right: 60px;
}

.pt-30 {
    padding-top: 30px;
}

.pb-30 {
    padding-bottom: 30px;
}

.pm-38 {
    padding-bottom: 38px !important;
}

.fs-14 {
    font-size: 14px !important;
}

.fs-18 {
    font-size: 18px !important;
}

.fs-16 {
    font-size: 16px !important;
}

.fs-48 {
    font-size: 48px !important;
}

.fs-35 {
    font-size: 35px !important;
}

.fw-600 {
    font-weight: 600 !important;
}

.fw-500 {
    font-weight: 500 !important;
}

.fw-400 {
    font-weight: 400 !important;
}

.fw-300 {
    font-weight: 300 !important;
}

.h-fit-content {
    height: fit-content;
}

/* Gap */
.gap-19 {
    gap: 19px;
}

/* Color */
.bg-F8F8F8 {
    background: #F8F8F8 !important;
}

.bg-E5F0E8 {
    background: #E5F0E8 !important;
}

.bg-B8C2CC {
    background: #B8C2CC !important;
}

.bg-E8F4FB {
    background: #E8F4FB !important;
}

.color-B7B7B7 {
    color: #B7B7B7 !important;
}

.color-1A96D4 {
    color: #1A96D4 !important;
}

.color-F9F9F9 {
    color: #F9F9F9 !important;
}

.color-707070 {
    color: #707070 !important;
}

.color-808080 {
    color: #808080 !important;
}

.color-DD0322 {
    color: #DD0322 !important;
}

.color-212621 {
    color: #212621 !important;
}

.color-black {
    color: hsl(0, 0%, 0%) !important;
}

.border-black {
    border-color: #707070 !important;
}

.line-height-normal {
    line-height: normal !important;
}

.twn {
    text-wrap: nowrap !important;
}

.text-align-center {
    text-align: center !important;
}

.br-50 {
    border-radius: 50% !important;
}

/* Button */
.btn-success {
    margin-top: 10px !important;
    border-radius: 30px !important;
    background: linear-gradient(90deg, #86D780 0%, #60A577 100%) !important;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) !important;

    color: #F9F9F9 !important;
    font-size: 16px !important;
}

.btn-edit {
    margin-top: 10px !important;
    border-radius: 30px !important;
    background: linear-gradient(90deg, #FFC701 0%, #FF6B01 100%) !important;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) !important;

    color: #F9F9F9 !important;
    font-size: 16px !important;
}

.btn-danger {
    margin-top: 10px !important;
    border-radius: 30px !important;
    background: linear-gradient(90deg, #E60023 0%, #930B0B 100%) !important;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) !important;

    color: #F9F9F9 !important;
    font-size: 16px !important;
}

/* ******************************** */
/* End Talad */
/* ******************************** */

.color-link {
    color: #4EACDF;
}

.color-E60023 {
    color: #E60023;
}

.border-table-all table tr td {
    border: 1px #dde1e8 solid;
}

.border-table-all table thead tr td {
    font-weight: 600;
    font-size: 14px !important;
}

.app-content {
    padding: 0;
    position: relative;
    transition: 300ms ease all;
    backface-visibility: hidden;
    margin-left: 256px;
}


.content.app-content .content-wrapper {
    margin-top: 0;

}

.content .content-wrapper {
    padding: calc(2.2rem - 0.4rem) 2.2rem 0;
    margin-top: 6rem;
}

.navbar-hidden .app-content .content-wrapper {
    padding: 2.2rem;
    margin-top: 0;
}

.loading_all_page {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    z-index: 100;
    background: rgba(0, 0, 0, 0.8);
    color: #FFF;
}

.title_page {
    display: flex;
    align-items: center;
}

.title_page .breadcrumb_title_page {
    font-size: 14px;
    font-weight: 600;
    border-right: 2px #d6dce1 solid;
    padding-right: 24px;
}

.title_page h4.breadcrumb_title_page {
    font-size: 24px !important;
    font-weight: 500;
}

/* .v-breadcrumbs__item {
    color: #444444 !important;
    font-weight: 500;
    font-size: 14px;
} */

.alert_all_page {
    margin: 0;
    position: fixed !important;
    z-index: 9999;
    top: 15px;
    right: 5px;
}

.card-border-top {
    border-top: 5px #dde1e8 solid !important;
}

.card_heading_data {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.2) 100%), #4EACDF;
    border: 1px solid #4EACDF;
    border-radius: 10px;
    padding: 10px 15px;
    position: relative;
    z-index: 1;
}

.card_heading_page_detail_data {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.2) 100%), #4EACDF;
    border: 1px solid #4EACDF;
    border-radius: 10px;
    padding: 20px 15px;
    position: relative;
    z-index: 1;
}

.card_text_heading_data {
    color: #FFFFFF;
    font-style: normal;
    font-weight: 600;
    font-size: 20px;
    line-height: 26px;
}

.card_search_heading_data {
    width: 30%;
}

.card_search_filter_heading_data {
    width: 50%;
}

.card_search_filter_heading_data>div:first-child {
    width: 40%;
    margin-right: 10px;
}

.card_search_filter_heading_data>div:last-child {
    width: 60%;
}

.input_select {
    border-radius: 10px !important;
}

.input_search {
    border-radius: 10px !important;
}

.card_data_list {
    background: #FCFCFC;
    border: 1px solid #F0F0F0;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 0 0 10px 10px;
    position: relative;
    top: -15px;
    padding: 40px 30px 30px;
}

.card_data_list>.theme--light.v-data-table {
    background: #FCFCFC;
}

.v-input--switch__thumb {
    color: #FFFFFF !important;
    caret-color: #FFFFFF !important;
}

.v-input--switch--inset .v-input--switch__track {
    opacity: 1 !important;
}

.title_table_data_list {
    font-style: normal;
    font-weight: 600;
    font-size: 16px !important;
    line-height: 21px;
    color: #585B6B !important;
}

.detail_table_data_list {
    font-style: normal;
    font-weight: 400;
    font-size: 16px !important;
    line-height: 21px;
    color: #414141 !important;
}

.button_tool_data_list {
    color: #FFFFFF !important;
    font-style: normal !important;
    font-weight: 400 !important;
    font-size: 16px !important;
    line-height: 21px;
    border-radius: 10px !important;
}

.page_confirm_delete_all {
    padding-bottom: 15px;
    border-radius: 10px !important;
}

.image_confirm_delete {
    width: 30%;
    margin: auto;
}

.image_confirm_delete>img {
    max-width: 100%;
}

.text_confirm_delete {
    font-style: normal;
    font-weight: 500;
    font-size: 24px;
    line-height: 31px;
    color: #414141;
    text-align: center;
}

.layout_button_text_confirm_delete {
    justify-content: space-evenly;
}

.button_text_confirm_delete {
    font-style: normal;
    font-weight: 500 !important;
    font-size: 16px !important;
    line-height: 21px !important;
    color: #FFFFFF !important;
}

.pagination_data_list>ul>li>.v-pagination__item,
.pagination_data_list>ul>li>.v-pagination__navigation {
    box-shadow: unset !important;
    border-radius: 7px;
}

.page_confirm_success_all {
    padding-bottom: 15px;
    border-radius: 10px !important;
}

.image_confirm_success {
    width: 30%;
    margin: auto;
}

.image_confirm_success>img {
    max-width: 100%;
}

.text_confirm_success {
    font-style: normal;
    font-weight: 500;
    font-size: 24px;
    line-height: 31px;
    color: #414141;
    text-align: center;
}

.layout_button_text_confirm_success {
    justify-content: space-evenly;
}

.button_text_confirm_success {
    font-style: normal;
    font-weight: 500 !important;
    font-size: 20px !important;
    line-height: 21px !important;
    color: #FFFFFF !important;
}

.mtb-10 {
    margin-top: 10px;
    margin-bottom: 10px;
}

@media only screen and (max-width: 800px) {
    .card_search_heading_data {
        width: 50%;
    }

    .card_search_filter_heading_data {
        flex-direction: column;
    }

    .card_search_filter_heading_data>div:first-child {
        width: 100%;
        margin-bottom: 10px;
    }

    .card_search_filter_heading_data>div:last-child {
        width: 100%;
    }
}

/* Line OA */
.input_line_oa {
    border-radius: 10px !important;
}

.input_search_line_oa {
    border-radius: 10px !important;
}

.card_line_oa {
    background: #FCFCFC;
    border: 1px solid #F0F0F0;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px !important;
}

.pagination_data_list_line_oa>ul>li>.v-pagination__item,
.pagination_data_list_line_oa>ul>li>.v-pagination__navigation {
    border-radius: 7px;
}

.upload_image {
    position: absolute;
    top: 40px;
    right: 0;
    left: 0;
}
</style>
