const KEY ='api_key=3ac88b718782fe9690b488b567f61cb5';
const tdmb_URL = 'https://api.themoviedb.org/3/';

const IMAGE_URL = 'https://image.tmdb.org/t/p/w500/';


(async function(){
    const pageId = getPageId();
    console.log(pageId)
    getPage(pageId)
})()

function getPageId(){
    return new URL(location.href).searchParams.get('id')
}


function getPage(pageId){
    const API_URL =  tdmb_URL + '/movie/' + pageId + '?' + KEY;
    console.log(API_URL)
    getMovies(API_URL)

    const main = document.getElementById('single_film');

    function getMovies(url){
        fetch(url).then(res=>res.json()).then(data=>{
            console.log(data)
            singleMovie(data);
            function singleMovie(data){
                main.innerHTML='';
                    console.log(data)
                        const {title, poster_path, vote_average, release_date,id, overview} = data
                        const movieEl = document.createElement('div');
                        movieEl.classList.add('move');
                        movieEl.innerHTML = `
                        <div class="flex pt-10 justify-around w-full h-min	">
                            <img class=" h-5/6 w-96 " src="${IMAGE_URL+poster_path}" alt='${title}'>
                    
                    
                            <div class="pl-10 pt-8 w-2/4" >
                                <h3 class="text-white font-semibold text-8xl">${title} </h3>
                                <p class=" pt-10 text-white text-2xl">${overview} </p> 
                                <div class="pt-10 flex justify-between">
                                    <p class="text-2xl text-white" >${vote_average} </p>
                                    <p class="text-2xl text-white" > Date de sorti : ${release_date} </p>
                                </div>
                            </div>
                        </div>    `
                        


                        main.appendChild(movieEl)
                    }
                })


                function getColor(vote_average){
                    if(vote_average>= 6 ){
                        return'green'
                    }else if(vote_average >= 5){
                        return 'orange'
                    }else{
                        return'red'
                    }
                }


    }
}


const likeOpen = document.getElementById('likeOpen');
const LikeAlbum = document.getElementById('LikeAlbum');
const LikeClose = document.getElementById('LikeClose');

likeOpen.addEventListener("click", function() {
    LikeAlbum.classList.add("block");
    LikeAlbum.classList.remove("hidden");
});
LikeClose.addEventListener("click", function() {
    LikeAlbum.classList.add("hidden");
    LikeAlbum.classList.remove("block");
}); 