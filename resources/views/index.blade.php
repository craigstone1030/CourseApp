@extends('layouts.front')

@section('content')
<section class="home" id="home">
        <div class="home-container container grid">
          <div class="home-img-bg">
            <!-- <img src="{{ asset('frontend/assets/images/story.png') }}" alt="" class="home-img" /> -->
          </div>

          <div class="home-data">
            <h1 class="home-title">
              WELCOME <br />
              LMS SYSTEM
            </h1>
            <p class="home-description">
              Discover the way you learn & take control of your life and make
              something useful for others.
            </p>
            <div class="home-btns">
              <a href="#course" class="button button-home">Discover Category</a>
            </div>
          </div>
        </div>
      </section>

      <section class="story section container">
        <div class="story-container grid">
          <div class="story-data">
            <h2 class="section-title story-section-title">Our Goals</h2>
            <h1 class="story-title">
              Enjoy learning without any pressure
            </h1>

            <p class="story-description">
              Learn make something with real world project that help you increase creativity
            </p>
            <a href="#course" class="button btn-small">Discover</a>
          </div>
          <div class="story-images">
            <img src="{{ asset('frontend/assets/images/goals.png') }}" alt="" class="story-img" />
            <div class="story-square"></div>
          </div>
        </div>
      </section>

      <section class="testimonial section container">
        <div class="testimonial grid">
          <div class="swiper testimonial-swipper">
            <div class="swiper-wrapper">
              <div class="testimonial-card swiper-slide" style="text-align: center;">
                <!-- <div class="testimonial-quote">
                  <i class="bx bxs-quote-alt-left"></i>
                </div>
                <p class="testimonial-description">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. In,
                  labore reiciendis laboriosam quos at eum, sed sequi tempore
                  perspiciatis magnam iste quas sit minima provident!
                </p>
                <h3 class="testimonial-date">December 10, 2022</h3> -->

                <!-- <div class="testimonial-profile" style="justify-content: center;flex-direction: column;row-gap: 1.4rem;">
                  <img
                    src="{{ asset('frontend/assets/images/testimonial1.jpg') }}"
                    alt=""
                    class="testimonial-profile-img"
                  />

                  <div class="testimonial-profile-data">
                    <span class="testimonial-profile-name">John Doe</span>
                    <span class="testimonial-profile-detail"
                      >Director of a Company</span
                    >
                  </div> -->
                </div>
              </div>
              <div class="testimonial-card swiper-slide" style="text-align: center;">
                <!-- <div class="testimonial-quote">
                  <i class="bx bxs-quote-alt-left"></i>
                </div>
                <p class="testimonial-description">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. In,
                  labore reiciendis laboriosam quos at eum, sed sequi tempore
                  perspiciatis magnam iste quas sit minima provident!
                </p>
                <h3 class="testimonial-date">December 10, 2022</h3> -->

                <!-- <div class="testimonial-profile" style="justify-content: center;flex-direction: column;row-gap: 1.4rem;">
                  <img
                    src="{{ asset('frontend/assets/images/testimonial1.jpg') }}"
                    alt=""
                    class="testimonial-profile-img"
                  />

                  <div class="testimonial-profile-data">
                    <span class="testimonial-profile-name">John Doe</span>
                    <span class="testimonial-profile-detail"
                      >Director of a Company</span
                    >
                  </div> -->
                </div>
              </div>
              <div class="testimonial-card swiper-slide" style="text-align: center;">
                <!-- <div class="testimonial-quote">
                  <i class="bx bxs-quote-alt-left"></i>
                </div>
                <p class="testimonial-description">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. In,
                  labore reiciendis laboriosam quos at eum, sed sequi tempore
                  perspiciatis magnam iste quas sit minima provident!
                </p>
                <h3 class="testimonial-date"> December 10, 2022</h3> -->

                <!-- <div class="testimonial-profile" style="justify-content: center;flex-direction: column;row-gap: 1.4rem;">
                  <img
                    src="{{ asset('frontend/assets/images/testimonial1.jpg') }}"
                    alt=""
                    class="testimonial-profile-img"
                  />

                  <div class="testimonial-profile-data">
                    <span class="testimonial-profile-name">John Doe</span>
                    <span class="testimonial-profile-detail"
                      >Director of a Company</span
                    >
                  </div>
                </div> -->
              </div>
            </div>

            <div class="swiper-button-next" style="right: 30%;left: initial;top:initial;bottom: 3rem;">
              <i class="bx bx-right-arrow-alt"></i>
            </div>
            <div class="swiper-button-prev" style="right: initial;left: 30%;top:initial;bottom: 3rem;">
              <i class="bx bx-left-arrow-alt"></i>
            </div>
          </div>
      </section>

      <section class="newsletter section container">
        <div class="newsletter-bg grid">
          <div>
            <h2 class="newsletter-title">
              Subscribe Our LMS
            </h2>
            <p class="newsletter-description">
              Be the first to know the new category and subcategory.
            </p>
          </div>

          <form action="" class="newsletter-subscribe">
            <input
              type="email"
              placeholder="Enter your email"
              class="newsletter-input"
            />
            <button class="button">BUTTON</button>
          </form>
        </div>
      </section>
@endsection
