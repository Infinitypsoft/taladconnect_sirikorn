
function monthList() {
    return [
        {
            id:1,
            name:'มกราคม',
            name_short:'ม.ค.',
            name_en:'January',
            name_en_short:'Jan',
        },
        {
            id:2,
            name:'กุมภาพันธ์',
            name_short:'ก.พ.',
            name_en:'February',
            name_en_short:'Feb',
        },
        {
            id:3,
            name:'มีนาคม',
            name_short:'มี.ค.',
            name_en:'March',
            name_en_short:'Mar',
        },
        {
            id:4,
            name:'เมษายน',
            name_short:'เม.ย.',
            name_en:'April',
            name_en_short:'Apr',
        },
        {
            id:5,
            name:'พฤษภาคม',
            name_short:'พ.ค.',
            name_en:'May',
            name_en_short:'May',
        },
        {
            id:6,
            name:'มิถุนายน',
            name_short:'มิ.ย.',
            name_en:'June',
            name_en_short:'Jun',
        },
        {
            id:7,
            name:'กรกฎาคม',
            name_short:'ก.ค.',
            name_en:'July',
            name_en_short:'Jul',
        },
        {
            id:8,
            name:'สิงหาคม',
            name_short:'ส.ค.',
            name_en:'August',
            name_en_short:'Aug',
        },
        {
            id:9,
            name:'กันยายน',
            name_short:'ก.ย.',
            name_en:'September',
            name_en_short:'Sep',
        },
        {
            id:10,
            name:'ตุลาคม',
            name_short:'ต.ค.',
            name_en:'October',
            name_en_short:'Oct',
        },
        {
            id:11,
            name:'พฤศจิกายน',
            name_short:'พ.ย.',
            name_en:'November',
            name_en_short:'Nov',
        },
        {
            id:12,
            name:'ธันวาคม',
            name_short:'ธ.ค.',
            name_en:'December',
            name_en_short:'Dec',
        },
    ]

}

function thaiDateShortMonth(date){
    const date_time = date.split(" ")
    const result_date = date_time[0].split("-")
    const month = parseInt(result_date[1])
    const result_month = monthList().find((detail) => { return detail.id == month })
    const result_year = parseInt(result_date[0]) + 543
    return `${result_date[2]} ${result_month.name_short} ${result_year}`
}

function thaiDateFullMonth(date){
    const date_time = date.split(" ")
    const result_date = date_time[0].split("-")
    const month = parseInt(result_date[1])
    const result_month = monthList().find((detail) => { return detail.id == month })
    const result_year = parseInt(result_date[0]) + 543
    return `${result_date[2]} ${result_month.name} ${result_year}`
}

// 2023-10-01 to 01/10/2566
function dateFormat1(date){
    return date.replace(/-/g, '').replace(/(\d{4})(\d{2})(\d{2})/, (_, y, m, d)=>`${d}/${m}/${parseInt(y) + 543}`)
}

export {
    monthList,
    thaiDateShortMonth,
    thaiDateFullMonth,
    dateFormat1,
}