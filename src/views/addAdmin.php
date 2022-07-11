<?php  
use src\utils\Location;
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Admin</h3>
                <p class="text-subtitle text-muted">Fill in the full detail of this property</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Admin</li>
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
                            <form class="form" action="/add-admin" method="POST" name="add-admin" id="add-admin">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="propertyName">Full name</label>
                                            <input type="text" name="name" type="text"
                                                placeholder="e.g Eze Raphael" class="form-control" 
                                                value="">
                                                <p style="color: red; font-size: 16px; display: block;" id="name"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="propertyName">Phone number</label>
                                            <input type="number" name="phoneNumber"
                                                placeholder="e.g 09012345678" class="form-control" 
                                                value="">
                                                <p style="color: red; font-size: 16px; display: block;" id="phoneNumber"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="propertyName">Email Address</label>
                                            <input type="email" name="emailAddress"
                                                placeholder="e.g user@example.com" class="form-control" 
                                                value="">
                                                <p style="color: red; font-size: 16px; display: block;" id="emailAddress"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="role">Assign Role</label>
                                            <select name="role" class="custom-select">
                                                <option value="Manager">Manager</option>
                                                <option value="Editor">Editor</option>
                                            </select>
                                            <p style="color: red; font-size: 16px; display: block;" id="role"></p>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="role">Role Code</label>
                                            <select name="roleCode" class="custom-select">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <p style="color: red; font-size: 16px; display: block;" id="roleCode"></p>

                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 20px;">    
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary me-1 mb-1"
                                            name="add_admin_submit" id="add_admin_submit" value="Submit">
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