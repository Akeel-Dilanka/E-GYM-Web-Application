function deleteFromBrand(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "Success") {
                alert("Brand removed from the shop");
                window.location = "managebrand.php";
            } else {
                alert(txt);
            }

        }
    }
    r.open("GET", "removeBrandProcess.php?id=" + id, true);
    r.send();
}
function deleteFromModel(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "Success") {
                alert("Model removed from the shop");
                window.location = "managemodel.php";
            } else {
                alert(txt);
            }

        }
    }
    r.open("GET", "removeModelProcess.php?id=" + id, true);
    r.send();
}


var bm;

function addNewBrand() {
    var bbm = document.getElementById("addBrandModal");
    bm = new bootstrap.Modal(bbm);
    bm.show();
}
var mm;

function addNewModel() {
    var mmm = document.getElementById("addModelModal");
    mm = new bootstrap.Modal(mmm);
    mm.show();
}



var bvm;
var newBrand;
var buemail;

function brandVerifyModal() {

    var m = document.getElementById("addBrandModelVerification");
    bvm = new bootstrap.Modal(m);

    newBrand = document.getElementById("nb").value;
    buemail = document.getElementById("eb").value;

    var f = new FormData();
    f.append("n", newBrand);
    f.append("e", buemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var response = r.responseText;

            if (response == "success") {
                bm.hide();
                bvm.show();
            } else {
                alert(response);
            }
        }
    }

    r.open("POST", "addNewBrandProcess.php", true);
    r.send(f);

}




var mvm;
var newModel;
var muemail;

function modelVerifyModal() {

    var m = document.getElementById("addModelModelVerification");
    mvm = new bootstrap.Modal(m);

    newModel = document.getElementById("nm").value;
    muemail = document.getElementById("em").value;

    var f = new FormData();
    f.append("n", newModel);
    f.append("e", muemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var response = r.responseText;

            if (response == "success") {
                mm.hide();
                mvm.show();
            } else {
                alert(response);
            }
        }
    }

    r.open("POST", "addNewModelProcess.php", true);
    r.send(f);

}


function saveBrand() {

    var text = document.getElementById("vtxtb").value;

    var f = new FormData();
    f.append("t", text);
    f.append("b", newBrand);
    f.append("e", buemail);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var response = r.responseText;
            if (response == "success") {
                bvm.hide();
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    r.open("POST", "saveNewBrandProcess.php", true);
    r.send(f);

}


function saveModel() {

    var text = document.getElementById("vtxtm").value;

    var f = new FormData();
    f.append("t", text);
    f.append("m", newModel);
    f.append("e", muemail);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var response = r.responseText;
            if (response == "success") {
                mvm.hide();
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    r.open("POST", "saveNewModelProcess.php", true);
    r.send(f);

}



function allProductbuynow(){

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
             window.location = "allproduct_invoice.php?productorder_id=" + t;

           
        }
    }


    r.open("POST", "allProductbuyNowProcess.php", true);
    r.send();

}

function payNowAllProducts() {

    var payment = document.getElementById("payment").value;
    var shipping = document.getElementById("shipping").value;


    var f = new FormData();

    f.append("payment", payment);
    f.append("shipping", shipping);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "checkout.php";
            } else {
                alert(t);
            }
        }
    }


    r.open("POST", "paymentProcess.php", true);
    r.send(f);
}

function checkout() {
    window.location = "allProductChechOut.php";
}

// cart qty
function check_qty(id) {
    var qty = document.getElementById("qtyvalue" + id);
    var avqty = document.getElementById("av_qty" + id).value;

    var f = new FormData();

    f.append("pqty", qty.value);
    f.append("pid", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "low_qty") {
                
                document.getElementById("qtyvalue" + id).value = 1;
            }else if(t == "higher_qty"){
                document.getElementById("qtyvalue" + id).value = avqty.toString();
            }
            window.location.reload();
        }
    }


    r.open("POST", "cartQtyProcess.php", true);
    r.send(f);

}
// cart qty

