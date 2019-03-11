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
    console.log(event.code);
    if (event.code == 'Enter' && !event.shiftKey){

        // Creation de l'objet XMLHttpRequest
        xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function()
        {
           editionMode(document.getElementById('com_'+id));
        }

        let token = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.open("POST",post_name+'/update/'+id, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
        xhr.send(
            "_token="+ token +
            "&label="+ label
        );
    }
}
