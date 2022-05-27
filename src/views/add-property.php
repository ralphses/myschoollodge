        <!-- Hero section start -->

        <section class="bg-no-repeat bg-center bg-cover bg-[#FFF6F0] h-[350px] lg:h-[513px] xl:h-[650px] flex flex-wrap items-center relative before:absolute before:inset-0 before:content-[''] before:bg-[#000000] before:opacity-[70%]" style="background-image: url('assets/images/breadcrumb/bg-1.png');">
            <div class="container">
                <div class="grid grid-cols-12">
                    <div class="col-span-12">
                        <div class="max-w-[700px]  mx-auto text-center text-white relative z-[1]">
                            <div class="mb-5"><span class="text-base block">Property ADD</span></div>
                            <h1 class="font-recoleta text-[32px] sm:text-[50px] md:text-[68px] lg:text-[50px] leading-tight xl:text-2xl">
                                Add Property
                            </h1>

                            <p class="text-base mt-5 max-w-[500px] mx-auto text-center">
                                Huge number of propreties availabe here for buy and sell
                                also you can find here co-living property as you like
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hero section end -->




        <!-- create agency Etart-->

        <div class="pt-[80px] lg:pt-[120px] add-properties-form-select">
            <div class="container">
                <form action="/add-property" enctype="multipart/form-data" method="POST" name="add-property" id="add-property">

                    <div class="grid grid-cols-12 gap-x-[30px]">

                        <div class="mb-[45px] col-span-12 md:col-span-8">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="propertyName">Lodge title</label>
                            <input id="property-title" class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px]" name="propertyName" id="propertyName" type="text" placeholder="e.g 1 room apartment">
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-4">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="propertyName">Rent cost</label>
                            <input id="property-title" class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px]" name="propertyPrice" id="propertyPrice" type="number" placeholder="enter amount in naira">
                        </div>

                        <!-- <div class="grid grid-cols-12 gap-x-[30px]"> -->

                        <div class="mb-[45px] col-span-12 md:col-span-6">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="PropertyType1">Lodge Type</label>
                            <div class="relative">
                                 <select class="nice-select form-select" id="propertyType" name="propertyType">
                                    <option value="">Select your type of lodge</option>
                                    <option value="Whole apartment">Whole apartment</option>
                                    <option value="Shared apartment">Shared apartment (for room mates)</option>
                                    <option value="Bunk">Bunk (hostel bunk space)</option>

                                </select>
                            </div>
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-6">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="propertyState">Lodge Status</label>
                            <div class="relative">
                                <select class="nice-select form-select" id="propertyState" name="propertyState">
                                    <option value="">Status of your lodge</option>
                                    <option value="New">New</option>
                                    <option value="Used">Used</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-[45px] col-span-12">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="textarea">Description</label>
                            <textarea class="h-[196px] xl:h-[100px] font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] resize-none" name="propertyDescription" id="propertyDescription" cols="30" rows="3" placeholder="Describe this lodge (optional)"></textarea>
                        </div>

                    </div>


                    <div class="grid grid-cols-12 gap-x-[30px]">

                        <div class="col-span-12">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="Location"><strong>Lodge location details</strong></label>
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-12">
                            <input id="Location" class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " name="propertyAddressLine" type="propertyAddressLine" type="text" placeholder="Address line">
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-4">
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px]" name="propertyTimeToGetToSchool" id="propertyTimeToGetToSchool" type="text" placeholder="Time to get to school e.g 2hrs 30mins (optional)">
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-4">
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px]" name="propertyNearestBustop" id="propertyNearestBustop" type="text" placeholder="Nearest bustop (optional)">
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-4">
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px]" name="propertyLocationArea" id="propertyLocationArea" type="text" placeholder="Area (optional)">
                        </div>


                        <div class="mb-[45px] col-span-12 md:col-span-6">
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px]" name="propertyLocationCity" id="propertyLocationCity" type="text" placeholder="City">
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-6">
                            <div class="relative">
                                <select class="nice-select form-select" id="propertyLocationState" name="propertyLocationState">
                                    <option value="">State</option>
                                    <option value="Abia">Abia</option>
                                    <option value="Adamawa">Adamawa</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="container">
                        <div class="grid grid-cols-12 gap-x-[30px] mb-[-45px]">

                            <div class="col-span-12 md:col-span-6 mb-[45px]">
                                <h3 class="mb-[40px] font-recoleta text-[18px] leading-none  text-primary"><strong>Lodge Aminities/Facilities</strong>
                                </h3>
                                 <ul class="mb-[-30px] list-none text-[15px] lg:text-[16px] flex flex-wrap">
                                     <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox" id="checkbox" name="AC" value="Air Conditioning">
                                           <label for="checkbox">Air Conditioning</label>
                                     </li>
                                     <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox" name="bedding-mattres" value="Bedding (mattres only)">
                                          <label for="checkbox2">Bedding (mattres only)</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="bedding-full" value="Bedding (complete bed)">
                                          <label for="checkbox2">Bedding (complete bed)</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="cable-gotv" value="Cable TV (Gotv)">
                                          <label for="checkbox2">Cable TV (Gotv)</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="cable-dstv" value="Cable TV (DStv)">
                                          <label for="checkbox2">Cable TV (DStv)</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="cable-startime" value="Cable TV (startimes)">
                                          <label for="checkbox2">Cable TV (startimes)</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="tv-normal" value="Television (analog)">
                                          <label for="checkbox2">Television (analog)</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="tv-smart" value="Smart television">
                                          <label for="checkbox2">Smart television</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="study-table" value="Study table">
                                          <label for="checkbox2">Study table</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="home-theatre" value="Home theatre">
                                          <label for="checkbox2">Home theatre</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="kitchen" value="Basic kitchen utensils">
                                          <label for="checkbox2">Basic kitchen utensils</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="kitchen-gas" value="Basic kitchen utensils with gas cylinder">
                                          <label for="checkbox2">Basic kitchen utensils with gas cylinder</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="internet" value="Internet/Wifi">
                                          <label for="checkbox2">Internet/Wifi</label>
                                    </li>
                                    <li class="mb-[30px] capitalize w-1/2">
                                           <input type="checkbox"name="pool" value="Swimming pool">
                                          <label for="checkbox2">Swimming pool</label>
                                    </li>
                            </ul>

                            <div class="mb-[45px] col-span-12 md:col-span-5" style="margin: 20px 0px;">
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px]" name="otherFacilities" id="otherFacilities" type="text" placeholder="Enter other facilities seperated with comma (e.g fan,bed)">
                            <p style="color: red; font-size: 16px; display: none;" id="other_text">Special characters and numbers not allowed here!</p>
                        </div>
                        

                    </div>

                    <div class="col-span-12 md:col-span-6 mb-[45px]">
                        <h3 class="mb-[40px] font-recoleta text-[18px] leading-none  text-primary"><strong>Place on Map</strong></h3>

                        <div class="h-[350px] rounded-[6px] overflow-hidden">
                            <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4814229.011985735!2d-65.89121968758322!3d-7.7486900084225026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91e8605342744385%3A0x3d3c6dc1394a7fc7!2sAmazon%20Rainforest!5e0!3m2!1sen!2sbd!4v1644813708270!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>


                    <div class="grid grid-cols-12 gap-x-[30px]">
                        <div class="mb-[45px] col-span-12">

                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary"><strong>Add Images</strong></label>
                            <div class="py-[35px] px-[15px] flex flex-wrap items-center justify-center text-center border border-primary border-opacity-60 rounded-[8px]">
                                <div class="relative">
                                    <input class="absolute inset-0 z-[0] opacity-0 w-full" type="file" name="propertyFeaturedImage" id="propertyFeaturedImage">
                                    <label for="propertyFeaturedImage" class="before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[30px] py-[12px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all flex flex-wrap items-center justify-center cursor-pointer"> <svg class="mr-[5px]" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                            <path d="M21.5853 8.39666C21.4868 8.25357 21.3542 8.1373 21.1995 8.05834C21.0448 7.97938 20.8729 7.94023 20.6992 7.94444H6.82698C6.53428 7.95684 6.25076 8.05025 6.00799 8.21425C5.76523 8.37825 5.57275 8.60641 5.45198 8.87333C5.44998 8.90181 5.44998 8.9304 5.45198 8.95888L3.66753 15.2778V4.27777H7.63365L9.22865 6.47166C9.28554 6.54951 9.36004 6.6128 9.44607 6.65635C9.53211 6.69989 9.62722 6.72246 9.72365 6.72221H19.5564C19.5564 6.39806 19.4277 6.08718 19.1984 5.85797C18.9692 5.62876 18.6584 5.49999 18.3342 5.49999H10.0353L8.62365 3.55666C8.50987 3.40095 8.36085 3.27438 8.18879 3.18728C8.01673 3.10019 7.8265 3.05505 7.63365 3.05555H3.66753C3.34338 3.05555 3.0325 3.18432 2.80329 3.41353C2.57408 3.64274 2.44531 3.95361 2.44531 4.27777V18.1439C2.45485 18.3638 2.55062 18.5711 2.71189 18.721C2.87316 18.8708 3.08695 18.9511 3.30698 18.9444H18.542C18.6783 18.9499 18.8126 18.9095 18.9234 18.8297C19.0341 18.75 19.115 18.6355 19.1531 18.5044L21.7136 9.27666C21.7614 9.12999 21.7747 8.97428 21.7524 8.82164C21.7302 8.66901 21.673 8.52357 21.5853 8.39666ZM18.0592 17.7222H4.21753L6.58865 9.28277C6.64651 9.20822 6.72869 9.15632 6.82087 9.1361H20.467L18.0592 17.7222Z" fill="#FAFAFA" />
                                        </svg>Main Image</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-[45px] col-span-12">

                            <div class="py-[35px] px-[15px] flex flex-wrap items-center justify-center text-center border border-primary border-opacity-60 rounded-[8px]">
                                <div class="relative">
                                    <input class="absolute inset-0 z-[0] opacity-0 w-full" type="file" name="otherImages[]" id="otherImages" multiple>
                                    <label for="otherImages" class="before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[30px] py-[12px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all flex flex-wrap items-center justify-center cursor-pointer">

                                        <svg class="mr-[5px]" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                            <path d="M21.5853 8.39666C21.4868 8.25357 21.3542 8.1373 21.1995 8.05834C21.0448 7.97938 20.8729 7.94023 20.6992 7.94444H6.82698C6.53428 7.95684 6.25076 8.05025 6.00799 8.21425C5.76523 8.37825 5.57275 8.60641 5.45198 8.87333C5.44998 8.90181 5.44998 8.9304 5.45198 8.95888L3.66753 15.2778V4.27777H7.63365L9.22865 6.47166C9.28554 6.54951 9.36004 6.6128 9.44607 6.65635C9.53211 6.69989 9.62722 6.72246 9.72365 6.72221H19.5564C19.5564 6.39806 19.4277 6.08718 19.1984 5.85797C18.9692 5.62876 18.6584 5.49999 18.3342 5.49999H10.0353L8.62365 3.55666C8.50987 3.40095 8.36085 3.27438 8.18879 3.18728C8.01673 3.10019 7.8265 3.05505 7.63365 3.05555H3.66753C3.34338 3.05555 3.0325 3.18432 2.80329 3.41353C2.57408 3.64274 2.44531 3.95361 2.44531 4.27777V18.1439C2.45485 18.3638 2.55062 18.5711 2.71189 18.721C2.87316 18.8708 3.08695 18.9511 3.30698 18.9444H18.542C18.6783 18.9499 18.8126 18.9095 18.9234 18.8297C19.0341 18.75 19.115 18.6355 19.1531 18.5044L21.7136 9.27666C21.7614 9.12999 21.7747 8.97428 21.7524 8.82164C21.7302 8.66901 21.673 8.52357 21.5853 8.39666ZM18.0592 17.7222H4.21753L6.58865 9.28277C6.64651 9.20822 6.72869 9.15632 6.82087 9.1361H20.467L18.0592 17.7222Z" fill="#FAFAFA" />
                                        </svg>Other images (maximum of 3)

                                    </label>

                                </div>

                            </div>
                            <div class="mt-[50px] lg:mt-[80px]">
                            <button class="before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[40px] py-[15px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all" type="submit" name="add_property_submit" id="add_property_submit">Post lodge</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- create agency End-->


        

        <script>

            const other = document.getElementById('otherFacilities');
            const otherText = document.getElementById('other_text');

            other.addEventListener('input', (e) => {
                otherText.style.display = 'none';
                let lastChar = e.target.value[e.target.value.length -1];
                if(e.target.value.length > 0) {
                    let code = lastChar.charCodeAt(0);
                    if(!((code <= 90 && code >= 65) || (code >= 97 && code <= 122) || code === 44 || code === 32)) {
                        otherText.style.display = 'block';
                        e.target.value = e.target.value.substr(0, e.target.value.length -1);
                    }      
                }
            })

        </script>


       