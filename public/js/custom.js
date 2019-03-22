function editionMode(e){
    e.disabled = !e.disabled;

    if (e.disabled === true){
        e.classList.add('bg-transparent');
        e.classList.add('border-0');
    } else {
        e.classList.remove('bg-transparent');
        e.classList.remove('border-0');
    }
}

function writting(id, post_name, event, label){

    if (event.code == 'Enter' && !event.shiftKey){

        // Creation de l'objet XMLHttpRequest
        xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                editionMode(document.getElementById('com_'+id));
            }
        }

        let token = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.open("POST",'/articles/'+post_name+'/update/'+id, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
        xhr.send(
            "_token="+ token +
            "&label="+ label
        );
    }
}

function modal(type, id = 0){
    let modal = document.getElementById('bgmodal');

    if (type == "post"){
        modal.style.top = 0;
        loadContent(type, id);
    }

    if (type == "remove"){
        modal.style.top = "-100%";
    }
}

function loadContent(type, id){
    xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            obj = JSON.parse(xhr.response);

            for (var key in obj[0]) {
                if (key != 'post_date' && key != 'created_at' && key != 'updated_at' && key != 'post_author'){
                    document.getElementById(key).value = obj[0][key];
                }
            }
            document.getElementById('contentUpdater').action = '/admin/articles';

        }
    }

    xhr.open("GET",'/admin/'+type+'/grab/'+id, true);
    xhr.send();
}

function remove(element, type){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover your "+type+".",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function()
            {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    modal('remove');
                    window.location.reload(false);
                }
            }

            let token = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (type == 'media'){
                document.getElementById(element).style.transition= "all 0.5s ease-in-out";
                document.getElementById(element).style.transform= "translate(200%, 2px)";
                xhr.open("POST",'/admin/'+type+'/delete/'+element, true);
            } else {
                xhr.open("POST",'/admin/'+type+'/delete/'+element.value, true);
            }
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
            xhr.send();



        } else {
            return false;
        }
      });
}

function joke(element) {
    var audio = document.getElementsByTagName("audio")[0];
    audio.play();

    var this_offset = $(element).offset();
    var that_id     = $(element).attr("href");
    var that_offset = $(that_id).offset();
    var offset_diff = Math.abs(that_offset.top - this_offset.top);

    var base_speed  = 5000; // Time in ms per 1,000 pixels
    var speed       = (offset_diff * base_speed) / 1000;

    $("html,body").animate({
        scrollTop: that_offset.top
    }, speed);

    return audio.pause();
}

function mediaUpdate(element){
    var n = element.value.lastIndexOf('\\');
    var result = element.value.substring(n + 1);
    document.getElementById('displayer').textContent = result;
}
