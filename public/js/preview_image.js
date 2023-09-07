var loadFile = function(event){
    var output = document.getElementById('output');
    output.src = '';
    output.style.display = 'none';

    output.src = URL.createObjectURL(event.target.files[0]);
    output.style.display = 'block';

}
