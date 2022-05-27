        <div class="py-[80px] lg:py-[120px]">
            <div class="container">
                <form action="/reset-password" method="POST">
                    <div class="grid grid-cols-12 gap-x-[30px] mb-[-30px]">
                        <div class="col-span-12 lg:col-span-6 mb-[30px]">
                            <h2 class="font-recoleta text-primary text-[24px] sm:text-[30px] leading-[1.277] xl:text-xl mb-[15px]">
                                Reset Password</h2>
                            <div class="grid grid-cols-12 gap-x-[20px] gap-y-[35px]">

                                <div class="col-span-12">
                                    <input class="font-light w-full sm:w-[400px] leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] p-[15px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)]" name="email_address" id="email_address" type="text" placeholder="Enter your registered email address">
                                </div>

                                <div class="col-span-12">
                                    <div class="flex flex-wrap items-center">
                                        <button type="submit" class="before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:-z-[1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[40px] py-[15px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:-z-[2] after:bg-primary after:rounded-md after:transition-all">Submit</button>
                                        <a href="/new-agent" class="font-medium text-primary hover:text-secondary ml-[40px]">Create new account</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 lg:col-span-6 mb-[30px]">
                            <img src="assets/images/contact/image.png" class="w-full h-auto rounded-[10px]" width="546" height="478" alt="image">
                        </div>
                    </div>
                </form>

            </div>
        </div>