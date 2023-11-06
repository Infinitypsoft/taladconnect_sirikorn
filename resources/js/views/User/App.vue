<template>
    <v-app id="app" dark flat>
        <router-view />
    </v-app>
</template>
<style>
@import url("https://fonts.googleapis.com/css2?family=Kanit&display=swap");

html,
body,
#app {
    font-family: 'Kanit', sans-serif !important;
    font-size: 14px;
    height: 100vh;
}

.bold{
    font-weight:bold ;
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

.alert_all_page {
    margin: 0;
    position: fixed !important;
    z-index: 9999;
    top: 15px;
    right: 5px;
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

.main-bg-dark {
    background: #151521 0% 0% no-repeat padding-box !important;
}

.font-18 {
    font-size: 18px !important;
}

.font-16 {
    font-size: 16px !important;
}

.radius-10 {
    border-radius: 10px !important;
}

.backdrop-top-page {
    background-color: #000000;
    opacity: 0.6;
}

.ml-20{
    margin-left: 10rem;
}

.text-red{
    color:#F44336 !important
}

.text-green{
    color: #3BB143 !important;
}

.border-gold{
    border-bottom: 1px #DFA50E solid !important;
}

@media (min-width: 1904px) {
    .container {
        max-width: 1645px !important;
    }
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

.title-title-page {
    font-size: 42px;
    font-weight: 600 !important;
}
</style>
