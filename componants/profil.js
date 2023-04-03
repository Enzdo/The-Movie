const ouvrirAlbum = document.getElementById('ouvrirAlbum')
const Album = document.getElementById('Album')
const closeAlbum = document.getElementById('closeAlbum')

$("#AjoutAlbum").click(function() {
	$("#popUpAlbum").removeClass("hidden");
    $("#popUpAlbum").addClass("flex");
});

$("#fermerAlbum").click(function() {
	$("#popUpAlbum").removeClass("flex");
    $("#popUpAlbum").addClass("hidden");
});

ouvrirAlbum.addEventListener("click", function(){
    Album.classList.add('flex')
    Album.classList.remove('hidden')
})
closeAlbum.addEventListener("click", function(){
    Album.classList.add('hidden')
    Album.classList.remove('flex')
})