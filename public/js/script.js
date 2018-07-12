function editEquipo(id){

 $.ajax({
            type: "GET",
            url: '/equipo/' + id,
        });
}