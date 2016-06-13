@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="see" data-action="see"
                    data-type="error"
                    data-name="{{ $error }}">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form id="form1" name="form1" method="post" class="submit"
      data-action="submit" data-type="form" data-name="Click Submit Form 1"
      action="/contactForms/1">
    {{ csrf_field() }}
    <input type="hidden" name="pageId" value="{{ $page->id }}">
    <div class="row greenboxesbox">
        <h3 class="underline">Contact Us</h3>
        <div class="form-group">
            <label for="firstName" class="required">First Name</label>
            <input type="text" class="form-control click" name="firstName" id="firstName" value="" placeholder="First Name" Required
                   data-action="click"
                   data-type="input"
                   data-name="firstName field">
        </div>
        <div class="form-group">
            <label for="surname" class="required">Surname</label>
            <input type="text" class="form-control click" name="surname" id="surname" value="" placeholder="Surname" Required
                   data-action="click"
                   data-type="input"
                   data-name="surname field">
        </div>
        <div class="form-group">
            <label for="contactNumber" class="required">Contact Number</label>
            <input title="Please use a valid UK phone number without the +44, just use 0"
                   class="form-control click" id="contactNumber" name="contactNumber" value="" placeholder="Contact Number" Required
                   data-action="click"
                   data-type="input"
                   data-name="contactNumber field">
        </div>
        <div class="form-group">
            <label for="houseNumber" class="required">House Name/Number</label>
            <input type="text" class="form-control click" id="houseNumber" name="houseNumber" value=""
                   placeholder="House/Number" Required
                   data-action="click"
                   data-type="input"
                   data-name="houseNumber field">
        </div>
        <div class="form-group">
            <label for="postcode" class="required">Postcode</label>
            <input type="text" class="form-control click" id="postcode" name="postcode" placeholder="Postcode" value="" Required
                   data-action="click"
                   data-type="input"
                   data-name="postcode field">
        </div>
        <div class="form-group">
            <label for="email" class="required">Email address</label>
            <input type="email" class="form-control click" name="email" id="email" value="" placeholder="Your email" Required
                   data-action="click"
                   data-type="input"
                   data-name="email field">
        </div>
        <div class="form-group">
            <label for="service" class="required">What service do you require?</label>
            <textarea cols="16" required rows="3" class="form-control click" name="service" id="service"
                      data-action="click"
                      data-type="input"
                      data-name="service field"></textarea>
        </div>


        <div class="padding-10"></div>
        <input type="submit" name="submit"   class="btn btn-primary btn-block submit" id="submit" value="Submit Enquiry"
               data-action="submit"
               data-type="submit button"
               data-name="Submit Form 1"/>
        <div class="padding-10"></div>
        <p>
            <strong>* Mandatory fields</strong>
        </p>
        <p>All enquiries are dealt<br />
            with promptly.<br />
            Hours of business: <br />
            Monday - Friday <br />
            09:00 - 17:30
        </p>
        <p>
            We keep information submitted confidential and never pass it to a third party.
        </p>

        <p>
            If you wish to optout of our marketing materials. Please untick the box:
            <input type="checkbox" name="optout" value="N" checked
                   class="click"
                   data-action="click"
                   data-type="checkbox"
                   data-name="emailOptout">
        </p>

    </div>
</form>
