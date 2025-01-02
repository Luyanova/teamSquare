document.addEventListener("DOMContentLoaded", () => {
  const openPopupBtn = document.getElementById("openPopupBtn");
  const closePopupBtn = document.getElementById("closePopupBtn");
  const popup = document.getElementById("popup");
  const popupOverlay = document.getElementById("popupOverlay");
  const steps = document.querySelectorAll(".step");
  const leaderSteps = document.querySelectorAll(".leader-step");
  let currentStep = 0;
  const checkboxes = document.querySelectorAll(".pucRadio");
  const popularMain = document.querySelector(".popularMain");
  const popularMain2 = document.getElementById("popularMain2");
  const cardBtnSlider = document.getElementById("cardBtnSlider");
  const scrollAmount = 340; // Scroll distance
  const reviewMain = document.querySelector(".reviewsMain");
  const reviewScrollAmount = 650; // Scroll distance
  const images = document.querySelectorAll(".heroImg2");
  const phrases = document.querySelectorAll(".heroHeadLineGrey");
  let currentIndex = 0;
  const navLinks = document.querySelectorAll(".headerBtm .nav-link");
  const dropdownMenus = document.querySelectorAll(".dropdown-menu");
  const burgerMenu = document.getElementById("burger-menu");
  const mobileMenu = document.getElementById("mobile-menu");
  const carouselImages = document.querySelector(".brandCarousel__images");
  const moreInfoLink = document.querySelector(".nav-link[data-menu='more-info-menu']");
  const moreInfoMenu = document.getElementById("more-info-menu");
  const toggleButtons = document.querySelectorAll('.toggleTextButton');


  function initCardBtn(){
  if (toggleButtons.length > 0) {
      toggleButtons.forEach(button => {
          button.addEventListener('click', function () {
              const buttonCardContent = this.closest('.buttonCardContent');
              const hiddenText = buttonCardContent.querySelector('.hiddenText');

              // Toggle the 'expanded' class
              buttonCardContent.classList.toggle('expanded');
              hiddenText.classList.toggle('expanded');
          });
      });
  }
}

// Fonction pour initier la pagination populaire
function initCardBtnPagination() {
  const cardBtnPagineNext = document.getElementById("cardBtnPagineNext");
  const cardBtnPagineBack = document.getElementById("cardBtnPagineBack");

  if (cardBtnSlider && cardBtnPagineNext && cardBtnPagineBack) {
    cardBtnPagineNext.addEventListener("click", function () {
      cardBtnSlider.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });

    cardBtnPagineBack.addEventListener("click", function () {
      cardBtnSlider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });
  }
}

  
    /****************  NAVBAR  *********************************************************************/
  
    function initMenu3() {
      if (moreInfoLink) {
        moreInfoLink.addEventListener("mouseenter", () => {
          moreInfoMenu.style.display = "flex";
          // Positionner le menu juste en dessous du lien
          const linkRect = moreInfoLink.getBoundingClientRect();
          moreInfoMenu.style.left = `${linkRect.left - 16}px`;
          moreInfoMenu.style.top = `${linkRect.bottom + window.scrollY}px`;
        });
    
        moreInfoLink.addEventListener("mouseleave", () => {
          setTimeout(() => {
            if (!moreInfoMenu.matches(":hover") && !moreInfoLink.matches(":hover")) {
              moreInfoMenu.style.display = "none";
            }
          }, 100);
        });
    
        moreInfoMenu.addEventListener("mouseenter", () => {
          moreInfoMenu.style.display = "flex";
        });
    
        moreInfoMenu.addEventListener("mouseleave", () => {
          moreInfoMenu.style.display = "none";
        });
      }
    }
    
    function toggleDisplay(element, displayStyle) {
      element.style.display = displayStyle;
    }
    
    function handleNavLinkHover(event, action) {
      const menuId = event.target.getAttribute("data-menu");
      const menu = document.getElementById(menuId);
      toggleDisplay(menu, action);
      if (action === "flex") {
        updateDropdownPosition(menu, event.target);
      }
    }
    
    function updateDropdownPosition(menu, link) {
      const linkRect = link.getBoundingClientRect();
      menu.style.top = `${linkRect.bottom + window.scrollY}px`;
    }
    
    navLinks.forEach((link) => {
      link.addEventListener("mouseenter", (event) => {
        handleNavLinkHover(event, "flex");
      });
    
      link.addEventListener("mouseleave", (event) => {
        const menuId = event.target.getAttribute("data-menu");
        const menu = document.getElementById(menuId);
        setTimeout(() => {
          if (!menu.matches(":hover")) {
            toggleDisplay(menu, "none");
          }
        }, 100);
      });
    });
    

    function updateMobileMenuPosition() {
      const headerRect = document.querySelector('header').getBoundingClientRect();
      mobileMenu.style.top = `${headerRect.bottom + window.scrollY}px`;
    }

    dropdownMenus.forEach((menu) => {
      menu.addEventListener("mouseleave", () => {
        toggleDisplay(menu, "none");
      });
    
      const backButton = menu.querySelector(".mobile-submenu-back");
      backButton.addEventListener("click", () => {
        toggleDisplay(mobileMenu, "flex");
        backButton.classList.remove("show");
        toggleDisplay(menu, "none");
      });
    });
    
    burgerMenu.addEventListener("click", () => {
      const displayStyle = mobileMenu.style.display === "flex" ? "none" : "flex";
      toggleDisplay(mobileMenu, displayStyle);
      if (displayStyle === "flex") {
        updateMobileMenuPosition();
      }
    });
    
    const mobileNavLinks = mobileMenu.querySelectorAll(".nav-link");
    mobileNavLinks.forEach((link) => {
      link.addEventListener("click", (event) => {
        const menuId = event.target.getAttribute("data-menu");
        showSubmenu(menuId);
      });
    });
    
    function showSubmenu(menuId) {
      const menu = document.getElementById(menuId);
      toggleDisplay(mobileMenu, "none");
      toggleDisplay(menu, "block");
      const backButton = menu.querySelector(".mobile-submenu-back");
      backButton.classList.add("show");
    }
  /****************  END NAVBAR  ************************************************************************* */

  /****************  HeroSection animation  ********************************************************************* */

  // Fonction pour initier la fonctionnalité de la section Hero
  function initHeroSection() {
    if (images.length > 0 && phrases.length > 0) {
      function changeContent() {
        currentIndex = (currentIndex + 1) % phrases.length;
        phrases.forEach((phrase, index) => {
          phrase.classList.toggle("active", index === currentIndex);
        });
        images.forEach((img, index) => {
          img.classList.toggle("active", index === currentIndex);
        });
      }
      setInterval(changeContent, 4000);
    }
  }

  /****************  END HeroSection animation  ***************************************************************** */

  /**************** Popular Sliders  ************************************************************************************ */

  // Fonction pour initier la pagination populaire
  function initPopularPagination() {
    const popularPagineNext = document.getElementById("popularPagineNext");
    const popularPagineBack = document.getElementById("popularPagineBack");

    if (popularMain && popularPagineNext && popularPagineBack) {
      popularPagineNext.addEventListener("click", function () {
        popularMain.scrollBy({ left: scrollAmount, behavior: "smooth" });
      });

      popularPagineBack.addEventListener("click", function () {
        popularMain.scrollBy({ left: -scrollAmount, behavior: "smooth" });
      });
    }
  }

  /****************  END Popular Sliders  ******************************************************************************* */


    /**************** Popular Sliders 2 ************************************************************************************ */

  // Fonction pour initier la pagination populaire
  function initPopularPagination2() {
    const popularPagineNext2 = document.getElementById("popularPagineNext2");
    const popularPagineBack2 = document.getElementById("popularPagineBack2");

    if (popularMain2 && popularPagineNext2 && popularPagineBack2) {
      popularPagineNext2.addEventListener("click", function () {
        popularMain2.scrollBy({ left: scrollAmount, behavior: "smooth" });
      });

      popularPagineBack2.addEventListener("click", function () {
        popularMain2.scrollBy({ left: -scrollAmount, behavior: "smooth" });
      });
    }
  }

  /****************  END Popular Sliders  ******************************************************************************* */

  /**************** Review Sliders  ************************************************************************************ */

  // Fonction pour initier la pagination populaire
  function initReviewPagination() {
    const reviewPagineNext = document.getElementById("reviewPagineNext");
    const reviewPagineBack = document.getElementById("reviewPagineBack");

    if (reviewMain && reviewPagineNext && reviewPagineBack) {
      reviewPagineNext.addEventListener("click", function () {
        reviewMain.scrollBy({ left: reviewScrollAmount, behavior: "smooth" });
      });

      reviewPagineBack.addEventListener("click", function () {
        reviewMain.scrollBy({ left: -reviewScrollAmount, behavior: "smooth" });
      });
    }
  }

  /****************  END Review Sliders  ******************************************************************************* */

  /****************  PopUp  ************************************************************************************* */

  // Fonction pour initier les événements de la pop-up
  function initPopupEvents() {
    if (openPopupBtn && closePopupBtn && popup && popupOverlay) {
      openPopupBtn.addEventListener("click", () => {
        popup.style.display = "flex";
        popupOverlay.style.display = "block";
        showStep(currentStep);
      });

      closePopupBtn.addEventListener("click", () => {
        closePopup();
      });

      document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
          closePopup();
        }
      });

      const nextBtn1 = document.getElementById("nextBtn1");
      const nextBtn2 = document.getElementById("nextBtn2");
      const prevBtn2 = document.getElementById("prevBtn2");
      const prevBtn3 = document.getElementById("prevBtn3");
      const finishBtn = document.getElementById("finishBtn");

      if (nextBtn1) nextBtn1.addEventListener("click", nextStep);
      if (nextBtn2) nextBtn2.addEventListener("click", nextStep);
      if (prevBtn2) prevBtn2.addEventListener("click", prevStep);
      if (prevBtn3) prevBtn3.addEventListener("click", prevStep);
      if (finishBtn) finishBtn.addEventListener("click", closePopup);
    }
  }

  // Fonction pour initier les événements des cases à cocher
  function initCheckboxEvents() {
    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener("change", function () {
        const cards = document.querySelectorAll(".popUpCard");
        cards.forEach(function (card) {
          card.classList.remove("checked");
        });
        if (this.checked) {
          const card = this.closest(".popUpCard");
          card.classList.add("checked");
        }
      });
    });
  }

  // Fonction pour afficher l'étape actuelle dans la pop-up
  function showStep(step) {
    steps.forEach((stepDiv, index) => {
      stepDiv.classList.remove("active");
      if (index === step) {
        stepDiv.classList.add("active");
      }
    });

    leaderSteps.forEach((leaderStep, index) => {
      leaderStep.classList.remove("active");
      if (index === step) {
        leaderStep.classList.add("active");
      }
    });
  }

  // Fonction pour passer à l'étape suivante
  function nextStep() {
    if (currentStep < steps.length - 1) {
      currentStep++;
      showStep(currentStep);
    }
  }

  // Fonction pour revenir à l'étape précédente
  function prevStep() {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  }

  // Fonction pour fermer la pop-up
  function closePopup() {
    popup.style.display = "none";
    popupOverlay.style.display = "none";
  }

  /****************  END PopUp  ********************************************************************************* */

  /****************  FAQ  *************************************************************************************** */

  // Fonction pour initier les événements de la FAQ
  function initFaqEvents() {
    const faqs = document.querySelectorAll(".faq");
    faqs.forEach((faq) => {
      faq.addEventListener("click", () => {
        faq.classList.toggle("active");
      });
    });
  }

  /****************  END FAQ  ************************************************************************************ */

  // Initialiser toutes les fonctionnalités
  initHeroSection();
  initPopularPagination();
  initPopularPagination2();
  initReviewPagination();
  initCardBtnPagination();
  initPopupEvents();
  initCheckboxEvents();
  initFaqEvents();
  initMenu3();
  initCardBtn();
});