function changeCartStatus(id){
    var product_id = id;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactivated") {

                
                window.location = "cart.php";

            } else if (t == "activated") {

               
                window.location = "cart.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "cartStatusChangeProcess.php?id=" + product_id, true);
    r.send();

}

function changeAllCartStatus(){
    var r = new XMLHttpRequest();
    r.onreadystatechange =function(){
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactivated") {

                
                window.location = "cart.php";

            } else if (t == "activated") {

               
                window.location = "cart.php";

            } else {
                alert(t);
            }

        }
    }
    r.open("GET", "cartAllStatusChangeProcess.php", true);
    r.send();
}


function changeView() {

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");

}

function signUp() {
    var f = document.getElementById("fname");
    var l = document.getElementById("lname");
    var e = document.getElementById("email");
    var p = document.getElementById("password");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");

    var form = new FormData();
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                f.value = "";
                l.value = "";
                e.value = "";
                p.value = "";
                m.value = "";

                document.getElementById("msg").innerHTML = "";
                changeView();

            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(form);



}

function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("rm", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";

            } else {
                document.getElementById("msg2").innerHTML = t;
            }


        }
    }



    r.open("POST", "signInProcess.php", true);
    r.send(form);
}

var bm;

function forgotPassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {

                alert(t);

            } else {
                
                alert("Verification Code has send to your email. Please check inbox. ");
                var m = document.getElementById("fogotPasswordModel");
                bm = new bootstrap.Modal(m);
                bm.show();
            }
        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function showpassword1() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {

        np.type = "text";
        npb.innerHTML = "<i class='bi bi-eye-fill'></i>";

    } else {

        np.type = "password";
        npb.innerHTML = "<i class='bi bi-eye-slash-fill'>";

    }

}

function showpassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {

        rnp.type = "text";
        rnpb.innerHTML = "<i class='bi bi-eye-fill'></i>";

    } else {

        rnp.type = "password";
        rnpb.innerHTML = "<i class='bi bi-eye-slash-fill'>";

    }

}

function resetpassword() {

    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var form = new FormData();
    form.append("e", e.value);
    form.append("np", np.value);
    form.append("rnp", rnp.value);
    form.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {

                alert("Password reset success.");
                bm.hide();

            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "resetPassword.php", true);
    r.send(form);

}
function signout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "index.php";
            }
        }
    }

    r.open("GET", "signoutprocess.php", true);
    r.send();
}

function viewpw() {
    var pwbtn = document.getElementById("viewpassword");
    var pwtxt = document.getElementById("pwtxt");

    if (pwtxt.type == "text") {
        pwtxt.type = "password";
        pwbtn.innerHTML = "<i class='bi bi-eye-fill'></i>";
    } else {
        pwtxt.type = "text";
        pwbtn.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";

    }
}

function changeImage() {
    var view = document.getElementById("viewimg"); // image tag
    var file = document.getElementById("profileimg"); // file chooser

    file.onchange = function () {

        var file1 = this.files[0];
        var url1 = window.URL.createObjectURL(file1);
        view.src = url1;


    }

}

