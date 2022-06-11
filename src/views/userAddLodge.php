
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Post a Lodge</h3>
                <p class="text-subtitle text-muted">Fill in the full detail of this property</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post a lodge</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-header">
                            <h4 class="card-title">Basic Details</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" action="/add-property" method="POST" name="add-property"
                                id="add-property" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8 col-12">
                                        <div class="form-group">
                                            <label for="propertyName">Property Title</label>
                                            <input type="text" name="propertyName" type="text"
                                                placeholder="e.g 1 room apartment" class="form-control" 
                                                value="<?php echo $response['propertyName'] ?? '' ?>">
                                                <p style="color: red; font-size: 16px; display: block;" id="propertyName"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="propertyPrice">Rent cost</label>
                                            <input type="number" name="propertyPrice" type="number"
                                                placeholder="Enter amount in naira e.g 40000" class="form-control"
                                                value="<?php echo $response['propertyPrice'] ?? 0 ?>">
                                                <p style="color: red; font-size: 16px; display: block;" id="propertyPrice"></p>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="propertyType">Property Type</label>
                                            <select name="propertyType" class="custom-select">
                                                <option value="">Select your type of lodge</option>
                                                <option value="Whole apartment" <?php if($response['propertyType'] == 'Whole apartment')  echo 'selected'?>">Whole apartment</option>
                                                <option value="Shared apartment" <?php if($response['propertyType'] == 'Shared apartment')  echo 'selected'?>>Shared apartment (for room mates)</option>
                                                <option value="Bunk" <?php if($response['propertyType'] == 'Bunk')  echo 'selected'?>>Bunk (hostel bunk space)</option>
                                            </select>
                                            <p style="color: red; font-size: 16px; display: block;" id="propertyType"></p>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="propertyState">State of property</label>
                                            <select name="propertyState" class="custom-select">
                                                <option value="">Status of your lodge</option>
                                                <option value="New" <?php if($response['propertyState'] == 'New')  echo 'selected'?>>New</option>
                                                <option value="Used" <?php if($response['propertyState'] == 'Used')  echo 'selected'?>>Used</option>
                                            </select>
                                            <p style="color: red; font-size: 16px; display: block;" id="propertyState"></p>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="propertyDescription" class="form-label">Property Description</label>
                                        <textarea class="form-control" name="propertyDescription"
                                            id="propertyDescription" cols="30" rows="3"
                                            placeholder="Describe this property (optional)"><?php echo $response['propertyDescription'] ?? '' ?></textarea>
                                    </div>

                                    <h4 class="card-title">Location Details</h4>


                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="propertyAddressLine" class="form-label">Address line</label>
                                        <textarea class="form-control" name="propertyAddressLine" cols="30" rows="3"
                                            placeholder="Enter the full address line of this property"><?php echo $response['propertyAddressLine'] ?? '' ?></textarea>
                                            <p style="color: red; font-size: 16px; display: block;" id="propertyAddressLine"></p>

                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="propertyTimeToGetToSchool">Time to get to school</label>
                                            <input type="text" name="propertyTimeToGetToSchool"
                                                id="propertyTimeToGetToSchool"
                                                placeholder="Time to get to school e.g 2hrs 30mins (optional)"
                                                class="form-control" value="<?php echo $response['propertyTimeToGetToSchool'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="propertyNearestBustop">Nearest Bustop</label>
                                            <input type="text" name="propertyNearestBustop" id="propertyNearestBustop"
                                                placeholder="Nearest bustop (optional)" class="form-control" value="<?php echo $response['propertyNearestBustop'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="propertyLocationArea">Area</label>
                                            <input type="text" name="propertyLocationArea" id="propertyLocationArea"
                                                placeholder="Area (optional)" class="form-control" value="<?php echo $response['propertyLocationArea'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="propertyLocationCity">City</label>
                                            <input type="text" name="propertyLocationCity"
                                                placeholder="City (e.g Jos)" class="form-control" value="<?php echo $response['propertyLocationCity'] ?? '' ?>">
                                            <p style="color: red; font-size: 16px; display: block;" id="propertyLocationCity"></p>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="propertyLocationState">State</label>
                                            <select name="propertyLocationState"
                                                class="custom-select">
                                                <option value="">Select Location State</option>
                                                <option value="Abia"<?php if($response['propertyLocationState'] == 'Abia')  echo 'selected'?>>Abia</option>
                                                <option value="Adamawa" <?php if($response['propertyLocationState'] == 'Adamawa')  echo 'selected'?>>Adamawa</option>
                                            </select>
                                            <p style="color: red; font-size: 16px; display: block;" id="propertyLocationState"></p>

                                        </div>
                                    </div>

                                </div>
                                <div class="row"
                                    style="border: 2px solid #dce7f2; margin-top: 15px; padding-top: 10px; margin-left: 5px; margin-right: 5px"
                                    style="margin-bottom: 0;">
                                    <h4 class="card-title">Lodge Aminities/Facilities</h4>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card" style="margin-bottom: 0px;">

                                            <div class="card-content">
                                                <div class="card-body">

                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                id="ac" name="AC"  value="Air Conditioning" <?php if(isset($response['facilities']['Air Conditioning'])) { echo 'checked';  unset($response['facilities']['Air Conditioning']); }?>>
                                                            <label for="ac">Air Conditioning</label>
                                                        </li>

                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="bedding-mattres" value="Bedding (mattres only)" <?php if(isset($response['facilities']['Bedding (mattres only)']))  { echo 'checked';  unset($response['facilities']['Bedding (mattres only)']);}?>>
                                                            <label for="checkbox2">Bedding (mattres only)</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="bedding-full" value="Bedding (complete bed)"<?php if(isset($response['facilities']['Bedding (complete bed)']))  { echo 'checked';  unset($response['facilities']['Bedding (complete bed)']);}?>>
                                                            <label for="checkbox2">Bedding (complete bed)</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="cable-gotv" value="Cable TV (Gotv)"<?php if(isset($response['facilities']['Cable TV (Gotv)']))  { echo 'checked'; unset($response['facilities']['Cable TV (Gotv)']);}?>>
                                                            <label for="checkbox2">Cable TV (Gotv)</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="cable-dstv" value="Cable TV (DStv)"<?php if(isset($response['facilities']['Cable TV (DStv)']))  { echo 'checked';  unset($response['facilities']['Cable TV (DStv)']);}?>>
                                                            <label for="checkbox2">Cable TV (DStv)</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="cable-startime" value="Cable TV (startimes)"<?php if(isset($response['facilities']['Cable TV (startimes)']))  { echo 'checked';  unset($response['facilities']['Cable TV (startimes)']);}?>>
                                                            <label for="checkbox2">Cable TV (startimes)</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="tv-normal" value="Television (analog)"<?php if(isset($response['facilities']['Television (analog)']))  { echo 'checked';  unset($response['facilities']['Television (analog)']);}?>>
                                                            <label for="checkbox2">Television (analog)</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12" style="margin-bottom: 0;">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">

                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="tv-smart" value="Smart television"<?php if(isset($response['facilities']['Smart television']))  { echo 'checked';  unset($response['facilities']['Smart television']);}?>>
                                                            <label for="checkbox2">Smart television</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="study-table" value="Study table"<?php if(isset($response['facilities']['Study table']))  { echo 'checked';  unset($response['facilities']['Study table']);}?>>
                                                            <label for="checkbox2">Study table</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="home-theatre" value="Home theatre"<?php if(isset($response['facilities']['Home theatre']))  { echo 'checked';  unset($response['facilities']['Home theatre']);}?>>
                                                            <label for="checkbox2">Home theatre</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="kitchen" value="Basic kitchen utensils"<?php if(isset($response['facilities']['Basic kitchen utensils']))  { echo 'checked';  unset($response['facilities']['Basic kitchen utensils']);}?>>
                                                            <label for="checkbox2">Basic kitchen utensils</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="kitchen-gas"
                                                                value="Basic kitchen utensils with gas cylinder"<?php if(isset($response['facilities']['Basic kitchen utensils with gas cylinder']))  { echo 'checked';  unset($response['facilities']['Basic kitchen utensils with gas cylinder']);}?>>
                                                            <label for="checkbox2">Basic kitchen utensils with gas
                                                                cylinder</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="internet" value="Internet/Wifi"<?php if(isset($response['facilities']['Internet/Wifi']))  { echo 'checked';  unset($response['facilities']['Internet/Wifi']);}?>>
                                                            <label for="checkbox2">Internet/Wifi</label>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                name="pool" value="Swimming pool"<?php if(isset($response['facilities']['Swimming pool']))  { echo 'checked';  unset($response['facilities']['Swimming pool']);}?>>
                                                            <label for="checkbox2">Swimming pool</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3" style="margin-top: 0;">
                                        <label for="propertyAddressLine" class="form-label">Other Facilities</label>
                                        <textarea class="form-control" name="otherFacilities" id="otherFacilities"
                                            type="text"
                                            placeholder="Enter other facilities seperated with comma (e.g fan, bed)"
                                            cols="30" rows="3"
                                            placeholder="Enter the full address line of this property"><?php if($response AND count($response['facilities']) > 0 ) {
                                                foreach($response['facilities'] as $facility) {
                                                    echo $facility.',';
                                                }
                                            } ?> </textarea>
                                        <p style="color: red; font-size: 16px; display: none;" id="other_text">Special
                                            characters and numbers not allowed here!</p>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 20px;">

                                    <div class="col-12 col-md-12">
                                        <div class="card">
                                            <!-- <div class="card-header"> -->
                                            <h5 class="card-title">Featured Image</h5>
                                            <!-- </div> -->
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <p class="card-text">Upload a featured image for this lodge. This image must be of good quality and resolution
                                                    </p>
                                                    <!-- Auto crop image file uploader -->
                                                    <input type="file" name="propertyFeaturedImage"
                                                        id="propertyFeaturedImage" class="image-crop-filepond"
                                                        image-crop-aspect-ratio="1:1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12">
                                        <div class="card">
                                            <h5 class="card-title">Other Images</h5>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <p class="card-text">Upload other images for this lodge (This may include rare view, side view, facilities and other images) <br> <strong>Note:</strong> other images cannot be more than 3
                                                    </p>
                                                    <!-- File uploader with multiple files upload -->
                                                    <input type="file" name="otherImages[]" id="otherImages"
                                                        class="multiple-files-filepond" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-12">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" name="userAgree" class='form-check-input'
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" required>

                                                <label for="userAgree">Agree to <span style="cursor: pointer;">Terms and
                                                        Conditions</span></label>
                                            <p style="color: red; font-size: 16px; display: block;" id="userAgree"></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary me-1 mb-1"
                                            name="add_property_submit" id="add_property_submit" value="Submit">
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">
                    Scrolling long
                    Content</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Biscuit powder jelly beans. Lollipop candy canes croissant
                    icing
                    chocolate cake. Cake fruitcake
                    powder pudding pastry
                </p>
                <p>
                    Tootsie roll oat cake I love bear claw I love caramels
                    caramels halvah
                    chocolate bar. Cotton
                    candy
                    gummi bears pudding pie apple pie cookie. Cheesecake jujubes
                    lemon drops
                    danish dessert I love
                    caramels powder
                </p>
                <p>
                    Chocolate cake icing tiramisu liquorice toffee donut sweet
                    roll cake.
                    Cupcake dessert icing
                    dragée dessert. Liquorice jujubes cake tart pie donut.
                    Cotton candy
                    candy canes lollipop liquorice
                    chocolate marzipan muffin pie liquorice.
                </p>
                <p>
                    Powder cookie jelly beans sugar plum ice cream. Candy canes
                    I love
                    powder sugar plum tiramisu.
                    Liquorice pudding chocolate cake cupcake topping biscuit.
                    Lemon drops
                    apple pie sesame snaps
                    tootsie roll carrot cake soufflé halvah. Biscuit powder
                    jelly beans.
                    Lollipop candy canes
                    croissant icing chocolate cake. Cake fruitcake powder
                    pudding pastry.
                </p>
                <p>
                    Tootsie roll oat cake I love bear claw I love caramels
                    caramels halvah
                    chocolate bar. Cotton
                    candy gummi bears pudding pie apple pie cookie. Cheesecake
                    jujubes lemon
                    drops danish dessert I
                    love caramels powder.
                </p>
                <p>
                    dragée dessert. Liquorice jujubes cake tart pie donut.
                    Cotton candy
                    candy canes lollipop liquorice
                    chocolate marzipan muffin pie liquorice.
                </p>
                <p>
                    Powder cookie jelly beans sugar plum ice cream. Candy canes
                    I love
                    powder sugar plum tiramisu.
                    Liquorice pudding chocolate cake cupcake topping biscuit.
                    Lemon drops
                    apple pie sesame snaps
                    tootsie roll carrot cake soufflé halvah.Biscuit powder jelly
                    beans.
                    Lollipop candy canes croissant
                    icing chocolate cake. Cake fruitcake powder pudding pastry.
                </p>
                <p>
                    Tootsie roll oat cake I love bear claw I love caramels
                    caramels halvah
                    chocolate bar. Cotton
                    candy gummi bears pudding pie apple pie cookie. Cheesecake
                    jujubes lemon
                    drops danish dessert I
                    love caramels powder.
                </p>
                <p>
                    Chocolate cake icing tiramisu liquorice toffee donut sweet
                    roll cake.
                    Cupcake dessert icing
                    dragée dessert. Liquorice jujubes cake tart pie donut.
                    Cotton candy
                    candy canes lollipop liquorice
                    chocolate marzipan muffin pie liquorice.
                </p>
                <p>
                    Powder cookie jelly beans sugar plum ice cream. Candy canes
                    I love
                    powder sugar plum tiramisu.
                    Liquorice pudding chocolate cake cupcake topping biscuit.
                    Lemon drops
                    apple pie sesame snaps
                    tootsie roll carrot cake soufflé halvah. Biscuit powder
                    jelly beans.
                    Lollipop candy canes
                    croissant icing chocolate cake. Cake fruitcake powder
                    pudding pastry.
                </p>
                <p>
                    Tootsie roll oat cake I love bear claw I love caramels
                    caramels halvah
                    chocolate bar. Cotton
                    candy gummi bears pudding pie apple pie cookie. Cheesecake
                    jujubes lemon
                    drops danish dessert I
                    love caramels powder.
                </p>
                <p>
                    Chocolate cake icing tiramisu liquorice toffee donut sweet
                    roll cake.
                    Cupcake dessert icing
                    dragée dessert. Liquorice jujubes cake tart pie donut.
                    Cotton candy
                    candy canes lollipop liquorice
                    chocolate marzipan muffin pie liquorice.
                </p>
                <p>
                    Powder cookie jelly beans sugar plum ice cream. Candy canes
                    I love
                    powder sugar plum tiramisu.
                    Liquorice pudding chocolate cake cupcake topping biscuit.
                    Lemon drops
                    apple pie sesame snaps
                    tootsie roll carrot cake soufflé halvah.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </div>
    </div>
</div>


<script>

    const other = document.getElementById('otherFacilities');
    const otherText = document.getElementById('other_text');

    other.addEventListener('input', (e) => {
        otherText.style.display = 'none';
        let lastChar = e.target.value[e.target.value.length - 1];
        if (e.target.value.length > 0) {
            let code = lastChar.charCodeAt(0);
            if (!((code <= 90 && code >= 65) || (code >= 97 && code <= 122) || code === 44 || code === 32)) {
                otherText.style.display = 'block';
                e.target.value = e.target.value.substr(0, e.target.value.length - 1);
            }
        }
    })
</script>