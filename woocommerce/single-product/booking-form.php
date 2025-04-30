
<div class="br-booking-form">
    <div class="formtab">
        <button class="formtablinks" onclick="formBooking(event, 'Booking')" id="defaultOpenform">Booking</button>
        <button class="formtablinks" onclick="formBooking(event, 'ReqBooking')">Request
            Booking</button>
    </div>

    <!-- Booking Form start  -->

    <div class="form-detail">
        <div id="Booking" class="formtabcontent">
            <form class="booking-form">
                <div class="formgroup-wrap">
                    <div class="form-group">
                        <label for="date">Check in Date</label>
                        <input type="date" id="date" name="date" required="">
                    </div>

                    <div class="form-group">
                        <label for="date">Check out Date</label>
                        <input type="date" id="date" name="date" required="">
                    </div>
                </div>

                <h3 class="check-availibilty">Check Yacht Availibility <img src="<?php echo THEME_IMG_PATH; ?>/product/info.svg" alt="" class="icon-txt"></h3>

                <div class="formgroup-wrap">
                    <div class="form-group">
                        <label>Guests</label>
                        <select name="guests" id="guests">
                            <option value="guests">Guests</option>
                            <option value="guests">Guests1</option>
                            <option value="guests">Guests2</option>
                            <option value="guests">Guests3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Yachts</label>
                        <select name="yachts" id="yachts">
                            <option value="yachts">Yachts</option>
                            <option value="yachts">yachts1</option>
                            <option value="yachts">yachts2</option>
                            <option value="yachts">yachts3</option>
                        </select>
                    </div>
                </div>

                <div class="formgroup-wrap">
                    <div class="form-group">
                        <label>Services</label>
                        <select name="services" id="services">
                            <option value="services">Services</option>
                            <option value="services">services1</option>
                            <option value="services">services2</option>
                            <option value="services">services3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>GPS</label>
                        <select name="gps" id="gps">
                            <option value="gps">GPS</option>
                            <option value="gps">gps1</option>
                            <option value="gps">gps2</option>
                            <option value="gps">gps3</option>
                        </select>
                    </div>
                </div>

                <div class="extra-service-wrap bookingForm-sec">
                    <h4 class="title">Extra Service</h4>
                    <label><input type="checkbox" />Gym & Spa <span>$70 / Total</span></label>
                    <label><input type="checkbox" />Yacht Driver <span>$50 / Total</span></label>
                    <label><input type="checkbox" />Breakfast <span>$10 / Total</span></label>
                </div>

                <div class="deposit-wrap bookingForm-sec">
                    <h4 class="title">Deposit Options 50% er item</h4>
                    <input type="radio" id="payment" name="payment" value="30">
                    <label for="payment"> Full Payment</label>
                    <input type="radio" id="deposit" name="deposit" value="60">
                    <label for="deposit">Pay Deposit</label>
                </div>

                <div class="total_detail">
                    <div class="price-label">Total Payment</div>
                    <div class="total-price"><?php boatrental_wc_template_single_price(); ?></div>
                </div>

                <div class="form-group submit-btn">
                    <button type="submit">Book Now</button>
                </div>
            </form>
        </div>

        <!-- Booking Form end  -->

        <!-- Request Booking Form start  -->

        <div id="ReqBooking" class="formtabcontent">
            <form class="booking-form">

                <div class="formgroup-wrap">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Joan Doe" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="sample@gmail.com" required>
                    </div>
                </div>

                <div class="formgroup-wrap">
                    <div class="form-group">
                        <label for="number">Number</label>
                        <input type="text" id="number" name="number" placeholder="+91 1234567890" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="" required>
                    </div>
                </div>


                <div class="formgroup-wrap">
                    <div class="form-group">
                        <label for="date">Check in Date</label>
                        <input type="date" id="date" name="date" required="">
                    </div>

                    <div class="form-group">
                        <label for="date">Check out Date</label>
                        <input type="date" id="date" name="date" required="">
                    </div>
                </div>

                <h3 class="check-availibilty">Check Yacht Availibility <img src="<?php echo THEME_IMG_PATH; ?>/product/info.svg" alt="" class="icon-txt"></h3>

                <div class="formgroup-wrap">
                    <div class="form-group">
                        <label>Guests</label>
                        <select name="guests" id="guests">
                            <option value="guests">Guests</option>
                            <option value="guests">Guests1</option>
                            <option value="guests">Guests2</option>
                            <option value="guests">Guests3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Yachts</label>
                        <select name="yachts" id="yachts">
                            <option value="yachts">Yachts</option>
                            <option value="yachts">yachts1</option>
                            <option value="yachts">yachts2</option>
                            <option value="yachts">yachts3</option>
                        </select>
                    </div>
                </div>

                <div class="formgroup-wrap">
                    <div class="form-group">
                        <label>Services</label>
                        <select name="services" id="services">
                            <option value="services">Services</option>
                            <option value="services">services1</option>
                            <option value="services">services2</option>
                            <option value="services">services3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>GPS</label>
                        <select name="gps" id="gps">
                            <option value="gps">GPS</option>
                            <option value="gps">gps1</option>
                            <option value="gps">gps2</option>
                            <option value="gps">gps3</option>
                        </select>
                    </div>
                </div>

                <div class="extra-service-wrap bookingForm-sec">
                    <h4 class="title">Extra Service</h4>
                    <label><input type="checkbox" />Gym & Spa <span>$70 / Total</span></label>
                    <label><input type="checkbox" />Yacht Driver <span>$50 / Total</span></label>
                    <label><input type="checkbox" />Breakfast <span>$10 / Total</span></label>
                </div>

                <div class="extra-info-wrap">
                    <textarea name="extra" cols="30" rows="5" placeholder="Extra Information"></textarea>
                </div>

                <div class="form-group submit-btn">
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>

        <!-- Request Booking Form end  -->

    </div>
</div>



<script>
    function formBooking(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("formtabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("formtablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpenform").click();
</script>