function update_profile() {
    var fname = document.getElementById("fn");
    var lname = document.getElementById("ln");
    var mobile = document.getElementById("mo");
    var line1 = document.getElementById("l1");
    var line2 = document.getElementById("l2");
    var province = document.getElementById("pr");
    var district = document.getElementById("dr");
    var city = document.getElementById("ci");
    var postal_code = document.getElementById("pc");
    var image = document.getElementById("profileimg");


    var form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("m", mobile.value);
    form.append("li1", line1.value);
    form.append("li2", line2.value);
    form.append("pr", province.value);
    form.append("di", district.value);
    form.append("ci", city.value);
    form.append("pc", postal_code.value);


    if (image.files.length == 0) {

        var comfirmation = confirm("Are you sure you don't want to update your profile picture?");
        if (comfirmation) {
            alert("You have not selected any image.");
        } else {

        }

    } else {
        form.append("image", image.files[0]);
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {

            var t = r.responseText;
            if (t == "Please Log In to your account first") {
                alert(t);
                window.location = "index.php";
            } else if (t == "Success") {
                window.location = "userprofile.php";
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

}

function changeProductImage() {
    var image = document.getElementById("imageuploader"); // file chooser



    image.onchange = function () {

        var image_count = image.files.length;

        for (x = 0; x < image_count; x++) {

            var file = this.files[x];
            var url = window.URL.createObjectURL(file);

            document.getElementById("preview" + x).src = url;
        }



    }
}

function addProduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");

    var condition = 0;

    if (document.getElementById("bn").checked) {
        condition = 1;
    } else if (document.getElementById("us").checked) {
        condition = 2;
    }

    var col = 0;

    if (document.getElementById("clr1").checked) {
        col = 1;
    } else if (document.getElementById("clr2").checked) {
        col = 2;
    } else if (document.getElementById("clr3").checked) {
        col = 3;
    } else if (document.getElementById("clr4").checked) {
        col = 4;
    } else if (document.getElementById("clr5").checked) {
        col = 5;
    } else if (document.getElementById("clr6").checked) {
        col = 6;
    } else if (document.getElementById("clr7").checked) {
        col = 7;
    } else if (document.getElementById("clr8").checked) {
        col = 8;
    } else if (document.getElementById("clr9").checked) {
        col = 9;
    }

    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("description");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("category", category.value);
    form.append("brand", brand.value);
    form.append("model", model.value);
    form.append("title", title.value);
    form.append("co", condition);
    form.append("col", col);
    form.append("qty", qty.value);
    form.append("cost", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("description", description.value);
    // form.append("img", image.files[0]);

    var r = new XMLHttpRequest();

    var img_count = image.files.length;

    if (img_count != 3) {

        alert("Please add 3 product images");

    } else {

        for (var x = 0; x < img_count; x++) {

            form.append("img" + x, image.files[x]);

        }

        r.open("POST", "addproductprocess.php", true);
        r.send(form);

    }

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Product added successfully");
                window.location = "addproduct.php";
            } else {
                alert(t);
            }
        }
    }

}

function changeStatus(id) {

    var product_id = id;
    var switch_btn = document.getElementById("flexSwitchCheckDefault" + id);
    var switch_lbl = document.getElementById("switchLbl" + id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactivated") {

                alert("Product has been Deactivated");
                window.location = "myproduct.php";

            } else if (t == "activated") {

                alert("Product has been Activated");
                window.location = "myproduct.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "statusChangeProcess.php?id=" + product_id, true);
    r.send();
}


function sortfunction() {
    var search = document.getElementById("s");
    var time;


    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }
    var qty;
    if (document.getElementById("l").checked) {
        qty = "1";
    } else if (document.getElementById("h").checked) {
        qty = "2";
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }
    r.open("POST", "sortProcess.php", true);
    r.send(f);
}





function clearsort() {
    window.location = "myproduct.php";
}



function sendId(id) {


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {

                window.location = "updateProduct.php";



            } else {
                alert(t);
            }

        }
    }
    r.open("GET", "sendProductIdProcess.php?id=" + id, true);
    r.send();
}

function updateProduct() {
    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("d", description.value);
    // f.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    var img_count = image.files.length;

    if (img_count != 3) {

        alert("Please add 3 product images");

    } else {

        for (var x = 0; x < img_count; x++) {

            f.append("i" + x, image.files[x]);
            

        }

        r.open("POST", "updateProcess.php", true);
        r.send(f);

    }

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            window.location = "updateProduct.php";
        }
    }
}

function basicSearch(x) {
    var txt = document.getElementById("basic_search_txt");
    var select = document.getElementById("basic_search_select");



    var f = new FormData();
    f.append("t", txt.value);
    f.append("s", select.value);
    f.append("page", x);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
            
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);

}

