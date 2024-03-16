function alertInfo(){
    const urlParams = new URLSearchParams(window.location.search);
    const infochanged = urlParams.get('InfoChanged');
    const feedbacksubmitted = urlParams.get('FeedbackSubmitted');

    if (infochanged) {
        alert("Personal Information Changed Successfully");
    } else if (feedbacksubmitted) {
        alert("Feedback has been submitted");
    }
    
    return true;
}