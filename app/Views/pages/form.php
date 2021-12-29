<div>
    <div class="border border-black flex justify-center py-5">
        <form id="addData" class="border border-gray-300 w-1/2 rounded-lg p-5">
            <!-- DATE -->
            <div class="mb-6">
                <label for="date" class="block mb-2 text-sm font-medium 
                text-gray-900 dark:text-gray-400">Date</label>
                <input required type="date" id="base-input" name="date" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 
                dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <!-- BARANGAY -->
            <div class="mb-6">
                <label for="barangay" class="block mb-2 text-sm font-medium 
                text-gray-900 dark:text-gray-400">Barangay</label>
                <select required id="barangay" name="barangay"
                 class="bg-gray-50 border border-gray-300 text-gray-900 
                 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                 <?php 
                        foreach($barangays as $key => $value){
                            $id = $value['ID'];
                            $name = $value['NAME'];
                            ?>
                            <option value="<?php echo $id;?>"><?php echo $name;?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <!-- ESTABLISHMENT -->
            <div class="mb-6">
                <label for="establishment" class="block mb-2 text-sm font-medium 
                text-gray-900 dark:text-gray-400">Establishment</label>
                <select required id="establishment" name="establishment"
                 class="bg-gray-50 border border-gray-300 text-gray-900 
                 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <?php 
                        foreach($establishments as $key => $value){
                            $id = $value['ID'];
                            $name = $value['NAME'];
                            ?>
                            <option value="<?php echo $id;?>"><?php echo $name;?></option>
                            <?php
                        }
                    ?>
                </select>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Can't find the establishment? 
                    <button type="button" 
                    class="font-medium text-blue-600 hover:underline dark:text-blue-500" 
                    data-modal-toggle="add_new_establishment-modal">Add Establishment</button>.
                </p>
            </div>
            <div class="mb-6 text-center text-sm"><p>Employee Information</p></div>
            <!-- FEMALE EMPLOYEE -->
            <div class="mb-6">
                <label for="female_employee" class="block mb-2 text-sm 
                font-medium text-gray-900 dark:text-gray-300">Number of Female Employee</label>
                <input required name="female_employee" type="number" min="0" value="0" id="female_employee" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
                w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <!-- MALE EMPLOYEE -->
            <div class="mb-6">
                <label for="male_employee" class="block mb-2 text-sm 
                font-medium text-gray-900 dark:text-gray-300">Number of Male Employee</label>
                <input required name="male_employee" type="number" min="0" value="0" id="male_employee" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
                w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <!-- RESIDENTIAL EMPLOYEE -->
            <div class="mb-6">
                <label for="residential_employee" class="block mb-2 text-sm 
                font-medium text-gray-900 dark:text-gray-300">Number of Residential Employee</label>
                <input required name="residential_employee" type="number" min="0" value="0" id="residential_employee" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
                w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <!-- BUSINESS CAPITAL -->
            <div class="mb-6">
                <label for="business_capital" class="block mb-2 text-sm 
                font-medium text-gray-900 dark:text-gray-300">Business Capital</label>
                <input required name="business_capital" type="number" value="0" id="business_capital" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
                w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <!-- BUSINESS GROSS -->
            <div class="mb-6">
                <label for="business_gross" class="block mb-2 text-sm 
                font-medium text-gray-900 dark:text-gray-300">Business Capital</label>
                <input required name="business_gross" type="number" value="0" id="business_gross" class="bg-gray-50 border border-gray-300 
                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
                w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <!-- SUBMIT BTN -->
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
            focus:ring-blue-300 font-medium rounded-lg text-sm w-full 
            sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Submit</button>
        </form>
    </div>

    <!-- MODAL -->
    <div id="add_new_establishment-modal" aria-hidden="true" 
    class="hidden overflow-y-auto overflow-x-hidden fixed right-0 bg-black bg-opacity-50
    left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
        <div class="relative px-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- CLOSE BTN -->
                <div class="flex justify-end p-2">
                    <button type="button" class="text-gray-400 
                    bg-transparent hover:bg-gray-200 hover:text-gray-900 
                    rounded-lg text-sm p-1.5 ml-auto inline-flex items-center 
                    dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="add_new_establishment-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" id="new_establishment">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">New Establishment</h3>
                    <!-- BUSINESS CODE -->
                    <div class="mb-6">
                        <label for="business_code" class="block mb-2 text-sm 
                        font-medium text-gray-900 dark:text-gray-300">Business Code</label>
                        <input required name="business_code" type="text" value="" id="business_code" class="bg-gray-50 border border-gray-300 
                        text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
                        w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <!-- NAME -->
                    <div class="mb-6">
                        <label for="business_name" class="block mb-2 text-sm 
                        font-medium text-gray-900 dark:text-gray-300">Name</label>
                        <input required name="business_name" type="text" value="" id="business_name" class="bg-gray-50 border border-gray-300 
                        text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
                        w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <!-- OWNER -->
                    <div class="mb-6">
                        <label for="business_owner" class="block mb-2 text-sm 
                        font-medium text-gray-900 dark:text-gray-300">Owner's Name</label>
                        <input required name="business_owner" type="text" value="" id="business_owner" class="bg-gray-50 border border-gray-300 
                        text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
                        w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <!-- SUBMIT BTN -->
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                    focus:ring-blue-300 font-medium rounded-lg text-sm w-full 
                    sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit</button>
                </form>
            </div>
        </div>
    </div> 
</div>


<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.4.1/firebase-app.js";
    import { getDatabase, ref, set, onValue } from "https://www.gstatic.com/firebasejs/9.4.1/firebase-database.js";
    import { getStorage, ref as storageRef, getDownloadURL } from "https://www.gstatic.com/firebasejs/9.4.1/firebase-storage.js";

    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    const firebaseConfig = {
    apiKey: "AIzaSyA4myV7wAp5hNpjBWT2URSB3k5i-PV-cUc",
    authDomain: "ilgempstat.firebaseapp.com",
    databaseURL: "https://ilgempstat-default-rtdb.firebaseio.com",
    projectId: "ilgempstat",
    storageBucket: "ilgempstat.appspot.com",
    messagingSenderId: "239426682732",
    appId: "1:239426682732:web:21f0f7562aaa4495c47d49",
    measurementId: "G-41V3TF1ZXQ"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);

    // Get database
    const db = getDatabase();
    // Send Data to firebase
    function addDataToFirebase({year,barangay,female_employees,male_employees,res_employees,total_employees} = {}){
        set(ref(db, 'Year/'+ year + '/' + barangay), {
        Barangay: barangay, 
        Female_Employees: female_employees,
        Male_Employees : male_employees,
        Residential_Employees : res_employees,
        Total_Employees : total_employees
        });
    }

    $(document).ready(function(){
        $("#addData").submit(function(e){
            e.preventDefault();

            const formData = $(this).serializeArray();

            const path = "addEmployementData";

            sendPostRequest({
                path : path,
                data : formData,
                done : function(data){
                    
                    // send data to firebase
                    const firebaseData = data['data'];
                    
                    // console.log(firebaseData);

                    const year = firebaseData['YEAR'];
                    const barangay = firebaseData['BARANGAY'];
                    const female_employee = firebaseData['EMPLOYMENT_STATUS']['TTL_FEMALE'];
                    const male_employee = firebaseData['EMPLOYMENT_STATUS']['TTL_MALE'];
                    const residential_employee = firebaseData['EMPLOYMENT_STATUS']['TTL_RESIDENTIAL'];
                    const ttl_worker = firebaseData['EMPLOYMENT_STATUS']['TTL_WORKER'];
                    
                    addDataToFirebase({
                        year: year,
                        barangay: barangay,
                        female_employees : female_employee,
                        male_employees : male_employee,
                        res_employees : residential_employee,
                        total_employees : ttl_worker,
                    });
                    
                    document.getElementById("addData").reset();
                
                },
            })
        });

        $("#new_establishment").submit(function(e){
            e.preventDefault();

            const formData = $(this).serializeArray();

            const path = "add_new_establishment";
            sendPostRequest({
                path : path,
                data : formData,
                done : function(data){
                    window.location.reload();
                },
            });
        });
    });
</script>