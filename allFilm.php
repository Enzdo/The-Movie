<section class="flex justify-center w-full">
    <div id="search-results" class=" film w-10/12 h-full grid grid-cols-4 itemsgrid-rows-5 col-span-6 gap-8">

    </div>
</section>
<div class=" flex flex-col items-center justify-evenly pt-24">
    <h1 class="text-6xl text-white ">Populaires :</h1>
    <?php 
        require 'componants/filter.php';
    ?>
</div>
<section class="flex justify-center w-full py-24">
    <main id="allfilm" class="film w-10/12 h-full grid grid-cols-4 itemsgrid-rows-5 col-span-6 gap-8">
        
    </main>
</section>