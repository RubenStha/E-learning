const createNav = () =>{
    let nav = document.querySelector('.navbar');
    nav.innerHTML = `
    <div class="nav">
            <img src="img/arrow.png" class="brand-logo" alt="image of logo">
            <div class="nav-item">
                <div class="search">
                    <input type="text" class="search-box" placeholder="search brand, product">
                    <button class="search-btn">Search</button>
                </div>
                <a href=""><img src="img/user.png" alt=""></a>
                <a href="cart.php"><img src="img/cart.png" alt=""></a>
            </div>
        
            </div>  
            <ul class="links-container">
                <li class="link-item"><a href="#" class="link">Home</a></li>
                <li class="link-item"><a href="#" class="link">Women</a></li>
                <li class="link-item"><a href="#" class="link">Men</a></li>
                <li class="link-item"><a href="#" class="link">Kid</a></li>
                <li class="link-item"><a href="#" class="link">Accessories</a></li>
            </ul>
    `;
}

createNav();