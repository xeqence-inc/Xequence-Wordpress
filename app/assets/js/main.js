/**
 * Main JavaScript file for the Xequence theme
 */
;(() => {
    // Mobile menu toggle
    function setupMobileMenu() {
      const mobileMenuToggle = document.getElementById("mobile-menu-toggle")
      const mobileMenu = document.getElementById("mobile-menu")
  
      if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener("click", () => {
          mobileMenu.classList.toggle("hidden")
  
          // Toggle icon
          const icon = mobileMenuToggle.querySelector("i")
          if (icon) {
            if (icon.classList.contains("fa-bars")) {
              icon.classList.remove("fa-bars")
              icon.classList.add("fa-xmark")
            } else {
              icon.classList.remove("fa-xmark")
              icon.classList.add("fa-bars")
            }
          }
        })
      }
    }
  
    // Dropdown menus
    function setupDropdowns() {
      const dropdownToggles = document.querySelectorAll(".dropdown-toggle")
  
      dropdownToggles.forEach((toggle) => {
        toggle.addEventListener("click", function (e) {
          e.preventDefault()
          const dropdown = this.nextElementSibling
  
          if (dropdown && dropdown.classList.contains("dropdown-menu")) {
            dropdown.classList.toggle("hidden")
  
            // Toggle icon
            const icon = this.querySelector(".dropdown-icon")
            if (icon) {
              icon.classList.toggle("rotate-180")
            }
          }
        })
      })
  
      // Close dropdowns when clicking outside
      document.addEventListener("click", (e) => {
        if (!e.target.closest(".dropdown-toggle")) {
          const openDropdowns = document.querySelectorAll(".dropdown-menu:not(.hidden)")
          openDropdowns.forEach((dropdown) => {
            dropdown.classList.add("hidden")
  
            // Reset icon rotation
            const toggle = dropdown.previousElementSibling
            if (toggle) {
              const icon = toggle.querySelector(".dropdown-icon")
              if (icon) {
                icon.classList.remove("rotate-180")
              }
            }
          })
        }
      })
    }
  
    // Smooth scrolling for anchor links
    function setupSmoothScroll() {
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          const href = this.getAttribute("href")
  
          if (href !== "#") {
            e.preventDefault()
  
            const targetId = this.getAttribute("href")
            const targetElement = document.querySelector(targetId)
  
            if (targetElement) {
              const headerHeight = document.querySelector("header").offsetHeight
              const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight
  
              window.scrollTo({
                top: targetPosition,
                behavior: "smooth",
              })
  
              // Update URL hash without scrolling
              history.pushState(null, null, targetId)
            }
          }
        })
      })
    }
  
    // Initialize when DOM is ready
    document.addEventListener("DOMContentLoaded", () => {
      setupMobileMenu()
      setupDropdowns()
      setupSmoothScroll()
    })
  })()
  