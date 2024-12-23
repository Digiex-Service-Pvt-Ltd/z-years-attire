(function () {
    let defineLibrary = () => ({

        init: function (init) {

            let container = document.querySelector(init.container);
            let firstImage = document.querySelector(init.imageClass);
            let allImages = document.querySelectorAll(init.imageClass);
            let zoomedElement = document.querySelector(init.zoomedClass);
            let zoomElementCoordinate = zoomedElement.getBoundingClientRect();
            console.log(zoomedElement);

            if (!container) {
                console.error(`please add ${init.container} element`);
                return;
            }
            if (!firstImage) {
                console.error(`please add ${init.firstImage} element`);
                return;
            }
            if (!zoomedElement) {
                console.error(`please add ${init.zoomedClass} element`);
                return;
            }

            zoomedElement.style.backgroundImage = `url(${firstImage.src})`;
            zoomedElement.style.backgroundSize = 'cover';

            allImages.forEach(image => {
                image.addEventListener('click', function () {
                    zoomedElement.style.backgroundImage = `url(${image.src})`;
                })
            })

            zoomedElement.addEventListener('mouseenter', function () {
                this.style.backgroundSize = '150%';
            })

            zoomedElement.addEventListener('mousemove', function (e) {
                let x = e.clientX - zoomElementCoordinate.left;
                let y = e.clientY - zoomElementCoordinate.top;

                x = Math.round(100 / (zoomElementCoordinate.width / x))
                y = Math.round(100 / (zoomElementCoordinate.width / y))

                this.style.backgroundPosition = `${x}% ${y}%`;
            })

            zoomedElement.addEventListener('mouseleave', function () {
                this.style.backgroundSize = 'cover';
            })

        }
    })

    if (typeof imageZoom == 'undefined') {
        window.imageZoom = defineLibrary();
    } else {
      
    }
}
)();

imageZoom.init({
    container: '#gallery-box',
    imageClass: '.thumb',
    zoomedClass: '.zoomed-image'
});