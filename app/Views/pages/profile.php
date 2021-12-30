<div>
    <div class=" flex justify-center p-5">
        <div class="md:w-9/12 w-full">
            <!-- PROFILE -->
            <div class="">
                <div class=" grid grid-cols-3">
                    <div>
                        <img src="https://via.placeholder.com/300" alt="" class=" w-40 rounded-full mx-auto shadow-md">
                    </div>
                    <div class=" col-span-2 flex items-center">
                        <div>
                            <p class=" text-2xl"><?php echo "{$user['FIRSTNAME']} {$user['LASTNAME']}";?></p>
                            <p class=" text-blue-600 text-xxs font-medium"><a href="">Edit Profile</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DOWNLOADS -->
            <div class="p-5">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Reports
                                        </th>
                                        <th scope="col" class="relative py-3 px-6">
                                            <span class="sr-only">Download</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($year as $key => $value){
                                    ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-600">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?php echo $value['year']." data";?>
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="<?php echo $base_url."/downloadReport/".$value['year'];?>" 
                                                target="_blank"
                                                class="text-blue-600 hover:text-blue-900 
                                                dark:text-blue-500 dark:hover:underline">
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                     ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>

</div>