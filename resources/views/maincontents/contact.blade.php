@extends('../layouts.home_layout');

@section('maincontent')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Contact</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Contact</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <div class="map-section">
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
    </div>

    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>A108 Adam Street<br>New York, NY 535022</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@example.com<br>contact@example.com</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 51<br>+1 5589 22475 14</p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">
            <form action="{{ URL('/contact') }}" method="post" class="php-email-form">
              @csrf
              <div class="row">
                <x-input type="text" name="name" placeholderText="Your Name" />
                <x-input type="email" name="email" placeholderText="Your Email" />
                <x-input type="text" name="subject" placeholderText="Subject" />
                <x-input type="text" name="message" placeholderText="Message" />
                <!-- <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}">
                  <span class="text-danger">
                    @error('name')
                      {{ $message }}
                    @enderror
                  </span>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{ old('email') }}">
                  <span class="text-danger">
                    @error('email')
                      {{ $message }}
                    @enderror
                  </span>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                <span class="text-danger">
                    @error('subject')
                      {{ $message }}
                    @enderror
                  </span>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message">{{ old('message') }}</textarea>
                <span class="text-danger">
                    @error('message')
                      {{ $message }}
                    @enderror
                  </span>
              </div> -->
              
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
              @if(session()->has('msg'))
                <div class="text-center">{{ session()->get('msg') }}</div>
              @endif
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

@endsection