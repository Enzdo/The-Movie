const searchForm = document.getElementById('search-form');
const searchInput = document.getElementById('query');
const searchResults = document.getElementById('search-results');

searchForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const query = searchInput.value;

  axios.get(`https://api.themoviedb.org/3/search/movie?api_key=3ac88b718782fe9690b488b567f61cb5&query=${query}`)
    .then((response) => {
      searchResults.innerHTML = ''; // vide les résultats de la recherche précédente

      // Pour chaque film dans les résultats de la recherche
      response.data.results.forEach((movie) => {
        // Crée une div avec l'image, le titre et la note du film
        const div = document.createElement('div');
        div.classList.add('movie');
        div.innerHTML = `
        <img src="https://image.tmdb.org/t/p/w500/${movie.poster_path}" alt="${movie.title}">
        <div class="bottom-movie">
            <h3>${movie.title}</h3>
            <div class="flex justify-around"
              <p class="${getColor(movie.vote_average)}" >Note : ${movie.vote_average}</p>
              <a href="single_movie.php?id=${movie.id}" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Voir plus !</a>
            </div>
        </div>
        `
        ;
        searchResults.appendChild(div);
      });
    })
    .catch((error) => {
      console.error(error);
    });
});
function getColor(vote){
    if(vote>= 6 ){
        return'green'
    }else if(vote >= 5){
        return 'orange'
    }else{
        return'red'
    }
}