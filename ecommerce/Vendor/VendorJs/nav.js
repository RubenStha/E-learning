const createNav = ()=>{
    let nav = document.querySelector('.nav');
    nav.innerHTML = `
    <div class="body">
        <div class="nav">
            <h2 class="logo">
                logo
            </h2>
            <ul class="ul-links">
                <li class="link"> <img src="icon dashboard.png" alt="">   <a href="#">Dashboard</a> </li>
                <li class="link"><img src="icon order.png" alt=""> <a href="productlist.php">Product</a> </li>
                <li class="link"><img src="icon transcation.png" alt=""> <a href="order.php">Order</a> </li>
                <li class="link"><img src="home.png" alt=""> <a href="sales.php">Sales</a> </li>
                <li class="link"><img src="money.png" alt=""> <a href="transcation.php">Transactions</a> </li>
                <li class="link"><img src="home.png" alt=""> <a href="addproduct.php">Add Product</a> </li>
                <li class="link"><img src="home.png" alt=""> <a href="addcategory.php">Add Category</a> </li>
                <li class="link"><img src="home.png" alt=""> <a href="../../login/LoginPhp/logout.php">log out</a> </li>
            </ul>
        </div>
    
    `;

}
createNav();