

        <?php 
        echo '<pre>'; var_dump($response); echo '</pre>'; ;

        ?>

        <!-- Hero section end -->

        <!-- contact form start -->

        <div class="py-[80px] lg:py-[120px]">
            <div class="container">
                <form action="/modify-agent" id="new_agent_form" method="POST" enctype="multipart/form-data">

                <!-- First form  -->
                    <div class="grid grid-cols-12 gap-x-[30px] mb-[-30px]">
                        <div class="col-span-12 lg:col-span-6 mb-[30px]">
                            <h2 class="font-recoleta text-primary text-[24px] sm:text-[30px] leading-[1.277] xl:text-xl mb-[15px]">
                                Create Account<span class="text-secondary">.</span></h2>

                            <p class="max-w-[465px] mb-[50px]">
                                Huge number of propreties availabe here for buy, sell and Rent.
                                Also you find here co-living property, lots opportunity you have to
                                choose here and enjoy huge discount you can get.
                            </p>
                            <div class="grid grid-cols-12 gap-x-[20px] gap-y-[35px]">

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_name" type="text" placeholder="Full name" value="<?php echo $response['agent_name'] ?? '' ?>">
                                    <p class="error" id="agent_name"></p>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_email" type="email" placeholder="Email address" value="<?php echo $response['agent_email'] ?? '' ?>">
                                    <p class="error" id="agent_email"></p>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_phone"  type="text" placeholder="Phone number" value="<?php echo $response['agent_phone'] ?? '' ?>">
                                    <p class="error"id="agent_phone"></p>
                                </div>

                                <div class="col-span-12">
                                    <textarea class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_address" id="agent_address"  type="text" placeholder="Residential address"><?php echo $response['agent_address'] ?? '' ?></textarea>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_password"  type="password" placeholder="Enter your password">
                                    <p class="error" id="agent_password"></p>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_confirm_password" type="password" placeholder="Confirm Password">
                                    <p class="error" id="agent_confirm_password"  ></p>
                                </div>

                                <div class="col-span-12">
                                <label for="passport" class="ml-[5px] cursor-pointer">Upload your photo (Optional)</label> <br>
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_image" id="agent_image"  type="file" placeholder="passport">

                                   
                                </div>

                            </div>
                        </div>

                        <!-- Second form -->
                        <div class="col-span-12 lg:col-span-5 mb-[30px]">
                        
                            <div class="grid grid-cols-12 gap-x-[20px] gap-y-[35px]">

                            <div class="col-span-12">
                            <div class="relative" style="width: 85%;">
                            <label for="passport" class="ml-[5px] cursor-pointer" style="margin: 0;"> <strong>Your agency</strong></label> <br>
                                <select class="nice-select form-select" id="agency" name="agency">
                                    <option value="">Select your agency</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                            </div>

                            <div class="col-span-12">
                                <label for="agent_role" class="ml-[5px] cursor-pointer" style="margin: 0;"> <strong>Role in agency</strong></label> <br>
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_role" id="agent_role"  type="text" placeholder="Enter your role in agency (e.g manager, field agent)" value="<?php echo $response['role'] ?? '' ?>">
                                </div>
                            
                            <div class="col-span-12">
                                <label for="passport" class="ml-[5px] cursor-pointer" style="margin: 0;"> <strong>Social media handles</strong></label> <br>
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_whatsapp" id="agent_whatsapp"  type="text" placeholder="Whatsapp" <?php echo $response['agent_whatsapp'] ?? '' ?>>
                                </div>
                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_fb" id="agent_fb"  type="text" placeholder="facebook link"<?php echo $response['agent_fab'] ?? '' ?>>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_twitter" id="agent_twitter"  type="text" placeholder="Twitter" <?php echo $response['agent_twitter'] ?? '' ?>>
                                </div>


                                <div class="col-span-12">
                                    <label for="passport" class="ml-[5px] cursor-pointer"> <strong>MEANS OF IDENTIFICATION</strong></label> <br>
                                    <div class="col-span-12">
                                    <input type="radio" name="agent_id_type" id="national_id" value="nin"> <label for="national_id" style="margin-right: 10px;">National Identity</label>
                                    <input type="radio" name="agent_id_type" id="voter_card" value="pvc"> <label for="national_id" style="margin-right: 10px;">Voter's card no</label> <br>
                                    <input type="radio" name="agent_id_type" id="driver_licence" value="d-licence"> <label for="national_id" style="margin-right: 10px;">Dirver Licence</label>
                                    <input type="radio" name="agent_id_type" id="sch-id" value="sch-id"> <label for="sch-id" style="margin-right: 10px;">School ID</label>
                                    
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_id_no" type="text" placeholder="NIN or PVC number or Driver's licence or School ID">
                                    <p class="error" id="agent_id_no" ></p>
                                    
                                </div>
                                <div class="col-span-12">
                                    <label class="ml-[5px] cursor-pointer">Upload a Scanned copy of your ID</label> <br>
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_id_image"type="file" >
                                    <p class="error" id="agent_id_image"></p>
                                    
                                </div>

                                <div class="col-span-12">
                                    <!-- <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " type="password" placeholder="Conform Password"> -->

                                   
                                </div>
                                
                                <div class="col-span-12">
                                    <div class="flex flex-wrap items-center">
                                        <button type="submit" class="before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[40px] py-[15px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all">Save</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>


        <!-- Brand section Start-->

        <div class="brand-section">
            <div class="container">
                <div class="grid grid-cols-12">
                    <div class="col-span-12">
                        <div class="brand-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <!-- swiper-slide start -->
                                    <div class="swiper-slide text-center">
                                        <a href="#" class="block">
                                            <img src="assets/images/brand/brand1.png" class="w-auto h-auto block mx-auto" loading="lazy" width="125" height="109" alt="@@title">
                                        </a>
                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="#" class="block">
                                            <img src="assets/images/brand/brand2.png" class="w-auto h-auto block mx-auto" loading="lazy" width="125" height="109" alt="@@title">
                                        </a>
                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="#" class="block">
                                            <img src="assets/images/brand/brand3.png" class="w-auto h-auto block mx-auto" loading="lazy" width="125" height="109" alt="@@title">
                                        </a>
                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="#" class="block">
                                            <img src="assets/images/brand/brand4.png" class="w-auto h-auto block mx-auto" loading="lazy" width="125" height="109" alt="@@title">
                                        </a>
                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="#" class="block">
                                            <img src="assets/images/brand/brand5.png" class="w-auto h-auto block mx-auto" loading="lazy" width="125" height="109" alt="@@title">
                                        </a>
                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="#" class="block">
                                            <img src="assets/images/brand/brand3.png" class="w-auto h-auto block mx-auto" loading="lazy" width="125" height="109" alt="@@title">
                                        </a>
                                    </div>

                                    <!-- swiper-slide end-->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Brand section End-->