function advancedSearch(x) {

    var search_txt = document.getElementById("s1");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b1");
    var model = document.getElementById("m1");
    var condition = document.getElementById("con");
    var color = document.getElementById("col");
    var price_form_txt = document.getElementById("pf");
    var price_to_txt = document.getElementById("pt");
    var sort = document.getElementById("sort");

    var form = new FormData();
    form.append("page", x);
    form.append("s", search_txt.value);
    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("c1", condition.value);
    form.append("c2", color.value);
    form.append("p1", price_form_txt.value);
    form.append("p2", price_to_txt.value);
    form.append("s1", sort.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;

            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(form);
}

function loadMainImg(id) {
    var sample_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + sample_img + ")";
}

function check_value(qty) {

    var input = document.getElementById("qtyInput");

    if (input.value <= 0) {

        alert("Product Quantity must  be greater than 1 .");
        input.value = 1;

    } else if (input.value > qty) {

        alert("Insufficient Quantity. .");
        input.value = qty;
    }
}

function qty_inc(qty) {
    var input = document.getElementById("qtyInput");
    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();

    } else {
        alert("Maximum quantity has achieved.")
    }
}

function qty_dec() {
    var input = document.getElementById("qtyInput");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();

    } else {
        alert("Minimum quantity has achieved.")
    }
}

function addToCart(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }
    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function deleteFromCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "Success") {
                alert("Product removed from the cart");
                window.location = "cart.php";
            } else {
                alert(txt);
            }

        }
    }
    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();
}

function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "added") {
                document.getElementById("heart" + id).style.color = "red";
                window.location.reload();

            } else if (t == "removed") {
                document.getElementById("heart" + id).style.color = "white";
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

function removeFromWatchlist(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Success") {
                window.location.reload();
            } else {
                alert(text);
            }

        }
    }
    request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    request.send();
}

function printInvoice() {
    var page = document.getElementById("page").innerHTML;
    var restorePage = document.body.innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}


var xm;

function adminVerification() {

    var e = document.getElementById("em");

    var form = new FormData();
    form.append("em", e.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                var verificationModal = document.getElementById("verificationModal");
                xm = new bootstrap.Modal(verificationModal);
                xm.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(form);

}

function verify() {

    var vcode = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                xm.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "verifyProcess.php?id=" + vcode.value, true);
    r.send();

}

// var mm;

// function viewmsgmodal() {

//     var m = document.getElementById("viewMsgModal");
//     mm = new bootstrap.Modal(m);
//     mm.show();

// }


var pm;
function viewProductModal(id){
    var am = document.getElementById("viewproductmodal" + id);
pm = new bootstrap.Modal(am);
pm.show();
}


var cm;

function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var cvm;
var newCategory;
var uemail;

function categroyVerifyModal() {

    var m = document.getElementById("addCategoryModelVerification");
    cvm = new bootstrap.Modal(m);

    newCategory = document.getElementById("n").value;
    uemail = document.getElementById("e").value;

    var f = new FormData();
    f.append("n", newCategory);
    f.append("e", uemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var response = r.responseText;

            if (response == "success") {
                cm.hide();
                cvm.show();
            } else {
                alert(response);
            }
        }
    }

    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);

}

function saveCategory() {

    var text = document.getElementById("vtxt").value;

    var f = new FormData();
    f.append("t", text);
    f.append("c", newCategory);
    f.append("e", uemail);

    

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var response = r.responseText;
            if(response == "success"){
                cvm.hide();
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    r.open("POST", "saveNewCategoryProcess.php", true);
    r.send(f);

}

function changeInvoiceId(id){

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var response = r.responseText;
                
            // if(response == 1){
            //     document.getElementById("btn"+id).innerHTML = "Packing";
            // } else if(response == 2){
            //     document.getElementById("btn"+id).innerHTML = "Dispatch";
            // } else if(response == 3){
            //     document.getElementById("btn"+id).innerHTML = "Shipping";
            // } else if(response == 4){
            //     document.getElementById("btn"+id).innerHTML = "Delivered";
            //     document.getElementById("btn"+id).classList = "disabled";
            // } 

            location.reload();

        }
    }

    r.open("GET", "changeInvoiceIdProcess.php?id="+id, true);
    r.send();

}

function buyNow(qty) {

    var f = new FormData();
    f.append("pqty", qty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location = "invoice.php?order_id=" + t;
        }
    }


    r.open("POST", "buyNowProcess.php", true);
    r.send(f);

}

