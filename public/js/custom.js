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
            console.log(obj[0].post_type);

            for (var key in obj[0]) {
                if (key != 'post_date' && key != 'created_at' && key != 'updated_at' && key != 'post_author'){
                    document.getElementById(key).value = obj[0][key];
                }
            }

        }
    }

    xhr.open("GET",'/admin/'+type+'/grab/'+id, true);
    xhr.send();
}
