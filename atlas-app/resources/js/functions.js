$(document).ready(function() {

    //Add Comment Section
    $("#add-comment").on("submit", function(e){
        let formData = $("#add-comment").serializeArray();
        let username = formData[0]['value'];
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/comment/add",
            data: $("#add-comment").serialize(),
            type : 'POST',
            dataType : 'json',
            success : function(result){
                showComments(result.post, username);
            }
        });
        $("#comment-input").val("");
        e.preventDefault();
    });

    function showComments(post, username){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/comment/show/" + post,
            type : 'POST',
            dataType : 'json',
            success : function(result){
                let newResult = JSON.stringify(result);
                let data = JSON.parse(newResult);
                $("#show-comments").empty();
                if(data.length > 0){
                    data.forEach(result =>{
                        if(result.userUsername == username){
                            $("#show-comments").append('<div class="card"><div class="dropdown"><button class="report-btn" role="button" data-toggle="dropdown" aria-expanded="false">...</button><ul class="dropdown-menu atlas-menu-container"><li><form action="/comment/delete/'+ result.id +'" method="POST"><input type="hidden" name="_token" value="'+ $('meta[name="csrf-token"]').attr('content') +'"/><a href="javascript:;" class="dropdown-item atlas-menu-item m-0" onclick="parentNode.submit()">Delete</a></form></li></ul></div><div class="card-body"><p><strong>'+ result.userUsername +'</strong></p><p>'+ result.comment +'</p></div></div>');
                        } else{
                            $("#show-comments").append('<div class="card"><div class="dropdown"><button class="report-btn" role="button" data-toggle="dropdown" aria-expanded="false">...</button><ul class="dropdown-menu atlas-menu-container"><li><a href="/report/'+ result.userUsername +'" class="dropdown-item atlas-menu-item m-0">Report</a></li></ul></div><div class="card-body"><p><strong>'+ result.userUsername +'</strong></p><p>'+ result.comment +'</p></div></div>');
                        }
                    });
                }
            }
        });
    }

    //Admin Section
    $("#report-btn").click(function(){
        $("#report-list").toggleClass('d-none').toggleClass('d-flex');
        $("#put-header").empty();
        $("#add-buttons").empty();
        $("#put-header").append('<h5>Reported Users</h5>');
        $("#show-reported").empty();
        getListOfReportedUsers();
    });

    $("#ban-btn").click(function(){
        $("#report-list").toggleClass('d-none').toggleClass('d-flex');
        $("#put-header").empty();
        $("#add-buttons").empty();
        $("#put-header").append('<h5>Banned Users</h5>');
        $("#show-reported").empty();
        getListOfBannedUsers();
    });

    function getABannedUser(bannedUser){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/reported/"+bannedUser,
            type : 'POST',
            dataType : 'json',
            success : function(result){
                let newResult = JSON.stringify(result);
                let data = JSON.parse(newResult);
                $("#show-reported").empty();
                $("#add-buttons").empty();
                if(data.length > 0){
                    data.forEach(result =>{
                        $("#show-reported").append('<p><strong>'+result.reportedUser+'</strong> reported by: <strong>'+ result.username +'</strong> For: <strong>'+result.reason+'</strong> on: <strong>'+ result.dateCreated +'</strong></p>');
                        $("#show-reported").append('<p><strong>Description: </strong>'+ result.description +'</p>');
                    });

                    let unsuspendBtn = document.createElement("button");
                    unsuspendBtn.innerHTML = "UNSUSPEND";
                    unsuspendBtn.onclick = function(){
                        unsuspendUser(data[0].reportedUser);
                    };
                    unsuspendBtn.className = 'btn btn-primary';
                    $("#add-buttons").append(unsuspendBtn);
                }
            }
        });
    }

    function getAReportedUser(reportedName){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/reported/"+reportedName,
            type : 'POST',
            dataType : 'json',
            success : function(result){
                let newResult = JSON.stringify(result);
                let data = JSON.parse(newResult);
                $("#show-reported").empty();
                $("#add-buttons").empty();
                if(data.length > 0){
                    console.log(data[0].reportedUser);
                    data.forEach(result =>{
                        $("#show-reported").append('<p><strong>'+result.reportedUser+'</strong> reported by: <strong>'+ result.username +'</strong> For: <strong>'+result.reason+'</strong> on: <strong>'+ result.dateCreated +'</strong></p>');
                        $("#show-reported").append('<p><strong>Description: </strong>'+ result.description +'</p>');
                    });

                    let suspendBtn = document.createElement("button");
                    suspendBtn.innerHTML = "SUSPEND";
                    suspendBtn.onclick = function(){
                        suspendUser(data[0].reportedUser);
                    };
                    suspendBtn.className = 'btn btn-danger';

                    let dismissBtn = document.createElement("button");
                    dismissBtn.innerHTML = "DISMISS";
                    dismissBtn.onclick = function(){
                        dismissUser(data[0].reportedUser);
                    };
                    dismissBtn.className = 'btn btn-success';
                    $("#add-buttons").append(dismissBtn, suspendBtn);
                }
            }
        });
    }

    function dismissUser(name){
        $("#put-header2").empty();
        $("#show-reported").empty();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/admin/dismiss/" + name,
            type : 'POST',
            dataType : 'json',
            success : function(result){
                console.log(result);
            }
        });
    }

    function suspendUser(name){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/admin/suspend/" + name,
            type : 'POST',
            dataType : 'json',
            success : function(result){
                console.log(result);
            }
        });
    }

    function unsuspendUser(name){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/admin/unsuspend/" + name,
            type : 'POST',
            dataType : 'json',
            success : function(result){
                console.log(result);
            }
        });
    }

    function getListOfBannedUsers(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/admin/getBanned",
            type : 'GET',
            dataType : 'json',
            success : function(result){
                let newResult = JSON.stringify(result);
                let data = JSON.parse(newResult);

                $("#put-btns").empty();
                data.forEach(result => {
                    let button = document.createElement("button");
                    button.innerHTML = result.username;
                    button.onclick = function(){getABannedUser(result.username);};
                    button.className = 'btn btn-dark';

                    $("#put-btns").append(button);
                });
            }
        });
    }

    function getListOfReportedUsers(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "/admin/getReports",
            type : 'GET',
            dataType : 'json',
            success : function(result){
                let newResult = [];
                newResult = eval(JSON.stringify(result));

                $("#put-btns").empty();
                newResult.forEach(result => {
                    let button = document.createElement("button");
                    button.innerHTML = result.reportedUser;
                    button.onclick = function(){getAReportedUser(result.reportedUser);};
                    button.className = 'btn btn-secondary';

                    $("#put-btns").append(button);
                });
            }
        });
    }
});