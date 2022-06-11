        <!-- Hero section start -->

        <section class="bg-no-repeat bg-center bg-cover bg-[#FFF6F0] h-[350px] lg:h-[513px] xl:h-[650px] flex flex-wrap items-center relative before:absolute before:inset-0 before:content-[''] before:bg-[#000000] before:opacity-[70%]" style="background-image: url('assets/images/breadcrumb/bg-1.png');">
            <div class="container">
                <div class="grid grid-cols-12">
                    <div class="col-span-12">
                        <div class="max-w-[700px]  mx-auto text-center text-white relative z-[1]">
                            <div class="mb-5"><span class="text-base block">Agency Create</span></div>
                            <h1 class="font-recoleta text-[32px] sm:text-[50px] md:text-[68px] lg:text-[50px] leading-tight xl:text-2xl">
                                Create Agency
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
                <form action="/new-agency" method="POST" enctype="multipart/form-data" id="new-agency-form">

                    <div class="grid grid-cols-12 gap-x-[30px]">

                        <div class="mb-[45px] col-span-12 md:col-span-12">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="property-title">Agency name</label>
                            <input name="name" class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " type="text" placeholder="The name of your agency here">
                            <p class="error" id="name"></p>
                        </div>


                        <div class="mb-[45px] col-span-12 md:col-span-6">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="property-title">Email address</label>
                            <input name="email" class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " type="text"placeholder="Official email address here">
                            <p class="error" id="email"></p>
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-6">   
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="property-title">Phone number</label>
                            <input name="phone" class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " type="text" placeholder="Official phone number">
                            <p class="error" id="phone"></p>
                        </div>

                        <div class="mb-[45px] col-span-12">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="textarea">Description</label>
                            <textarea name="description" id="description" class="h-[196px] xl:h-[260px] font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] resize-none" cols="30" rows="5" placeholder="Briefly describe your agency"></textarea>
                        </div>

                    </div>


                    <div class="grid grid-cols-12 gap-x-[30px]">

                        <div class="col-span-12">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="Location">Agency base location</label>
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-12">
                            <input id="Location" class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " name="address_line" type="text" placeholder="Your office address here">
                            <p class="error" id="address_line"></p>

                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-12">
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " name="nearest_bustop" id="nearest_bustop" type="text" placeholder="Nearest bustop (Optional)">
                        </div>
                        <div class="mb-[45px] col-span-12 md:col-span-12">
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " name="area" id="area" type="text" placeholder="Area or District (Optional)">
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-6">
                            <div class="relative">
                                <select class="nice-select form-select" name="city">
                                    <option value="0">City</option>
                                    <option value="1">Villa</option>
                                    <option value="2">Duplex</option>
                                </select>
                            <p class="error" id="city"></p>
                            </div>

                        </div>
                        <div class="mb-[45px] col-span-12 md:col-span-6">
                            <div class="relative">
                                <select class="nice-select form-select" name="state">
                                    <option value="0">State</option>
                                    <option value="1">Villa</option>
                                    <option value="2">Duplex</option>
                                </select>
                            <p class="error" id="state"></p>
                            </div>

                        </div>
                        
                        <div class="mb-[45px] col-span-12">
                            <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="speciality">Speciality</label>
                            <input name="speciality" id="speciality" class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " type="text" placeholder="Property area of specialization (Optional)">
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-6">
                        <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="speciality">Certification status</label>
                            <div class="relative">
                                <select class="nice-select form-select" name="certification_status">
                                    <option value="0">Certified Agency?</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            <p class="error" id="certification_status"></p>
                            </div>

                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-6">
                        <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary" for="speciality">Certifying firm</label>
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " type="text" name="certification_firm" placeholder="E.g Corperate Affairs Commission ">
                            <p class="error" id="certification_firm"></p>
                        </div>

                        <div class="mb-[45px] col-span-12 md:col-span-12">
                            <input class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] h-[60px] " name="certificate_no"  type="text" placeholder="Certificate number (e.g BN-40123)">
                            <p class="error" id="certificate_no"></p>
                        </div>

                    </div>

                    <div class="grid grid-cols-12 gap-x-[30px]">
                        <div class="mb-[45px] col-span-12">

                            <!-- <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary">Add Images</label> -->
                            <div class="py-[35px] px-[15px] flex flex-wrap items-center justify-center text-center border border-primary border-opacity-60 rounded-[8px]">
                                <div class="relative">
                                    <input class="absolute inset-0 z-[0] opacity-0 w-full" type="file" name="cover_image" id="cover_image">
                                    <label for="cover_image" class="before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[30px] py-[12px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all flex flex-wrap items-center justify-center cursor-pointer"> <svg class="mr-[5px]" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                            <path d="M21.5853 8.39666C21.4868 8.25357 21.3542 8.1373 21.1995 8.05834C21.0448 7.97938 20.8729 7.94023 20.6992 7.94444H6.82698C6.53428 7.95684 6.25076 8.05025 6.00799 8.21425C5.76523 8.37825 5.57275 8.60641 5.45198 8.87333C5.44998 8.90181 5.44998 8.9304 5.45198 8.95888L3.66753 15.2778V4.27777H7.63365L9.22865 6.47166C9.28554 6.54951 9.36004 6.6128 9.44607 6.65635C9.53211 6.69989 9.62722 6.72246 9.72365 6.72221H19.5564C19.5564 6.39806 19.4277 6.08718 19.1984 5.85797C18.9692 5.62876 18.6584 5.49999 18.3342 5.49999H10.0353L8.62365 3.55666C8.50987 3.40095 8.36085 3.27438 8.18879 3.18728C8.01673 3.10019 7.8265 3.05505 7.63365 3.05555H3.66753C3.34338 3.05555 3.0325 3.18432 2.80329 3.41353C2.57408 3.64274 2.44531 3.95361 2.44531 4.27777V18.1439C2.45485 18.3638 2.55062 18.5711 2.71189 18.721C2.87316 18.8708 3.08695 18.9511 3.30698 18.9444H18.542C18.6783 18.9499 18.8126 18.9095 18.9234 18.8297C19.0341 18.75 19.115 18.6355 19.1531 18.5044L21.7136 9.27666C21.7614 9.12999 21.7747 8.97428 21.7524 8.82164C21.7302 8.66901 21.673 8.52357 21.5853 8.39666ZM18.0592 17.7222H4.21753L6.58865 9.28277C6.64651 9.20822 6.72869 9.15632 6.82087 9.1361H20.467L18.0592 17.7222Z" fill="#FAFAFA" />
                                        </svg> Add Cover Image</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-[45px] col-span-12">

                            <!-- <label class="mb-[20px] font-recoleta text-[18px] leading-none block text-primary">Add Images</label> -->
                            <div class="py-[35px] px-[15px] flex flex-wrap items-center justify-center text-center border border-primary border-opacity-60 rounded-[8px]">
                                <div class="relative">
                                    <input class="absolute inset-0 z-[0] opacity-0 w-full" type="file" name="feature_image" id="feature_image">
                                    <label for="feature_image" class="before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[30px] py-[12px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all flex flex-wrap items-center justify-center cursor-pointer"> <svg class="mr-[5px]" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.5853 8.39666C21.4868 8.25357 21.3542 8.1373 21.1995 8.05834C21.0448 7.97938 20.8729 7.94023 20.6992 7.94444H6.82698C6.53428 7.95684 6.25076 8.05025 6.00799 8.21425C5.76523 8.37825 5.57275 8.60641 5.45198 8.87333C5.44998 8.90181 5.44998 8.9304 5.45198 8.95888L3.66753 15.2778V4.27777H7.63365L9.22865 6.47166C9.28554 6.54951 9.36004 6.6128 9.44607 6.65635C9.53211 6.69989 9.62722 6.72246 9.72365 6.72221H19.5564C19.5564 6.39806 19.4277 6.08718 19.1984 5.85797C18.9692 5.62876 18.6584 5.49999 18.3342 5.49999H10.0353L8.62365 3.55666C8.50987 3.40095 8.36085 3.27438 8.18879 3.18728C8.01673 3.10019 7.8265 3.05505 7.63365 3.05555H3.66753C3.34338 3.05555 3.0325 3.18432 2.80329 3.41353C2.57408 3.64274 2.44531 3.95361 2.44531 4.27777V18.1439C2.45485 18.3638 2.55062 18.5711 2.71189 18.721C2.87316 18.8708 3.08695 18.9511 3.30698 18.9444H18.542C18.6783 18.9499 18.8126 18.9095 18.9234 18.8297C19.0341 18.75 19.115 18.6355 19.1531 18.5044L21.7136 9.27666C21.7614 9.12999 21.7747 8.97428 21.7524 8.82164C21.7302 8.66901 21.673 8.52357 21.5853 8.39666ZM18.0592 17.7222H4.21753L6.58865 9.28277C6.64651 9.20822 6.72869 9.15632 6.82087 9.1361H20.467L18.0592 17.7222Z" fill="#FAFAFA" />
                                        </svg> Add Feature Image</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <button style="width: 100%;" type="submit" class="relative z-[1] before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[50px] py-[15px] capitalize font-medium text-white text-[14px] xl:text-[16px] after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all">Get Started</button>
                </form>
            </div>
        </div>

        <!-- create agency End-->
