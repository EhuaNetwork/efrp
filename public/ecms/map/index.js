window.addEventListener('load', function () {

    window.addEventListener('resize', function () {
        wid = window.innerWidth
        if (wid > 0 && wid <= 750) {
            android(wid)
        } else if (wid > 750 && wid <= 1366) {

            book(wid)
        } else if (wid > 1366 && wid <= 1920) {
            pc(wid)
        } else {
            pc(wid)
        }

    })

})

$(function () {

    wid = window.innerWidth
    if (wid > 0 && wid <= 750) {
        android(wid)
    } else if (wid > 750 && wid <= 1366) {

        book(wid)
    } else if (wid > 1366 && wid <= 1920) {
        pc(wid)
    } else {
        pc(wid)
    }


})


function android(wid) {
    // console.log('android:' + wid)
}

function book(wid) {

}

function pc(wid) {


}