function payNowProduct(id) {
    var qty = document.getElementById("qtyInput").value;
    
  

    window.location = "checkOut.php?id="+id+"&qty="+qty;

}


var t ;
function viewprodcutsinglemodal(id){
    var m = document.getElementById("viewpModal" + id);
   t = new bootstrap.Modal(m);
    t.show();

}

function closepModel(){
    t.hide();
  }

function productBlock(id){

        var product_id = id;
    
        var r = new XMLHttpRequest();
    
        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "deactivated") {
    
                    alert("Product has been Blocked");
                    window.location = "manageProduct.php";
    
                } else if (t == "activated") {
    
                    alert("Product has been Unblocked");
                    window.location = "manageProduct.php";
    
                } else {
                    alert(t);
                }
    
            }
        }
    
        r.open("GET", "blockStatusChangeProcess.php?id=" + product_id, true);
        r.send();
}

function userBlock(id){

    var user_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactivated") {

                alert("User has been Blocked");
                window.location = "manageusers.php";

            } else if (t == "activated") {

                alert("User has been Unblocked");
                window.location = "manageusers.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "blockUserStatusChangeProcess.php?id=" + user_id, true);
    r.send();
}

function deleteFromCategory(id){

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "Success") {
                alert("Category removed from the shop");
                window.location = "manageCategory.php";
            } else {
                alert(txt);
            }

        }
    }
    r.open("GET", "removeCategoryProcess.php?id=" + id, true);
    r.send();
}

var feed;
function addFeedback(id){
   var feedback = document.getElementById("feedbackModal" + id );
   feed=new bootstrap.Modal(feedback);
   feed.show();

}

function saveFeedBack(id) {
    var pid = id;
    var feedback = document.getElementById("feedtxt" + id).value;

    var f = new FormData();

    f.append("i", pid);
    f.append("ft", feedback);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                feed.hide();
                alert("Thank for the Feedback");
            }
        }
    }
    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}

function removeFeedback(id){
    
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "Success") {
                alert("Product removed from the Transaction History");
                window.location = "purchaseHistory.php";
            } else {
                alert(txt);
            }

        }
    }
    r.open("GET", "removeFeedbackProcess.php?id=" + id, true);
    r.send();
}

function allFeedbackRemove(){

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "Success") {
                alert("All Product removed from the Transaction History");
                window.location = "purchaseHistory.php";
            } else {
                alert(txt);
            }

        }
    }
    r.open("GET", "removeAllFeedbackProcess.php", true);
    r.send();

}

// user
function sendmessage(mail) {

    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;


    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                urefresher(email);
               
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}


function urefresher(email) {
    setInterval(function(){
        refreshrecentarea();
        refreshmsgare(email);
        
    },500);
}



function refreshmsgare(mail) {
    var chatrow = document.getElementById("chatrow");
 

    var f = new FormData();

    f.append("e", mail);
   

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            chatrow.innerHTML = t;
        }
    }
    r.open("POST", "viewMessageProcess.php", true);
    r.send(f);
}

function refreshrecentarea() {
    var rcv = document.getElementById("rcv");
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;

        }
    }

    r.open("POST","refreshRecentAreaProcess.php",true);
    r.send();
}
// user

// admin


function sendAdminMessage(mail) {

    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;


    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                refresher(email);
               
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "sendAdminMsgProcess.php", true);
    r.send(f);
}

function refresher(email) {
    setInterval(function(){
        refreshAdminrecentarea();
        refreshAdminmsgarea(email);
        
    },500);
}


function refreshAdminmsgarea(mail) {
    var chatrow = document.getElementById("chatrow");
 

    var f = new FormData();

    f.append("e", mail);
   

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            chatrow.innerHTML = t;
        }
    }
    r.open("POST", "viewAdminMessageProcess.php", true);
    r.send(f);
}

function refreshAdminrecentarea() {
    var rcv = document.getElementById("rcv");
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;

        }
    }

    r.open("POST","refreshAdminRecentAreaProcess.php",true);
    r.send();
}
// admin

function ViewAdminMessage(email){

     window.location="AdminMessage.php?email=" + email ;

}




