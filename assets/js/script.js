/**
 * Main JavaScript file for Xequence theme
 */

;(($) => {
    // Document ready
    $(document).ready(() => {
      // Mobile menu toggle
      $("#mobile-menu-toggle").on("click", () => {
        $("#mobile-menu").slideToggle(300)
      })
  
      // Mobile dropdown toggles
      $(".mobile-dropdown-toggle").on("click", function () {
        $(this).next(".mobile-dropdown-menu").slideToggle(200)
        $(this).find("i").toggleClass("fa-chevron-down fa-chevron-up")
      })
  
      // Sticky header
      $(window).on("scroll", () => {
        if ($(window).scrollTop() > 10) {
          $(".sticky-header").addClass("scrolled")
        } else {
          $(".sticky-header").removeClass("scrolled")
        }
      })
  
      // Smooth scroll for anchor links
      $('a[href*="#"]:not([href="#"])').on("click", function () {
        if (
          location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") &&
          location.hostname === this.hostname
        ) {
          let target = $(this.hash)
          target = target.length ? target : $("[name=" + this.hash.slice(1) + "]")
          if (target.length) {
            $("html, body").animate(
              {
                scrollTop: target.offset().top - 100,
              },
              1000,
            )
            return false
          }
        }
      })
  
      // Animation on scroll
      const animatedElements = $(".animate-on-scroll")
  
      if (animatedElements.length) {
        // Check if IntersectionObserver is supported
        if ("IntersectionObserver" in window) {
          const observer = new IntersectionObserver(
            (entries) => {
              entries.forEach((entry) => {
                if (entry.isIntersecting) {
                  $(entry.target).addClass("is-visible")
                }
              })
            },
            {
              threshold: 0.1,
            },
          )
  
          animatedElements.each(function () {
            observer.observe(this)
          })
        } else {
          // Fallback for browsers that don't support IntersectionObserver
          animatedElements.addClass("is-visible")
        }
      }
  
      // Testimonial slider (if exists)
      if ($(".testimonial-slider").length && $.fn.slick) {
        $(".testimonial-slider").slick({
          dots: true,
          arrows: false,
          infinite: true,
          speed: 500,
          slidesToShow: 1,
          adaptiveHeight: true,
          autoplay: true,
          autoplaySpeed: 5000,
        })
      }
  
      // Form validation
      $("form").each(function () {
        $(this).on("submit", function (e) {
          let valid = true
  
          $(this)
            .find("[required]")
            .each(function () {
              if ($(this).val() === "") {
                $(this).addClass("border-red-500")
                valid = false
              } else {
                $(this).removeClass("border-red-500")
              }
            })
  
          if (!valid) {
            e.preventDefault()
          }
        })
      })
  
      // Back to top button
      const backToTop = $("#back-to-top")
  
      if (backToTop.length) {
        $(window).on("scroll", () => {
          if ($(window).scrollTop() > 300) {
            backToTop.addClass("show")
          } else {
            backToTop.removeClass("show")
          }
        })
  
        backToTop.on("click", (e) => {
          e.preventDefault()
          $("html, body").animate(
            {
              scrollTop: 0,
            },
            800,
          )
        })
      }
    })
  })(jQuery)
  