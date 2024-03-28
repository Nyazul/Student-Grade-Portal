function alertInfo() {
    const urlParams = new URLSearchParams(window.location.search);
    const noticesubmitted = urlParams.get('NoticeSubmitted');

    if (noticesubmitted) {
        alert("Notice Added Successfully");
    }
    
    return true;
}