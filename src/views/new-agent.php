        <!-- Hero section start -->

        <section class="bg-no-repeat bg-center bg-cover bg-[#FFF6F0] h-[350px] lg:h-[513px] xl:h-[650px] flex flex-wrap items-center relative before:absolute before:inset-0 before:content-[''] before:bg-[#000000] before:opacity-[70%]" style="background-image: url('assets/images/breadcrumb/bg-1.png');">
            <div class="container">
                <div class="grid grid-cols-12">
                    <div class="col-span-12">
                        <div class="max-w-[700px]  mx-auto text-center text-white relative z-[1]">
                            <div class="mb-5"><span class="text-base block">Register</span></div>
                            <h1 class="font-recoleta text-[32px] sm:text-[50px] md:text-[68px] lg:text-[50px] leading-tight xl:text-2xl">
                                Register now!
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

        <!-- contact form start -->

        <div class="py-[80px] lg:py-[120px]">
            <div class="container">
                <form action="/new-agent" id="new_agent_form" method="POST" enctype="multipart/form-data">

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
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_name" type="text" placeholder="Full name">
                                    <p class="error" id="agent_name"></p>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_email" type="email" placeholder="Email address">
                                    <p class="error" id="agent_email"></p>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_phone"  type="text" placeholder="Phone number">
                                    <p class="error"id="agent_phone"></p>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_password"  type="password" placeholder="Password">
                                    <p class="error" id="agent_password"></p>
                                </div>

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " name="agent_confirm_password" type="password" placeholder="Confirm Password">
                                    <p class="error" id="agent_confirm_password"  ></p>
                                </div>

                                <div class="col-span-12">
                                    <!-- <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] " type="password" placeholder="Conform Password"> -->

                                    <div class="flex flex-wrap items-center justify-between w-full sm:w-[400px]">
                                        <div class="flex flex-wrap mt-[15px] items-center">
                                            <input type="checkbox" name="agent_agree">
                                            <label for="agent_agree" class="ml-[5px] cursor-pointer"> I agree with the
                                                <a href="#" class="underline text-secondary">Terms &
                                                    Conditions</a></label><br>
                                    <p class="error" id="agent_agree_check"></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <div class="flex flex-wrap items-center">
                                        <button type="submit" class="before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[40px] py-[15px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all">Register</button>

                                        <p class="ml-[40px]">Already have an Account? <a href="/login" class="text-secondary">Login</a></p>

                                    </div>
                                </div>

                               
                            </div>
                        </div>

                        <!-- Second form -->
                        <div class="col-span-12 lg:col-span-5 mb-[30px]" style="background-color: black;">
                        
                            <div class="grid grid-cols-12 gap-x-[20px] gap-y-[35px]">

                           
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>


       



