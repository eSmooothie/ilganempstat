<div class="p-5">
    <!-- SOME INFO -->
    <section class="md:flex justify-center gap-x-10 mb-6">
        <article class=" lg:w-1/3 md:w-1/2 p-5 rounded-lg bg-gray-300">
            <!-- TODO: CHANGE IMAGE -->
            <div class="flex justify-center mb-5">
                <img src="https://via.placeholder.com/300" class="rounded-lg bg-gray-600 p-1 w-64" alt="">
            </div>
            <p class="text-xs text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Phasellus sollicitudin lectus vel ornare tristique. Nullam a 
                nulla arcu. Mauris tincidunt quam nec lacus tristique, 
                ut luctus neque laoreet. Cras vitae ex a nisi dictum maximus. 
                Ut tincidunt, eros posuere imperdiet pretium, mauris lectus elementum ipsum, 
                in rutrum metus ligula non leo. Phasellus non ultricies metus, quis tristique 
                eros. Aliquam sit amet nisl at tortor vestibulum mattis in non 
                lacus. Donec pretium velit vitae nisi consectetur pharetra. 
                Vestibulum pharetra mollis vehicula. Nam vel eros arcu. Aliquam erat volutpat.
            </p>
        </article>
        <article class="bg-gray-300 lg:w-1/3 md:w-1/2 p-5 rounded-lg">
            <!-- TODO: CHANGE IMAGE -->
            <div class="flex justify-center mb-5">
                <img src="https://via.placeholder.com/300" class="rounded-lg bg-gray-600 p-1 w-64" alt="">
            </div>
            <p class="text-xs text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Phasellus sollicitudin lectus vel ornare tristique. Nullam a 
                nulla arcu. Mauris tincidunt quam nec lacus tristique, 
                ut luctus neque laoreet. Cras vitae ex a nisi dictum maximus. 
                Ut tincidunt, eros posuere imperdiet pretium, mauris lectus elementum ipsum, 
                in rutrum metus ligula non leo. Phasellus non ultricies metus, quis tristique 
                eros. Aliquam sit amet nisl at tortor vestibulum mattis in non 
                lacus. Donec pretium velit vitae nisi consectetur pharetra. 
                Vestibulum pharetra mollis vehicula. Nam vel eros arcu. Aliquam erat volutpat.
            </p>
        </article>
    </section>

    <div class="w-full border border-gray-800 rounded-full h-2 bg-gray-800"></div>
    <!-- MAP SECTION -->
    <section class="py-10">
        <p class=" uppercase text-sm text-center">Iligan Employement Status</p>
        <p class=" mb-5 text-xxs text-center uppercase">heatmap</p>
         <!-- MAP -->
        <div class=" flex justify-center mb-3">
            <div class=" md:w-9/12 w-full">
                <label for="changeYear" 
                class="block mb-2 text-sm font-medium 
                text-gray-900 dark:text-gray-400">
                    Select Year
                </label>
                <select name="" id="changeYear" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 
                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
            </div>
        </div>

        <div class=" flex justify-center h-full">
            <div id="map" class=" md:w-9/12 w-full h-full rounded-lg"></div>
            <script src="<?php echo $base_url;?>/assets/js/map.js" type="module"></script>
        </div>
    </section>
</div>

