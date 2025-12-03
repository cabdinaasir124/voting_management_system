document.getElementById('importForm').addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);

    fetch('api/voters_import_api.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        let resultDiv = document.getElementById('result');
        if(data.status){
            resultDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
        } else {
            resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(err => console.error(err));
});
