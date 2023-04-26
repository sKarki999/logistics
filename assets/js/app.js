setTimeout(function(){
    document.querySelector('#sessionMessage').remove();
}, 4000);


document.getElementById('addCheckAll').onclick = function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}



