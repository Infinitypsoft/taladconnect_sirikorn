<template>
    <v-app>
        <VerticalMenu />
        <router-view />
        <FooterPage />
    </v-app>
</template>
<script>
import VerticalMenu from '../User/VerticalMenu.vue'
import FooterPage from './FooterPage.vue'
export default {
    name: 'pageAll',
    components: {
        VerticalMenu,
        FooterPage,
    }
}
</script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap");

html,
body,
#app {
    font-family: 'Kanit', sans-serif !important;
    font-size: 14px !important;
    height: 100vh;
    background-color: #f8f8f8;
}

.font-bold {
    font-weight: 600 !important;
}

.font-14 {
    font-size: 14px !important;
}

.font-16 {
    font-size: 16px !important;
}

.font-18 {
    font-size: 18px !important;
}

.font-20 {
    font-size: 20px !important;
}

.font-40 {
    font-size: 40px !important;
}

.icon-5x {
    font-size: 5em !important;
}

.mb-19 {
    margin-bottom: 19px !important;
}

.mb-8 {
    margin-bottom: 8px !important;
}

.color-link {
    color: #4EACDF;
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

.v-breadcrumbs__item {
    color: #444444 !important;
    font-weight: 500;
    font-size: 14px;
}

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
</style>
