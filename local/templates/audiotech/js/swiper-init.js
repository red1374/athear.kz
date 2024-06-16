document.addEventListener('DOMContentLoaded', () => {
    const mainSlider = new Swiper(".main-slider", {
        slidesPerView: 1,
        spaceBetween: 0,
        slidesPerGroup: 1,
        effect: 'fade',
        parallax: true,
        loop: true,
        loopFillGroupWithBlank: false,
        speed: 750,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false
        },
        navigation: {
            nextEl: ".main-slider .swiper-button-next",
            prevEl: ".main-slider .swiper-button-prev"
        },
        pagination: {
            el: ".main-slider .swiper-pagination",
            // dynamicBullets: true,
            renderBullet: function (index, className) {
                return ('<span class="' + className + ' swiper-pagination-bullet--svg-animation"><svg width="20" height="20" viewBox="0 0 28 28"><circle class="svg__circle" cx="14" cy="14" r="12" fill="transparent" stroke-width="2"></circle><circle class="svg__circle-second" cx="14" cy="14" r="7" fill="red" stroke-width=""></circle></svg></span>');
            }
        },
    });

    if (window.innerWidth < 900)
    {
        document.querySelectorAll('.main-slider .swiper-slide').forEach(item => {
            item.style.backgroundImage = `url(${item.dataset.mobile})`;
        });
    }

    try {
        let p_bg = document.querySelector('.parallax-bg');
            s_slide = document.querySelectorAll('.main-slider .swiper-slide');
        if (p_bg && s_slide.length){
            p_bg.style.backgroundImage = s_slide[mainSlider.activeIndex].style.backgroundImage;

            mainSlider.on('slideChange', function () {
                document.querySelector('.parallax-bg').style.backgroundImage = document.querySelectorAll('.main-slider .swiper-slide')[mainSlider.activeIndex].style.backgroundImage;
            });
        }
    } catch (error) {
        console.log(error);
    }

    const swiperProductsActual = new Swiper(".actual-slider", {
        slidesPerView: 4,
        slidesPerGroup: 4,
        spaceBetween: 20,
        // loop: true,
        speed: 750,
        navigation: {
            nextEl: ".actual-slider .swiper-button-next",
            prevEl: ".actual-slider .swiper-button-prev"
        },
        pagination: {
            el: ".actual-slider .swiper-pagination",
            clickable: true
        },
        breakpoints: {
            941: {
                slidesPerView: 4
            },
            300: {
                slidesPerView: "auto",
                slidesPerGroup: 1,
            }
        }
    });

    const swiperPopular = new Swiper(".popular-slider", {
        slidesPerView: 4,
        slidesPerGroup: 4,
        spaceBetween: 20,
        loop: true,
        speed: 750,
        navigation: {
            nextEl: ".popular-slider .swiper-button-next",
            prevEl: ".popular-slider .swiper-button-prev"
        },
        pagination: {
            el: ".popular-slider .swiper-pagination",
            clickable: true
        },
        breakpoints: {
            941: {
                slidesPerView: 4
            },
            700: {
                slidesPerView: 3,
            },
            300: {
                slidesPerView: "auto",
                slidesPerGroup: 1,
            }
        }
    });

    const basketSlider = new Swiper(".basket-slider", {
        slidesPerView: 4,
        slidesPerGroup: 4,
        spaceBetween: 20,
        loop: true,
        speed: 750,
        navigation: {
            nextEl: ".basket-slider .swiper-button-next",
            prevEl: ".basket-slider .swiper-button-prev"
        },
        pagination: {
            el: ".basket-slider .swiper-pagination",
            clickable: true
        },
        breakpoints: {
            941: {
                slidesPerView: 4
            },
            300: {
                slidesPerView: "auto",
                slidesPerGroup: 1,
            }
        }
    });

    if (window.innerWidth <= 940) {
        const swiperBlog = new Swiper(".blog-slider", {
            slidesPerView: "auto",
            slidesPerGroup: 1,
            speed: 750,
            spaceBetween: 20,
            loop: true,
            breakpoints: {
                941: {
                    slidesPerView: 4
                },
                700: {
                    slidesPerView: 3,
                },
                0: {
                    slidesPerView: "auto",
                }
            },
            navigation: {
                nextEl: ".blog-slider .swiper-button-next",
                prevEl: ".blog-slider .swiper-button-prev"
            },
            pagination: {
                el: ".blog-slider .swiper-pagination",
                clickable: true
            },
        });
    }


    const articlesSlider = new Swiper(".articles-slider", {
        slidesPerView: 4,
        slidesPerGroup: 1,
        spaceBetween: 20,
        // loop: true,
        speed: 750,
        breakpoints: {
            941: {
                slidesPerView: 4,
            },
            701: {
                slidesPerView: 3,
            },
            0: {
                slidesPerView: "auto",
            },
        },
        navigation: {
            nextEl: ".articles-slider .swiper-button-next",
            prevEl: ".articles-slider .swiper-button-prev"
        },
        pagination: {
            el: ".articles-slider .swiper-pagination",
            clickable: true
        },
    });


    if (window.innerWidth <= 940) {
        const swiperArticle = new Swiper(".article-slider", {
            slidesPerView: 3,
            spaceBetween: 20,
            slidesPerGroup: 1,
            loop: true,
            speed: 750,
            navigation: {
                nextEl: ".article-slider .swiper-button-next",
                prevEl: ".article-slider .swiper-button-prev"
            },
            pagination: {
                el: ".article-slider .swiper-pagination",
                clickable: true
            },
            breakpoints: {
                701: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                },
                0: {
                    slidesPerView: "auto",
                }
            }
        });
    }



    const swiperThree = new Swiper('.swiper-three', {
        spaceBetween: 20,
        slidesPerView: 3,
        loop: true,
        breakpoints: {
            701: {
                spaceBetween: 20,
                slidesPerView: 3,
            },
            0: {
                slidesPerView: "auto",
                slidesPerGroup: 1,
            }
        }
    });

    const swiperThreeNews = new Swiper('.swiper-three-news', {
        spaceBetween: 20,
        slidesPerView: 3,
        // loop: true,
        breakpoints: {
            701: {
                spaceBetween: 20,
                slidesPerView: 3,
            },
            0: {
                slidesPerView: "auto",
                slidesPerGroup: 1,
            }
        }
    });

    const swiperThumbs = new Swiper(".product__slider .swiper-thumbs", {
        spaceBetween: 10,
        slidesPerView: 5,
        freeMode: true,
        watchSlidesProgress: true,
        direction: "vertical",
        on: {
            click: function () {
                swiperProduct2.slideTo(swiperProduct.activeIndex);
            },

        }
    });

    const swiperProduct = new Swiper(".product__slider .swiper-product", {
        slidesPerView: 1,
        lazy: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        thumbs: {
            swiper: swiperThumbs
        },
        pagination: {
            el: '.swiper-product .swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
        on: {
            slideChange: function () {
                swiperProduct2.slideTo(swiperProduct.activeIndex);
            }
        }
    });

    const swiperThumbs2 = new Swiper(".product__slider2 .swiper-thumbs", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        direction: "vertical",

        on: {
            click: function () {
                swiperProduct.slideTo(swiperProduct2.activeIndex);
            },

        }
    });

    const swiperProduct2 = new Swiper(".product__slider2 .swiper-product", {
        slidesPerView: 1,
        lazy: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        thumbs: {
            swiper: swiperThumbs2
        },
        pagination: {
            el: '.product__slider2 .swiper-pagination',
            type: 'bullets',
            clickable: true
        },
        on: {
            slideChange: function () {
                swiperProduct.slideTo(swiperProduct2.activeIndex);
            }
        }
    });

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJzd2lwZXItaW5pdC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJjb25zdCBtYWluU2xpZGVyID0gbmV3IFN3aXBlcihcIi5tYWluLXNsaWRlclwiLCB7XG4gICAgc2xpZGVzUGVyVmlldzogMSxcbiAgICBzcGFjZUJldHdlZW46IDAsXG4gICAgc2xpZGVzUGVyR3JvdXA6IDEsXG4gICAgZWZmZWN0OiAnZmFkZScsXG4gICAgcGFyYWxsYXg6IHRydWUsXG4gICAgbG9vcDogdHJ1ZSxcbiAgICBsb29wRmlsbEdyb3VwV2l0aEJsYW5rOiBmYWxzZSxcbiAgICBzcGVlZDogNzUwLFxuICAgIGF1dG9wbGF5OiB7XG4gICAgICAgIGRlbGF5OiA3MDAwLFxuICAgICAgICBkaXNhYmxlT25JbnRlcmFjdGlvbjogZmFsc2VcbiAgICB9LFxuICAgIG5hdmlnYXRpb246IHtcbiAgICAgICAgbmV4dEVsOiBcIi5tYWluLXNsaWRlciAuc3dpcGVyLWJ1dHRvbi1uZXh0XCIsXG4gICAgICAgIHByZXZFbDogXCIubWFpbi1zbGlkZXIgLnN3aXBlci1idXR0b24tcHJldlwiXG4gICAgfSxcbiAgICBwYWdpbmF0aW9uOiB7XG4gICAgICAgIGVsOiBcIi5tYWluLXNsaWRlciAuc3dpcGVyLXBhZ2luYXRpb25cIixcbiAgICAgICAgLy8gZHluYW1pY0J1bGxldHM6IHRydWUsXG4gICAgICAgIHJlbmRlckJ1bGxldDogZnVuY3Rpb24gKGluZGV4LCBjbGFzc05hbWUpIHtcbiAgICAgICAgICAgIHJldHVybiAoJzxzcGFuIGNsYXNzPVwiJyArIGNsYXNzTmFtZSArICcgc3dpcGVyLXBhZ2luYXRpb24tYnVsbGV0LS1zdmctYW5pbWF0aW9uXCI+PHN2ZyB3aWR0aD1cIjIwXCIgaGVpZ2h0PVwiMjBcIiB2aWV3Qm94PVwiMCAwIDI4IDI4XCI+PGNpcmNsZSBjbGFzcz1cInN2Z19fY2lyY2xlXCIgY3g9XCIxNFwiIGN5PVwiMTRcIiByPVwiMTJcIiBmaWxsPVwidHJhbnNwYXJlbnRcIiBzdHJva2Utd2lkdGg9XCIyXCI+PC9jaXJjbGU+PGNpcmNsZSBjbGFzcz1cInN2Z19fY2lyY2xlLXNlY29uZFwiIGN4PVwiMTRcIiBjeT1cIjE0XCIgcj1cIjdcIiBmaWxsPVwicmVkXCIgc3Ryb2tlLXdpZHRoPVwiXCI+PC9jaXJjbGU+PC9zdmc+PC9zcGFuPicpO1xuICAgICAgICB9XG4gICAgfVxufSk7XG5cbmNvbnN0IHN3aXBlclByb2R1Y3RzQWN0dWFsID0gbmV3IFN3aXBlcihcIi5hY3R1YWwtc2xpZGVyXCIsIHtcbiAgICBzbGlkZXNQZXJWaWV3OiA0LFxuICAgIHNsaWRlc1Blckdyb3VwOiA0LFxuICAgIHNwYWNlQmV0d2VlbjogMjAsXG4gICAgbG9vcDogdHJ1ZSxcbiAgICBzcGVlZDogNzUwLFxuICAgIG5hdmlnYXRpb246IHtcbiAgICAgICAgbmV4dEVsOiBcIi5hY3R1YWwtc2xpZGVyIC5zd2lwZXItYnV0dG9uLW5leHRcIixcbiAgICAgICAgcHJldkVsOiBcIi5hY3R1YWwtc2xpZGVyIC5zd2lwZXItYnV0dG9uLXByZXZcIlxuICAgIH0sXG4gICAgcGFnaW5hdGlvbjoge1xuICAgICAgICBlbDogXCIuYWN0dWFsLXNsaWRlciAuc3dpcGVyLXBhZ2luYXRpb25cIixcbiAgICAgICAgY2xpY2thYmxlOiB0cnVlXG4gICAgfSxcbiAgICBicmVha3BvaW50czoge1xuICAgICAgICA5NDE6IHtcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDRcbiAgICAgICAgfSxcbiAgICAgICAgMzAwOiB7XG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBcImF1dG9cIixcbiAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiAxLFxuICAgICAgICB9XG4gICAgfVxufSk7XG5cbmNvbnN0IHN3aXBlclBvcHVsYXIgPSBuZXcgU3dpcGVyKFwiLnBvcHVsYXItc2xpZGVyXCIsIHtcbiAgICBzbGlkZXNQZXJWaWV3OiA0LFxuICAgIHNsaWRlc1Blckdyb3VwOiA0LFxuICAgIHNwYWNlQmV0d2VlbjogMjAsXG4gICAgbG9vcDogdHJ1ZSxcbiAgICBzcGVlZDogNzUwLFxuICAgIG5hdmlnYXRpb246IHtcbiAgICAgICAgbmV4dEVsOiBcIi5wb3B1bGFyLXNsaWRlciAuc3dpcGVyLWJ1dHRvbi1uZXh0XCIsXG4gICAgICAgIHByZXZFbDogXCIucG9wdWxhci1zbGlkZXIgLnN3aXBlci1idXR0b24tcHJldlwiXG4gICAgfSxcbiAgICBwYWdpbmF0aW9uOiB7XG4gICAgICAgIGVsOiBcIi5wb3B1bGFyLXNsaWRlciAuc3dpcGVyLXBhZ2luYXRpb25cIixcbiAgICAgICAgY2xpY2thYmxlOiB0cnVlXG4gICAgfSxcbiAgICBicmVha3BvaW50czoge1xuICAgICAgICA5NDE6IHtcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDRcbiAgICAgICAgfSxcbiAgICAgICAgMzAwOiB7XG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBcImF1dG9cIixcbiAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiAxLFxuICAgICAgICB9XG4gICAgfVxufSk7XG5cbmNvbnN0IGJhc2tldFNsaWRlciA9IG5ldyBTd2lwZXIoXCIuYmFza2V0LXNsaWRlclwiLCB7XG4gICAgc2xpZGVzUGVyVmlldzogNCxcbiAgICBzbGlkZXNQZXJHcm91cDogNCxcbiAgICBzcGFjZUJldHdlZW46IDIwLFxuICAgIGxvb3A6IHRydWUsXG4gICAgc3BlZWQ6IDc1MCxcbiAgICBuYXZpZ2F0aW9uOiB7XG4gICAgICAgIG5leHRFbDogXCIuYmFza2V0LXNsaWRlciAuc3dpcGVyLWJ1dHRvbi1uZXh0XCIsXG4gICAgICAgIHByZXZFbDogXCIuYmFza2V0LXNsaWRlciAuc3dpcGVyLWJ1dHRvbi1wcmV2XCJcbiAgICB9LFxuICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgZWw6IFwiLmJhc2tldC1zbGlkZXIgLnN3aXBlci1wYWdpbmF0aW9uXCIsXG4gICAgICAgIGNsaWNrYWJsZTogdHJ1ZVxuICAgIH0sXG4gICAgYnJlYWtwb2ludHM6IHtcbiAgICAgICAgOTQxOiB7XG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiA0XG4gICAgICAgIH0sXG4gICAgICAgIDMwMDoge1xuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogXCJhdXRvXCIsXG4gICAgICAgICAgICBzbGlkZXNQZXJHcm91cDogMSxcbiAgICAgICAgfVxuICAgIH1cbn0pO1xuXG5pZiAod2luZG93LmlubmVyV2lkdGggPD0gOTQwKSB7XG4gICAgY29uc3Qgc3dpcGVyQmxvZyA9IG5ldyBTd2lwZXIoXCIuYmxvZy1zbGlkZXJcIiwge1xuICAgICAgICBzbGlkZXNQZXJWaWV3OiBcImF1dG9cIixcbiAgICAgICAgc2xpZGVzUGVyR3JvdXA6IDEsXG4gICAgICAgIGxvb3A6IHRydWUsXG4gICAgICAgIHNwZWVkOiA3NTAsXG4gICAgICAgIGJyZWFrcG9pbnRzOiB7XG4gICAgICAgICAgICAwOiB7XG4gICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogXCJhdXRvXCIsXG4gICAgICAgICAgICAgICAgbG9vcDogdHJ1ZSxcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSxcbiAgICAgICAgbmF2aWdhdGlvbjoge1xuICAgICAgICAgICAgbmV4dEVsOiBcIi5ibG9nLXNsaWRlciAuc3dpcGVyLWJ1dHRvbi1uZXh0XCIsXG4gICAgICAgICAgICBwcmV2RWw6IFwiLmJsb2ctc2xpZGVyIC5zd2lwZXItYnV0dG9uLXByZXZcIlxuICAgICAgICB9LFxuICAgICAgICBwYWdpbmF0aW9uOiB7XG4gICAgICAgICAgICBlbDogXCIuYmxvZy1zbGlkZXIgLnN3aXBlci1wYWdpbmF0aW9uXCIsXG4gICAgICAgICAgICBjbGlja2FibGU6IHRydWVcbiAgICAgICAgfSxcbiAgICB9KTtcbn1cblxuXG5jb25zdCBhcnRpY2xlc1NsaWRlciA9IG5ldyBTd2lwZXIoXCIuYXJ0aWNsZXMtc2xpZGVyXCIsIHtcbiAgICBzbGlkZXNQZXJWaWV3OiA0LFxuICAgIHNsaWRlc1Blckdyb3VwOiAxLFxuICAgIHNwYWNlQmV0d2VlbjogMjAsXG4gICAgLy8gbG9vcDogdHJ1ZSxcbiAgICBzcGVlZDogNzUwLFxuICAgIGJyZWFrcG9pbnRzOiB7XG4gICAgICAgIDk0MToge1xuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogNCxcbiAgICAgICAgfSxcbiAgICAgICAgNzAxOiB7XG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAzLFxuICAgICAgICB9LFxuICAgICAgICAwOiB7XG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBcImF1dG9cIixcbiAgICAgICAgfSxcbiAgICB9LFxuICAgIG5hdmlnYXRpb246IHtcbiAgICAgICAgbmV4dEVsOiBcIi5hcnRpY2xlcy1zbGlkZXIgLnN3aXBlci1idXR0b24tbmV4dFwiLFxuICAgICAgICBwcmV2RWw6IFwiLmFydGljbGVzLXNsaWRlciAuc3dpcGVyLWJ1dHRvbi1wcmV2XCJcbiAgICB9LFxuICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgZWw6IFwiLmFydGljbGVzLXNsaWRlciAuc3dpcGVyLXBhZ2luYXRpb25cIixcbiAgICAgICAgY2xpY2thYmxlOiB0cnVlXG4gICAgfSxcbn0pO1xuXG5cbmlmICh3aW5kb3cuaW5uZXJXaWR0aCA8PSA5NDApIHtcbiAgICBjb25zdCBzd2lwZXJBcnRpY2xlID0gbmV3IFN3aXBlcihcIi5hcnRpY2xlLXNsaWRlclwiLCB7XG4gICAgICAgIHNsaWRlc1BlclZpZXc6IDMsXG4gICAgICAgIHNwYWNlQmV0d2VlbjogMjAsXG4gICAgICAgIHNsaWRlc1Blckdyb3VwOiAxLFxuICAgICAgICBsb29wOiB0cnVlLFxuICAgICAgICBzcGVlZDogNzUwLFxuICAgICAgICBuYXZpZ2F0aW9uOiB7XG4gICAgICAgICAgICBuZXh0RWw6IFwiLmFydGljbGUtc2xpZGVyIC5zd2lwZXItYnV0dG9uLW5leHRcIixcbiAgICAgICAgICAgIHByZXZFbDogXCIuYXJ0aWNsZS1zbGlkZXIgLnN3aXBlci1idXR0b24tcHJldlwiXG4gICAgICAgIH0sXG4gICAgICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgICAgIGVsOiBcIi5hcnRpY2xlLXNsaWRlciAuc3dpcGVyLXBhZ2luYXRpb25cIixcbiAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZVxuICAgICAgICB9LFxuICAgICAgICBicmVha3BvaW50czoge1xuICAgICAgICAgICAgNzAxOiB7XG4gICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMyxcbiAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IDIwLFxuICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiAxLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIDA6IHtcbiAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBcImF1dG9cIixcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH0pO1xufVxuXG5cblxuY29uc3Qgc3dpcGVyVGhyZWUgPSBuZXcgU3dpcGVyKCcuc3dpcGVyLXRocmVlJywge1xuICAgIHNwYWNlQmV0d2VlbjogMjAsXG4gICAgc2xpZGVzUGVyVmlldzogMyxcbiAgICBsb29wOiB0cnVlLFxuICAgIGJyZWFrcG9pbnRzOiB7XG4gICAgICAgIDcwMToge1xuICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiAyMCxcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDMsXG4gICAgICAgIH0sXG4gICAgICAgIDA6IHtcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IFwiYXV0b1wiLFxuICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IDEsXG4gICAgICAgIH1cbiAgICB9XG59KTtcblxuY29uc3Qgc3dpcGVyVGhyZWVOZXdzID0gbmV3IFN3aXBlcignLnN3aXBlci10aHJlZS1uZXdzJywge1xuICAgIHNwYWNlQmV0d2VlbjogMjAsXG4gICAgc2xpZGVzUGVyVmlldzogMyxcbiAgICAvLyBsb29wOiB0cnVlLFxuICAgIGJyZWFrcG9pbnRzOiB7XG4gICAgICAgIDcwMToge1xuICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiAyMCxcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDMsXG4gICAgICAgIH0sXG4gICAgICAgIDA6IHtcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IFwiYXV0b1wiLFxuICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IDEsXG4gICAgICAgIH1cbiAgICB9XG59KTtcblxuY29uc3Qgc3dpcGVyVGh1bWJzID0gbmV3IFN3aXBlcihcIi5wcm9kdWN0X19zbGlkZXIgLnN3aXBlci10aHVtYnNcIiwge1xuICAgIHNwYWNlQmV0d2VlbjogMTAsXG4gICAgc2xpZGVzUGVyVmlldzogNCxcbiAgICBmcmVlTW9kZTogdHJ1ZSxcbiAgICB3YXRjaFNsaWRlc1Byb2dyZXNzOiB0cnVlLFxuICAgIGRpcmVjdGlvbjogXCJ2ZXJ0aWNhbFwiLFxuICAgIG9uOiB7XG4gICAgICAgIGNsaWNrOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBzd2lwZXJQcm9kdWN0Mi5zbGlkZVRvKHN3aXBlclByb2R1Y3QuYWN0aXZlSW5kZXgpO1xuICAgICAgICB9LFxuXG4gICAgfVxufSk7XG5cbmNvbnN0IHN3aXBlclByb2R1Y3QgPSBuZXcgU3dpcGVyKFwiLnByb2R1Y3RfX3NsaWRlciAuc3dpcGVyLXByb2R1Y3RcIiwge1xuICAgIHNsaWRlc1BlclZpZXc6IDEsXG4gICAgbGF6eTogdHJ1ZSxcbiAgICBlZmZlY3Q6ICdmYWRlJyxcbiAgICBmYWRlRWZmZWN0OiB7XG4gICAgICAgIGNyb3NzRmFkZTogdHJ1ZVxuICAgIH0sXG4gICAgdGh1bWJzOiB7XG4gICAgICAgIHN3aXBlcjogc3dpcGVyVGh1bWJzXG4gICAgfSxcbiAgICBwYWdpbmF0aW9uOiB7XG4gICAgICAgIGVsOiAnLnN3aXBlci1wcm9kdWN0IC5zd2lwZXItcGFnaW5hdGlvbicsXG4gICAgICAgIHR5cGU6ICdidWxsZXRzJyxcbiAgICAgICAgY2xpY2thYmxlOiB0cnVlLFxuICAgIH0sXG4gICAgb246IHtcbiAgICAgICAgc2xpZGVDaGFuZ2U6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHN3aXBlclByb2R1Y3QyLnNsaWRlVG8oc3dpcGVyUHJvZHVjdC5hY3RpdmVJbmRleCk7XG4gICAgICAgIH1cbiAgICB9XG59KTtcblxuY29uc3Qgc3dpcGVyVGh1bWJzMiA9IG5ldyBTd2lwZXIoXCIucHJvZHVjdF9fc2xpZGVyMiAuc3dpcGVyLXRodW1ic1wiLCB7XG4gICAgc3BhY2VCZXR3ZWVuOiAxMCxcbiAgICBzbGlkZXNQZXJWaWV3OiA0LFxuICAgIGZyZWVNb2RlOiB0cnVlLFxuICAgIHdhdGNoU2xpZGVzUHJvZ3Jlc3M6IHRydWUsXG4gICAgZGlyZWN0aW9uOiBcInZlcnRpY2FsXCIsXG5cbiAgICBvbjoge1xuICAgICAgICBjbGljazogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgc3dpcGVyUHJvZHVjdC5zbGlkZVRvKHN3aXBlclByb2R1Y3QyLmFjdGl2ZUluZGV4KTtcbiAgICAgICAgfSxcblxuICAgIH1cbn0pO1xuXG5jb25zdCBzd2lwZXJQcm9kdWN0MiA9IG5ldyBTd2lwZXIoXCIucHJvZHVjdF9fc2xpZGVyMiAuc3dpcGVyLXByb2R1Y3RcIiwge1xuICAgIHNsaWRlc1BlclZpZXc6IDEsXG4gICAgbGF6eTogdHJ1ZSxcbiAgICBlZmZlY3Q6ICdmYWRlJyxcbiAgICBmYWRlRWZmZWN0OiB7XG4gICAgICAgIGNyb3NzRmFkZTogdHJ1ZVxuICAgIH0sXG4gICAgdGh1bWJzOiB7XG4gICAgICAgIHN3aXBlcjogc3dpcGVyVGh1bWJzMlxuICAgIH0sXG4gICAgcGFnaW5hdGlvbjoge1xuICAgICAgICBlbDogJy5wcm9kdWN0X19zbGlkZXIyIC5zd2lwZXItcGFnaW5hdGlvbicsXG4gICAgICAgIHR5cGU6ICdidWxsZXRzJyxcbiAgICAgICAgY2xpY2thYmxlOiB0cnVlXG4gICAgfSxcbiAgICBvbjoge1xuICAgICAgICBzbGlkZUNoYW5nZTogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgc3dpcGVyUHJvZHVjdC5zbGlkZVRvKHN3aXBlclByb2R1Y3QyLmFjdGl2ZUluZGV4KTtcbiAgICAgICAgfVxuICAgIH1cbn0pO1xuIl0sImZpbGUiOiJzd2lwZXItaW5pdC5qcyJ9

});