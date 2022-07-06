<?php

// echo '<pre>'; var_dump($response); echo '</pre>'; exit; 

?>

<!-- Hero section end -->

<!-- Popular Properties start -->
<section class="popular-properties py-[10px] lg:py-[10px]">
    <div class="container">

        <div class="grid grid-cols-12 mb-[-30px] gap-[30px] xl:gap-[50px]">
            <div class="col-span-12 md:col-span-6 lg:col-span-8 mb-[30px]">
                <div class="grid grid-cols-12 mb-[30px] gap-[30px] items-center">
                    <div class="col-span-4 lg:col-span-6">

                    </div>
                    <div class="col-span-8 lg:col-span-6 text-left">
                        <span class="text-primary">Search Results</span>
                        <span class="text-primary">Sort by:</span>
                        <select name="select" id="select"
                            class="bg-white text-[#9C9C9C] text[14px] capitalize cursor-pointer nice-select sorting-select">
                            <option value="0" selected>Default Order</option>
                            <option value="1">A to Z</option>
                            <option value="2">Z to A</option>
                            <option value="3">All</option>
                        </select>
                    </div>
                </div>

                <?php 

                foreach($response['result'] as $key => $property) {

                    echo '  <div id="list" class="grid-tab-content" style="display: block;">
                            <div class="col-span-12">
                                <div class="grid grid-cols-1 gap-[30px]">

                                    <div
                                        class="overflow-hidden rounded-md drop-shadow-[0px_2px_15px_rgba(0,0,0,0.1)] bg-[#FFFDFC] text-center transition-all duration-300 hover:-translate-y-[10px] flex flex-wrap flex-col md:flex-row items-center py-[25px] px-[25px]">
                                        <div class="relative mb-[15px] lg:mb-[0px] lg:mr-[30px] block w-full lg:max-w-[270px]">';
                    echo ' <a href="/properties-details?id='.$property['id'].'" class="block">';
                    echo '<img src="'.$property['featured_image'].'"';
                    echo '  class="w-full h-full rounded-[6px]" loading="lazy" width="370" height="266"
                            alt="'.$property['title'].'">
                            </a>
                            <div class="flex flex-wrap flex-col absolute top-5 right-5"></div>
                            <span class="absolute bottom-5 left-5 bg-[#FFFDFC] p-[5px] rounded-[2px]
                                text-secondary leading-none text-[14px] font-normal">for Sale</span>
                            </div>

                            <div class="text-left w-full md:w-auto md:flex-1 3xl:mr-[55px]">';
                    echo '<h3><a href="/properties-details?id='.$property['id'].'"';
                    echo 'class="font-recoleta leading-tight text-[22px] xl:text-lg text-primary">'.$property['title'].'</a></h3>';
                    echo ' <h4><a href="/properties-details?id='.$property['id'].'"';
                    echo ' class="font-light text-tiny text-secondary underline">'.$property['location_id'].'</a></h4>';
                    echo ' <span class="font-light text-sm block">Added:'.date('d M, Y', strtotime($property['date_added'])).'</span>';
                    echo '<ul>
                            <li class="flex flex-wrap items-center justify-between">';
                    echo ' <span class="font-recoleta text-base text-primary leading-none">Price:N'.$property['price'].'</span>';
                    echo '  </li>
                            </ul>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>';

                }
                
                
                ?>




                <div class="grid grid-cols-12 mt-[50px] gap-[30px]">
                    <div class="col-span-12">
                        <ul class="pagination flex flex-wrap items-center justify-center">

                            <li class="mx-2">
                                <a class="flex flex-wrap items-center justify-center  w-[26px] h-[26px] bg-primary rounded-full text-orange leading-none transition-all hover:bg-secondary text-white text-[12px]"
                                    href="#">
                                    <svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(.clip0_876_580)">
                                            <path
                                                d="M5.8853 10.0592C5.7326 10.212 5.48474 10.212 5.33204 10.0592L0.636322 5.36134C0.48362 5.20856 0.48362 4.96059 0.636322 4.80782L5.33204 0.109909C5.48749 -0.0403413 5.73535 -0.0359829 5.8853 0.119544C6.03181 0.271171 6.03181 0.511801 5.8853 0.663428L1.46633 5.08446L5.8853 9.50573C6.03823 9.65873 6.03823 9.90648 5.8853 10.0592Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath class="clip0_876_580">
                                                <rect width="5.47826" height="10.1739" fill="white"
                                                    transform="matrix(-1 0 0 1 6 0)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>

                            <li class="mx-2">
                                <a class="flex flex-wrap items-center justify-center  w-[26px] h-[26px] leading-none hover:text-secondary"
                                    href="#">1</a>
                            </li>

                            <li class="mx-2">
                                <a class="flex flex-wrap items-center justify-center  w-[26px] h-[26px] leading-none hover:text-secondary"
                                    href="#">2</a>
                            </li>

                            <li class="mx-2">
                                <a class="flex flex-wrap items-center justify-center  w-[26px] h-[26px] leading-none hover:text-secondary"
                                    href="#">3</a>
                            </li>

                            <li class="mx-2">
                                <a class="flex flex-wrap items-center justify-center  w-[26px] h-[26px] leading-none hover:text-secondary"
                                    href="#">4</a>
                            </li>

                            <li class="mx-2">
                                <span>---</span>
                            </li>

                            <li class="mx-2">
                                <a class="flex flex-wrap items-center justify-center  w-[26px] h-[26px] leading-none hover:text-secondary"
                                    href="#">25</a>
                            </li>

                            <li class="mx-2">
                                <a class="flex flex-wrap items-center justify-center  w-[26px] h-[26px] bg-primary rounded-full text-orange leading-none transition-all hover:bg-secondary text-white text-[12px]"
                                    href="#">
                                    <svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(.clip0_876_576)">
                                            <path
                                                d="M0.114699 10.0592C0.267401 10.212 0.515257 10.212 0.667959 10.0592L5.36368 5.36134C5.51638 5.20856 5.51638 4.96059 5.36368 4.80782L0.667959 0.109909C0.512505 -0.0403413 0.26465 -0.0359829 0.114699 0.119544C-0.031813 0.271171 -0.031813 0.511801 0.114699 0.663428L4.53367 5.08446L0.114699 9.50573C-0.038233 9.65873 -0.038233 9.90648 0.114699 10.0592Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath class="clip0_876_576">
                                                <rect width="5.47826" height="10.1739" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                        </ul>


                    </div>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-4 mb-[30px]">
                <aside class="mb-[-40px] asidebar">
                    <div class="bg-[#F5F9F8] px-[20px] lg:px-[15px] xl:px-[35px] py-[50px] rounded-[8px] mb-[40px]">
                        <h3 class="text-primary leading-none text-[24px] font-recoleta underline mb-[30px]">Property
                            Search <span class="text-secondary">.</span></h3>

                        <form action="/search-lodge" method="GET" class="relative">
                            <div class="relative mb-[25px] bg-white">
                                <input
                                    class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] pl-[40px] pr-[20px] py-[10px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] bg-white"
                                    type="text" placeholder="Description" name="description">

                                <svg class="absolute top-1/2 -translate-y-1/2 z-[1] left-[20px] pointer-events-none"
                                    width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.39648 6.41666H8.60482" stroke="#0000" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path d="M7 8.02083V4.8125" stroke="#0000" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path
                                        d="M2.11231 4.9525C3.26148 -0.0991679 10.7456 -0.0933345 11.889 4.95833C12.5598 7.92167 10.7165 10.43 9.10064 11.9817C7.92814 13.1133 6.07314 13.1133 4.89481 11.9817C3.28481 10.43 1.44148 7.91583 2.11231 4.9525Z"
                                        stroke="#0000" stroke-width="1.5" />
                                </svg>
                            </div>

                            <div class="relative mb-[25px] bg-white">
                                <input
                                    class="font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] pl-[40px] pr-[20px] py-[10px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] bg-white"
                                    type="text" placeholder="Location" name="location">

                                <svg class="absolute top-1/2 -translate-y-1/2 z-[1] left-[20px] pointer-events-none"
                                    width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.39648 6.41666H8.60482" stroke="#0000" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path d="M7 8.02083V4.8125" stroke="#0000" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path
                                        d="M2.11231 4.9525C3.26148 -0.0991679 10.7456 -0.0933345 11.889 4.95833C12.5598 7.92167 10.7165 10.43 9.10064 11.9817C7.92814 13.1133 6.07314 13.1133 4.89481 11.9817C3.28481 10.43 1.44148 7.91583 2.11231 4.9525Z"
                                        stroke="#0000" stroke-width="1.5" />
                                </svg>
                            </div>

                            <div class="relative mb-[25px] bg-white">
                                <svg class="absolute top-1/2 -translate-y-1/2 z-[1] left-[20px] pointer-events-none"
                                    width="13" height="13" viewBox="0 0 13 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_928_754)">
                                        <path
                                            d="M4.64311 0H0V4.64311H4.64311V0ZM3.71437 3.71437H0.928741V0.928741H3.71437V3.71437Z"
                                            fill="#0000" />
                                        <path
                                            d="M8.35742 0V4.64311H13.0005V0H8.35742ZM12.0718 3.71437H9.28616V0.928741H12.0718V3.71437Z"
                                            fill="#0000" />
                                        <path
                                            d="M0 13H4.64311V8.35689H0V13ZM0.928741 9.28563H3.71437V12.0713H0.928741V9.28563Z"
                                            fill="#0000" />
                                        <path
                                            d="M8.35742 13H13.0005V8.35689H8.35742V13ZM9.28616 9.28563H12.0718V12.0713H9.28616V9.28563Z"
                                            fill="#0000" />
                                        <path
                                            d="M6.96437 0H6.03563V6.03563H0V6.96437H6.03563V13H6.96437V6.96437H13V6.03563H6.96437V0Z"
                                            fill="#0000" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_928_754">
                                            <rect width="13" height="13" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <select name="category"
                                    class="nice-select font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] pl-[40px] pr-[20px] py-[10px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] bg-white appearance-none cursor-pointer">
                                    <option selected value="Single Rooms">Single Rooms</option>
                                    <option value="Flat">Flat</option>
                                    <option value="Bunk">Bunk</option>
                                </select>
                            </div>



                            <div class="relative mb-[25px] bg-white">
                                <svg class="absolute top-1/2 -translate-y-1/2 z-[1] left-[20px] pointer-events-none"
                                    width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.78125 9.55323C5.78125 10.4132 6.44125 11.1066 7.26125 11.1066H8.93458C9.64792 11.1066 10.2279 10.4999 10.2279 9.75323C10.2279 8.9399 9.87458 8.65323 9.34792 8.46657L6.66125 7.53323C6.13458 7.34657 5.78125 7.0599 5.78125 6.24657C5.78125 5.4999 6.36125 4.89323 7.07458 4.89323H8.74792C9.56792 4.89323 10.2279 5.58657 10.2279 6.44657"
                                        stroke="#0000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M8 4V12" stroke="#0000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M7.9987 14.6667C11.6806 14.6667 14.6654 11.6819 14.6654 8C14.6654 4.3181 11.6806 1.33333 7.9987 1.33333C4.3168 1.33333 1.33203 4.3181 1.33203 8C1.33203 11.6819 4.3168 14.6667 7.9987 14.6667Z"
                                        stroke="#0000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <select
                                    class="nice-select font-light w-full leading-[1.75] placeholder:opacity-100 placeholder:text-body border border-primary border-opacity-60 rounded-[8px] pl-[40px] pr-[20px] py-[10px] focus:border-[#FD6400] focus:border-opacity-60 focus:outline-none focus:drop-shadow-[0px_6px_15px_rgba(0,0,0,0.1)] bg-white appearance-none cursor-pointer">
                                    <option selected value="0-100000">maximum N100,000</option>
                                    <option value="100000-150000">N100,000 - N150,000</option>
                                    <option value="150000-200000">N150,000 - N200,000</option>
                                    <option value="200000-300000">N200,000 - N300,000</option>
                                    <option value="300000-500000">N300,000 - N500,000</option>
                                    <option value="500000-1000000">N500,000 - N1,000,000</option>
                                </select>
                            </div>



                            <button type="submit"
                                class="block z-[1] before:rounded-md before:block before:absolute before:left-auto before:right-0 before:inset-y-0 before:z-[-1] before:bg-secondary before:w-0 hover:before:w-full hover:before:left-0 hover:before:right-auto before:transition-all leading-none px-[30px] py-[12px] capitalize font-medium text-white text-[14px] xl:text-[16px] relative after:block after:absolute after:inset-0 after:z-[-2] after:bg-primary after:rounded-md after:transition-all">Search</button>

                        </form>
                    </div>

                    <div class="bg-[#f5f9f8] px-[20px] lg:px-[15px] xl:px-[35px] py-[50px] rounded-[8px] mb-[40px]">
                        <h3 class="text-primary leading-none text-[24px] font-recoleta underline mb-[30px]">Featured
                            Property<span class="text-secondary">.</span></h3>
                        <div class="sidebar-carousel relative">
                            <div class="swiper">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">

                                        <div class="overflow-hidden rounded-md drop-shadow-[0px_2px_10px_rgba(0,0,0,0.1)] bg-[#FFFDFC] text-center mb-[20px]">
                                            <div class="relative">
                                                <a href="/properties-details" class="block">
                                                    <img src="assets/images/properties/properties6.jpg"
                                                        class="w-full h-full" loading="lazy" width="370" height="266"
                                                        alt="@@title">
                                                </a>
                                                


                                            </div>

                                            <div class="pt-[15px] pb-[20px] px-[20px] text-left">
                                                <h3><a href="/properties-details"
                                                        class="font-recoleta leading-tight text-[16px] text-primary">Orchid
                                                        Casel de
                                                        Paradise.</a></h3>
                                                <h4><a href="/properties-details"
                                                        class="font-light text-[14px] text-secondary underline">18B
                                                        Central
                                                        Street,
                                                        San Francisco</a></h4>
                                                <ul class="mt-[10px]">
                                                    <li class="flex flex-wrap items-center justify-between">
                                                        <span
                                                            class="font-recoleta text-[14px] text-primary leading-none">Price:
                                                            $255300</span>
                                                    </li>
                                                </ul>


                                            </div>
                                        </div>

                                        
                                        <!-- drop-shadow-[0px_2px_10px_rgba(0,0,0,0.1)] -->
                                      
                                    </div>

                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="flex flex-wrap items-center justify-center mt-[25px]">
                                <div
                                    class="swiper-button-prev w-[26px] h-[26px] rounded-full bg-primary  text-white hover:bg-secondary static mx-[5px] mt-[0px]">
                                </div>
                                <div
                                    class="swiper-button-next w-[26px] h-[26px] rounded-full bg-primary  text-white hover:bg-secondary static mx-[5px] mt-[0px]">
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="bg-[#f5f9f8] px-[20px] lg:px-[15px] xl:px-[35px] py-[50px] rounded-[8px] mb-[40px]">
                        <h3 class="text-primary leading-none text-[24px] font-recoleta underline mb-[30px]">Our
                            Agents<span class="text-secondary">.</span></h3>

                        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-x-[20px] mb-[-20px]">
                            <!-- single team start -->
                            <div class="text-center group mb-[30px]">
                                <div class="relative z-[1] rounded-[6px_6px_0px_0px]">
                                    <a href="agent-details.html"
                                        class="block relative before:absolute before:content-[''] before:inset-x-0 before:bottom-0 before:bg-[#0000] before:w-full before:h-[calc(100%_-_30px)] before:z-[-1] before:rounded-[6px_6px_0px_0px]">
                                        <img src="assets/images/team/sm/person1.png"
                                            class="max-w-[130px] max-h-[154px] object-contain block mx-auto"
                                            loading="lazy" width="130" height="154" alt="Albert S. Smith">
                                    </a>
                                </div>

                                <div
                                    class="bg-[#FFFDFC] drop-shadow-[0px_2px_15px_rgba(0,0,0,0.1)] rounded-[0px_0px_6px_6px] px-[15px] pt-[5px] pb-[15px] border-b-[6px] border-primary transition-all duration-700 group-hover:border-secondary">
                                    <h3><a href="agent-details.html"
                                            class="font-recoleta text-[14px] text-primary hover:text-secondary">Albert
                                            S. Smith</a></h3>
                                    <p class="font-light text-[12px] leading-none capitalize mt-[5px]">Real Estate Agent
                                    </p>
                                </div>
                            </div>
                            <div class="text-center group mb-[30px]">
                                <div class="relative z-[1] rounded-[6px_6px_0px_0px]">
                                    <a href="agent-details.html"
                                        class="block relative before:absolute before:content-[''] before:inset-x-0 before:bottom-0 before:bg-[#0000] before:w-full before:h-[calc(100%_-_30px)] before:z-[-1] before:rounded-[6px_6px_0px_0px]">
                                        <img src="assets/images/team/sm/person2.png"
                                            class="max-w-[130px] max-h-[154px] object-contain block mx-auto"
                                            loading="lazy" width="130" height="154" alt="Amelia Margaret">
                                    </a>
                                </div>

                                <div
                                    class="bg-[#FFFDFC] drop-shadow-[0px_2px_15px_rgba(0,0,0,0.1)] rounded-[0px_0px_6px_6px] px-[15px] pt-[5px] pb-[15px] border-b-[6px] border-primary transition-all duration-700 group-hover:border-secondary">
                                    <h3><a href="agent-details.html"
                                            class="font-recoleta text-[14px] text-primary hover:text-secondary">Amelia
                                            Margaret</a></h3>
                                    <p class="font-light text-[12px] leading-none capitalize mt-[5px]">Real Estate
                                        Broker</p>
                                </div>
                            </div>
                            <div class="text-center group mb-[30px]">
                                <div class="relative z-[1] rounded-[6px_6px_0px_0px]">
                                    <a href="agent-details.html"
                                        class="block relative before:absolute before:content-[''] before:inset-x-0 before:bottom-0 before:bg-[#0000] before:w-full before:h-[calc(100%_-_30px)] before:z-[-1] before:rounded-[6px_6px_0px_0px]">
                                        <img src="assets/images/team/sm/person3.png"
                                            class="max-w-[130px] max-h-[154px] object-contain block mx-auto"
                                            loading="lazy" width="130" height="154" alt="Stephen Kelvin">
                                    </a>
                                </div>

                                <div
                                    class="bg-[#FFFDFC] drop-shadow-[0px_2px_15px_rgba(0,0,0,0.1)] rounded-[0px_0px_6px_6px] px-[15px] pt-[5px] pb-[15px] border-b-[6px] border-primary transition-all duration-700 group-hover:border-secondary">
                                    <h3><a href="agent-details.html"
                                            class="font-recoleta text-[14px] text-primary hover:text-secondary">Stephen
                                            Kelvin</a></h3>
                                    <p class="font-light text-[12px] leading-none capitalize mt-[5px]">Real Estate Agent
                                    </p>
                                </div>
                            </div>
                            <div class="text-center group mb-[30px]">
                                <div class="relative z-[1] rounded-[6px_6px_0px_0px]">
                                    <a href="agent-details.html"
                                        class="block relative before:absolute before:content-[''] before:inset-x-0 before:bottom-0 before:bg-[#0000] before:w-full before:h-[calc(100%_-_30px)] before:z-[-1] before:rounded-[6px_6px_0px_0px]">
                                        <img src="assets/images/team/sm/person4.png"
                                            class="max-w-[130px] max-h-[154px] object-contain block mx-auto"
                                            loading="lazy" width="130" height="154" alt=" Michael Richard">
                                    </a>
                                </div>

                                <div
                                    class="bg-[#FFFDFC] drop-shadow-[0px_2px_15px_rgba(0,0,0,0.1)] rounded-[0px_0px_6px_6px] px-[15px] pt-[5px] pb-[15px] border-b-[6px] border-primary transition-all duration-700 group-hover:border-secondary">
                                    <h3><a href="agent-details.html"
                                            class="font-recoleta text-[14px] text-primary hover:text-secondary"> Michael
                                            Richard</a></h3>
                                    <p class="font-light text-[12px] leading-none capitalize mt-[5px]">Real Estate
                                        Broker</p>
                                </div>
                            </div>

                            <!-- single team end-->
                        </div>
                    </div>

                    <div class="bg-[#f5f9f8] px-[20px] lg:px-[15px] xl:px-[35px] py-[50px] rounded-[8px] mb-[40px]">
                        <h3 class="text-primary leading-none text-[24px] font-recoleta underline mb-[30px]">Tags<span
                                class="text-secondary">.</span></h3>
                        <ul class="flex flex-wrap my-[-7px] mx-[-5px] font-light text-[12px]">
                            <li class="my-[7px] mx-[5px]"><a href="#"
                                    class="leading-none border border-[#E0E0E0] py-[8px] px-[10px] block rounded-[4px] hover:text-secondary">Real
                                    Estate</a>
                            </li>
                            <li class="my-[7px] mx-[5px]"><a href="#"
                                    class="leading-none border border-[#E0E0E0] py-[8px] px-[10px] block rounded-[4px] hover:text-secondary">Appartment</a>
                            </li>
                            <li class="my-[7px] mx-[5px]"><a href="#"
                                    class="leading-none border border-[#E0E0E0] py-[8px] px-[10px] block rounded-[4px] hover:text-secondary">Sale
                                    Property</a>
                            </li>
                            <li class="my-[7px] mx-[5px]"><a href="#"
                                    class="leading-none border border-[#E0E0E0] py-[8px] px-[10px] block rounded-[4px] hover:text-secondary">Duplex</a>
                            </li>
                            <li class="my-[7px] mx-[5px]"><a href="#"
                                    class="leading-none border border-[#E0E0E0] py-[8px] px-[10px] block rounded-[4px] hover:text-secondary">Buy
                                    Property</a>
                            </li>
                            <li class="my-[7px] mx-[5px]"><a href="#"
                                    class="leading-none border border-[#E0E0E0] py-[8px] px-[10px] block rounded-[4px] hover:text-secondary">Houses</a>
                            </li>

                        </ul>
                    </div>
                </aside>
            </div>
        </div>

    </div>
</section>
<!-- Popular Properties end -->




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
                                    <img src="assets/images/brand/brand1.png" class="w-auto h-auto block mx-auto"
                                        loading="lazy" width="125" height="109" alt="@@title">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="#" class="block">
                                    <img src="assets/images/brand/brand2.png" class="w-auto h-auto block mx-auto"
                                        loading="lazy" width="125" height="109" alt="@@title">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="#" class="block">
                                    <img src="assets/images/brand/brand3.png" class="w-auto h-auto block mx-auto"
                                        loading="lazy" width="125" height="109" alt="@@title">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="#" class="block">
                                    <img src="assets/images/brand/brand4.png" class="w-auto h-auto block mx-auto"
                                        loading="lazy" width="125" height="109" alt="@@title">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="#" class="block">
                                    <img src="assets/images/brand/brand5.png" class="w-auto h-auto block mx-auto"
                                        loading="lazy" width="125" height="109" alt="@@title">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="#" class="block">
                                    <img src="assets/images/brand/brand3.png" class="w-auto h-auto block mx-auto"
                                        loading="lazy" width="125" height="109" alt="@@title">
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