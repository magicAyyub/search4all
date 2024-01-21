document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.querySelector('#search-form');
    const searchInput = document.querySelector('#search');

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const query = searchInput.value;

        Swal.fire({
            text: 'Recherche en cours...(Veuillez patienter nous fouillons tous les repertoires)',
            allowOutsideClick: false,
        });

        fetch('search.php?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                console.log(data);
                Swal.close();
                    let isResult = data[0].toLowerCase().includes("aucun résultat trouvé") ? false : true;
                    let result = '';
                    if (isResult){
                    data.forEach(item => {    
                        let file_name = nameFromPath(item);
                        let path = formatPath(item);
                        formatPath(item);
                        result += `<div class="doc_container">                               
                                        <div class="file_name">
                                            <span>${file_name}</span>
                                        </div>
                                        <button type="button" data-filename="${file_name}" data-path="${path}" data-realpath="${item}">
                                            <ion-icon name="document-outline"></ion-icon>
                                        </button>
                                    </div>
                                    `;

                    });
                } else {
                    result += `<div class="doc_container">                               
                                        <div class="file_name">
                                            <span>${data[0]}</span>
                                        </div>
                                    </div>
                                    `;
                }
                
                document.querySelector("#results-container .files").innerHTML = result;
                document.querySelector("#results-container").classList.add("show");

                let doc_button = document.querySelectorAll('.doc_container button');
                doc_button.forEach(button => {
                    button.addEventListener("click", () => {
                        showDocDialog(button.getAttribute("data-path"), button.getAttribute("data-realpath"), button.getAttribute("data-filename"));
                    });
                });
            })
            .catch(error => {
                // fermer la popup
                Swal.close();
                console.error('Erreur lors de la recherche:', error);
            });
    });

});

function nameFromPath(path) {
    let path_parts = path.split("\\");
    let file_parts = path_parts[path_parts.length-1].split("/");
    return file_parts[file_parts.length-1];
}

function formatPath(path) {
    let path_parts = path.split("\\");
    path_parts.splice(0,2);
    let new_path = path_parts.join("/");
    return `../${new_path}`;
}

function showDocDialog(path, realpath, file_name){
    Swal.fire({
        icon: "info",
        html: `Le document se trouve à l'adresse : <strong>${realpath}</strong> <br>Voulez-vous le télécharger ?`,
        showDenyButton: true,
        confirmButtonText: 'Oui',
        denyButtonText: 'Non',
      }).then((result) => {
        if (result.isConfirmed) {
         let downloadLink = document.createElement('a');
         downloadLink.href = path;
         downloadLink.download = file_name;
         document.body.appendChild(downloadLink);
         downloadLink.click();
         document.body.removeChild(downloadLink);
          Swal.fire('Voilà volà!', '', 'success');
        } 
      });
}

