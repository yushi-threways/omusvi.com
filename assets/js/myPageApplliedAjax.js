$('.js-application-applied').submit(function(event) {
    let url = Routing.generate('mypage_event_application_applied', { id: appliedEvent });
    let posts = null;
    $.ajax({
        method: 'post',
        url: url
    }).then(function(res){
        
       console.log(res);
    });
});