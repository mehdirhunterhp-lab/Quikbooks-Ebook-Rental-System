document.addEventListener('DOMContentLoaded', () => {
    let lastScrollTop = 0;
    const header = document.getElementById('header');
    const hamburger = document.getElementById('hamburger');

    window.addEventListener('scroll', () => {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop) {
            // Scrolling down
            header.classList.add('hidden');
            hamburger.style.display = 'block';
        } else {
            // Scrolling up
            header.classList.remove('hidden');
            hamburger.style.display = 'none';
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
    });
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function searchCars() {
    const name = document.getElementById('searchName').value.toLowerCase();
    const price = parseFloat(document.getElementById('searchPrice').value) || Infinity;
    const year = parseInt(document.getElementById('searchYear').value) || 0;
    const mileage = parseInt(document.getElementById('searchMileage').value) || Infinity;
    const condition = document.getElementById('searchCondition').value.toLowerCase();
    
    const cars = document.querySelectorAll('.car');

    cars.forEach(car => {
        const carName = car.dataset.name.toLowerCase();
        const carPrice = parseFloat(car.dataset.price);
        const carYear = parseInt(car.dataset.year);
        const carMileage = parseInt(car.dataset.mileage);
        const carCondition = car.dataset.condition.toLowerCase();

        if (
            (name === '' || carName.includes(name)) &&
            (price === Infinity || carPrice <= price) &&
            (year === 0 || carYear === year) &&
            (mileage === Infinity || carMileage <= mileage) &&
            (condition === '' || carCondition.includes(condition))
        ) {
            car.style.display = 'block';
        } else {
            car.style.display = 'none';
        }
    });
}

