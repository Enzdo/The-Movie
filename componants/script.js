
const API_KEY ='api_key=3ac88b718782fe9690b488b567f61cb5';
const BASE_URL = 'https://api.themoviedb.org/3/';
var PARAM_URL = "popularity";
var SORTS_URL = ".desc";
var API_URL =  BASE_URL + '/discover/movie?sort_by='+PARAM_URL+SORTS_URL+'&'+API_KEY;
const IMG_URL = 'https://image.tmdb.org/t/p/w500/';
const searchURL = BASE_URL + '/search/movie?' + API_KEY;


const genres = [
	{
		"id": 28,
		"name": "Action"
	},
	{
		"id": 12,
		"name": "Adventure"
	},
	{
		"id": 16,
		"name": "Animation"
	},
	{
		"id": 35,
		"name": "Comedy"
	},
	{
		"id": 80,
		"name": "Crime"
	},
	{
		"id": 99,
		"name": "Documentary"
	},
	{
		"id": 18,
		"name": "Drama"
	},
	{
		"id": 10751,
		"name": "Family"
	},
	{
		"id": 14,
		"name": "Fantasy"
	},
	{
		"id": 36,
		"name": "History"
	},
	{
		"id": 27,
		"name": "Horror"
	},
	{
		"id": 10402,
		"name": "Music"
	},
	{
		"id": 9648,
		"name": "Mystery"
	},
	{
		"id": 10749,
		"name": "Romance"
	},
	{
		"id": 878,
		"name": "Science Fiction"
	},
	{
		"id": 10770,
		"name": "TV Movie"
	},
	{
		"id": 53,
		"name": "Thriller"
	},
	{
		"id": 10752,
		"name": "War"
	},
	{
		"id": 37,
		"name": "Western"
	}
]

	const main = document.getElementById('allfilm');
	const tagsEl = document.getElementById('tags')

var selectGenre = []

setGenre();
function setGenre(){
	tagsEl.innerHTML='';
	genres.forEach(genre => {
		const t = document.createElement('div');
		t.classList.add('tag');
		t.id=genre.id;
		t.innerText = genre.name;
		t.addEventListener('click', ()=>{
			if(selectGenre.length ==0){
				selectGenre.push(genre.id )
			}else{
				if(selectGenre.includes(genre.id)){
					selectGenre.forEach((id, idx) => {
						if(id == genre.id){
							selectGenre.splice(idx, 1);
						}
					})
				}else{
					selectGenre.push(genre.id);
				}
			}
			console.log(selectGenre)
			getMovies(API_URL + '&with_genres='+encodeURI(selectGenre.join(',')))
			higlighSelection()
		})
		tagsEl.append(t);
	})
}

function higlighSelection(){
	const tags = document.querySelectorAll('.tag');
	tags.forEach(tag=>{
		tag.classList.remove('highlight')
	})
	clearBtn()
	if(selectGenre.length !=0){
		selectGenre.forEach(id =>{
			const higlightedTag = document.getElementById(id);
			higlightedTag.classList.add('highlight');
		})
	}
}

function clearBtn(){
	let clearBtn = document.getElementById('clear');
	if(clearBtn){
		clearBtn.classList.add('highlight')
	}else{					
		let clear = document.createElement('div');
		clear.classList.add('tag','highlight');
		clear.id = 'clear';
		clear.innerText = 'Clear x';
		clear.addEventListener('click', () => {
			selectGenre = [];
			setGenre();            
			getMovies(API_URL);
		})
		tagsEl.append(clear);
	}	
}
getMovies(API_URL)
function getMovies(url){
	fetch(url).then(res=>res.json()).then(data=>{
		console.log(data)
		if(data.results.length !== 0){
			showMovies(data.results);
		}else{
			main.innerHTML= `<h1 class="no-results">No Results Found</h1>`
		}
	})
}
function showMovies(data){
	main.innerHTML='';
	
	data.forEach(movie => {
		const {original_title, poster_path, vote_average, release_date, id} = movie
		const movieEl = document.createElement('div');
		movieEl.classList.add('movie');
		movieEl.innerHTML = `
		<img src="${poster_path? IMG_URL+poster_path: "http://via.placeholder.com/1080x1580"}" alt='${original_title}'>


		<div class="p-10" >
				<h3 class="text-3xl">${original_title}</h3>
				<div class="pt-10 w-full flex justify-between">
					<span class="${getColor(vote_average)}">Note : ${vote_average} </span>
					<span class="" >${release_date}</span>
					<a href="single_movie.php?id=${id}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Voir plus !</a>
				</div>
		</div>

		`


		main.appendChild(movieEl)
	});
}


function getColor(vote){
	if(vote>= 6 ){
		return'green'
	}else if(vote >= 5){
		return 'orange'
	}else{
		return'red'
	}
}

$(".sort_icon").click(function() {
	if (SORTS_URL == ".desc") {
		SORTS_URL = ".asc";
		$(this).addClass("rotate");
	}
	else {
		$(this).removeClass("rotate");
		SORTS_URL= ".desc";
	}
	API_URL =  BASE_URL + '/discover/movie?sort_by='+PARAM_URL+SORTS_URL+'&'+API_KEY;
	getMovies(API_URL);
});

$(".vote").click(function() {
	PARAM_URL = 'vote_average';
	$(".sort").removeClass("active");
	$(this).addClass("active");
	API_URL =  BASE_URL + '/discover/movie?sort_by='+PARAM_URL+SORTS_URL+'&'+API_KEY;
	getMovies(API_URL);
});

$(".alpha").click(function() {
	PARAM_URL = 'original_title';
	$(".sort").removeClass("active");
	$(this).addClass("active");
	API_URL =  BASE_URL + '/discover/movie?sort_by='+PARAM_URL+SORTS_URL+'&'+API_KEY;
	getMovies(API_URL);
});

$(".pop").click(function() {
	PARAM_URL = 'popularity';
	$(".sort").removeClass("active");
	$(this).addClass("active");
	API_URL =  BASE_URL + '/discover/movie?sort_by='+PARAM_URL+SORTS_URL+'&'+API_KEY;
	getMovies(API_URL);
});