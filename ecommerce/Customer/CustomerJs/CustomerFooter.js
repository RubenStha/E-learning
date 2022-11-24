const createFooter = () =>{
    let footer = document.querySelector('footer');
    footer.innerHTML = `
    <div class="footer-content">
            <img src="img/light-logo.png" class="logo" alt="">
        <div class="footer-ul-container">
            <ul class="category">
                <li class="category-title">Men</li>
                <li><a href="#" class="footer-link">t-shirt</a></li>
                <li><a href="#" class="footer-link">Shirts</a></li>
                <li><a href="#" class="footer-link">Jeans</a></li>
                <li><a href="#" class="footer-link">Shoes</a></li>
                <li><a href="#" class="footer-link">Casuals</a></li>
                <li><a href="#" class="footer-link">Casuals</a></li>
                <li><a href="#" class="footer-link">Casuals</a></li>
                <li><a href="#" class="footer-link">Casuals</a></li>
            </ul>
            <ul class="category">
                <li class="category-title">Women</li>
                <li><a href="#" class="footer-link">t-shirt</a></li>
                <li><a href="#" class="footer-link">Shirts</a></li>
                <li><a href="#" class="footer-link">Jeans</a></li>
                <li><a href="#" class="footer-link">Shoes</a></li>
                <li><a href="#" class="footer-link">Casuals</a></li>
                <li><a href="#" class="footer-link">Casuals</a></li>
                <li><a href="#" class="footer-link">Casuals</a></li>
                <li><a href="#" class="footer-link">Casuals</a></li>
            </ul>
        </div>
    </div>
    <p class="footer-title">About Company</p>
    <p class="info">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi consectetur fugiat vero, ipsa facere pariatur amet, natus aliquid neque, eveniet expedita. Consectetur hic ea veniam provident odit fuga impedit est, voluptatem distinctio a esse exercitationem laborum expedita maxime modi. Reiciendis enim perferendis, suscipit sint quisquam adipisci expedita dignissimos hic similique dolorum velit illum odit voluptas non temporibus impedit, sunt facilis? Repudiandae, fuga ipsa hic aliquid, beatae delectus praesentium ab debitis commodi similique ea architecto maiores! Sint, alias delectus unde impedit porro repellendus optio, hic veritatis laboriosam dolores, incidunt debitis quod officiis. Sint quam ea accusamus recusandae ducimus quibusdam illum nemo.
    </p>
    <p class="info">support emails - help@clohing.com, customersupport@clothing.com</p>
        <div class="footer-social-container">
            <div>
                <a href="#" class="social-link">Terms & Service</a>
                <a href="#" class="social-link">Privacy page</a>
            </div>
            <div>
                <a href="#" class="social-link">instagam</a>
                <a href="#" class="social-link">facebook</a>
                <a href="#" class="social-link">twitter</a>
                <a href="#" class="social-link">linked in</a>
            </div>
        </div>
        <p class="footer-credit">Clothing, Best apparels online store</p>
    
    `;
}
createFooter();