function alertInfo() {
    const urlParams = new URLSearchParams(window.location.search);
    const noticesubmitted = urlParams.get('NoticeSubmitted');
    const infochanged = urlParams.get('InfoChanged');

    if (noticesubmitted) {
        alert("Notice Added Successfully");
    } else if (infochanged) {
        alert("Personal Information Changed Successfully");
    }
    
    return true;
}