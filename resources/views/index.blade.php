@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>California</title>
</head>
<body>
   <header>
        <div class="Search-line">
            <div class="Block-California">
                <p class="California-Vector">
                    <img src="{{ asset('images/california.svg') }}" alt="CALIFORNIA" />
                </p>
            </div>
            <div class="Block_list_of_links">
                <nav>
                    <ul class="List_of_links">
                        <li class="li_link"><a class="link" href="#ALL_PRODUCTS">ALL PRODUCTS</a></li>
                        <li class="li_link"><a class="link" href="#LOOKING_SCROLL">SOLUTIONS ↷</a></li>
                        <li class="li_link"><a class="link" href="#OFFERS">ABOUT</a></li>
                        <li class="li_link"><a class="link" href="#FOOTER">SUPPORT</a></li>
                        
                        <!-- Authentication Links -->
                        @auth
                            <li class="li_link">
                                <a class="register-sign" href="#">Hello, {{ auth()->user()->name }}</a>
                            </li>
                            <li class="li_link">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="logoutbtn">LOGOUT</button>
                                </form>
                            </li>
                        @else
                            <li class="li_link">
                                <a class="register-sign" href="{{ route('register') }}">REGISTER</a>
                            </li>
                            <li class="li_link">
                                <a class="register-sign" href="{{ route('login') }}">SIGN-IN</a>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
            <div class="Block_images">
                <form action="{{ route('search.perform') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; padding:0;">
                        <img class="image-of-searh_figure" src="{{ asset('images/IMAGE-search.svg') }}" alt="search">
                    </button>
                </form>

                <a href="{{ route('cart.index') }}" class="register-sign">
                    <img class="image-of-shop_basket" src="{{ asset('images/IMAGEShop.svg') }}" alt="basket">
                </a>
            </div>
        </div>
    </header>
   
   <main>
        <div class="News-feed">
            <img class="arrow1" src="{{ asset('images/VectorLeft.svg') }}" alt="arrow">
            <div class="first-block-in-feed">
                <div class="Block-of-text-of-feed">
                    <p class="Main-text-of-feed">The new phones are here take a look.</p>
                    <p class="Subtext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque in est dui, aliquam, tempor. Faucibus morbi turpis.</p>
                </div>
                <div class="Button_Explore">Explore</div>
                <div class="main-block">
                    <div class="first"></div>
                    <div class="second"></div>
                    <div class="third"></div>
                </div>
            </div>
            <div class="second-block-in-feed">
                <img src="{{ asset('images/IMAGE-IPHONE.svg') }}" alt="Phones">
                <img class="arrow2" src="{{ asset('images/VectorRight.svg') }}" alt="arrow">
            </div>
        </div>
        <div id="ALL_PRODUCTS">
            <div>
                <p class="Main-text-of-id">Shop our latest offers and categories</p>
                <p class="Subtext-of-id">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque in est dui, aliquam, tempor. Faucibus morbi turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="First-Block-of-Frames">
                <div class="Frame-of-laptop">
                    <img src="{{ asset('images/IMAGE-Laptop.svg') }}" alt="Laptop">
                    <p class="Laptops-paragraf_1">Laptops</p>
                    <p class="Laptops-paragraf_2">True Laptop</p>
                    <p class="Laptops-paragraf_3">Solution</p>
                </div>
                <div class="Frame-of-watch">
                    <img src="{{ asset('images/IMAGE-Watch.svg') }}" alt="Watch">
                    <p class="Watch-paragraf-1">Watch</p>
                    <p class="Watch_paragraf_2">Not just</p>
                    <p class="Watch-paragraf_3">stylisht</p>
                </div>
            </div>
            <div class="Second-Block-of-Frames">
                <div class="Frame-of-phones">
                    <img src="{{ asset('images/IMAGE-Phone.svg') }}" alt="Phone">
                    <p class="Phone-paragraf-1">Phones</p>
                    <p class="Phone-paragraf-2">Your day to day life</p>
                </div>
                <div class="Frame-of-tablet">
                    <p class="Tablet-paragraf-1">Tablet</p>
                    <p class="Tablet-paragraf-2">Empower your work</p>
                    <img src="{{ asset('images/IMAGE-Tablet.svg') }}" alt="Tablet">
                </div>
            </div>
        </div> 
        <div id="SAVE">
            <div>
                <p class="Main-text-of-id">Save on our most selled items.</p>
                <p class="Subtext-of-id">Our new Limited Edition Winter Design BESPOKE 4-Door Flex™</p>
            </div>
            <div class="Third-Block-of-Frames">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img class="cart-table" src="{{ $product->image ?? asset('images/default.svg') }}" alt="{{ $product->name }}">
                        <div class="cart-total">
                            <h3 class="name">{{ $product->name }}</h3>
                            <p class="description">{{ Str::limit($product->description, 80) }}</p>
                            <p class="price">${{ number_format($product->price, 2) }} USD</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="OFFERS">
            <div>
                <p class="Main-text-of-id">See the best around here</p>
                <p class="Subtext-of-id">Our new Limited Edition Winter Design BESPOKE 4-Door Flex™</p>
            </div>
            <div class="Fourth-Block-of-Frames">
                <div class="Offer-block">
                    <p class="Paragraf-name">Smart light bulb pack</p>
                    <p class="Paragraf-discription">Latest and gratest</p>
                    <div class="Offer-button">Explore</div>
                    <img class="Offer-img" src="{{ asset('images/appleWatch.svg') }}" alt="Apple Watch">
                </div>
                <div class="Offer-block">
                    <p class="Paragraf-name">Smart light bulb pack</p>
                    <p class="Paragraf-discription">Best selling</p>
                    <div class="Offer-button">Explore</div>
                    <img class="Offer-img" src="{{ asset('images/Laptop+phone.svg') }}" alt="Combo">
                </div>
                <div class="Offer-block">
                    <p class="Paragraf-name">Smart light bulb pack</p>
                    <p class="Paragraf-discription">Every product</p>
                    <div class="Offer-button">Explore</div>
                    <img class="Offer-img" src="{{ asset('images/Laptop+phone2.svg') }}" alt="Combo">
                </div>
            </div>
        </div>
        <div id="IDEAS">
            <div>
                <p class="Main-text-of-id">Ideas have a place here</p>
                <p class="Subtext-of-id">Our new Limited Edition Winter Design BESPOKE 4-Door Flex™</p>
            </div>
            <div class="Frame-of-ideas">
                <img class="img-of-ideas" src="{{ asset('images/IMAGE-book.svg') }}" alt="Book">
                <div class="Sentenses-of-ideas">
                    <p class="ideas-paragraf">We Make It Easy To Find The Great Design Talent, Easier...</p>
                    <p class="ideas-paragraf">Road Design Handbook For The International Road...</p>
                    <p class="ideas-paragraf">The Best Kept Secrets About Creative People</p>
                    <p class="ideas-paragraf">We Make It Easy To Find The Great Design Talent, Easier...</p>
                    </div>  
                <p class="p_See_all">See All</p>
                <img class="img_See_all" src="{{ asset('images/See-All-arrow.svg') }}" alt="Arrow">
            </div>
        </div>
        <div id="LOOKING_SCROLL">
            <div>
                <p class="Main-text-of-id">Looking for anything else?</p>
            </div>
            <form class="Form-of-divs-looking" action="{{ route('search.perform') }}" method="POST">
                @csrf
                <label for="looking-line">
                    <img class="img_form" src="{{ asset('images/IMAGE-search.svg') }}" alt="Search">
                </label>
                <input id="looking-line" name="search" placeholder="Search keyword" type="text">
            </form>

            <div id="message"></div>
            <div class="First_Block-of-Frequent_queries">
                <div class="Frequent_queries">iPhone</div>
                <div class="Frequent_queries">Charger</div>
                <div class="Frequent_queries">Gift</div>
                <div class="Frequent_queries">Google Pixel 3</div>
                <div class="Frequent_queries">Keyboard</div>
            </div>
            <div class="Second_Block-of-Frequent_queries">
                <div class="Frequent_queries">13 Pro Max</div>
                <div class="Frequent_queries">iPhone 12</div>
                <div class="Frequent_queries">Laptop</div>
                <div class="Frequent_queries">Mobile</div>
            </div>
        </div>
    </main>

   <footer>
        <div id="FOOTER">
            <div class="under-footer-block">
                <div class="first-div-under-footer">
                    <img src="{{ asset('images/california.svg') }}" alt="California">
                    <p>Sign up for texts to be notified about our best offers on the perfect gifts.</p>
                </div>
                <div class="second-div-under-footer">
                    <table class="footer-table">
                        <tr>
                            <th>All products</th>
                            <th>Company</th>
                            <th>Support</th>
                            <th>Follow Us</th>
                        </tr>
                        <tr>
                            <td>Phones</td>
                            <td>About</td>
                            <td>Style Guide</td>
                            <td>Instagram</td>
                        </tr>
                        <tr>
                            <td>Watch</td>
                            <td>Support</td>
                            <td>Licensing</td>
                            <td>Facebook</td>
                        </tr>
                        <tr>
                            <td>Tablet</td>
                            <td></td>
                            <td>Change Log</td>
                            <td>LinkedIn</td>
                        </tr>
                        <tr>
                            <td>Laptops</td>
                            <td></td>
                            <td>Contact</td>
                            <td>Youtube</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="under-footer-block-2">
                <p class="paragraf-1">Made By: Krystyna Lopatych</p>
                <img class="p-arrow-1" src="{{ asset('images/arrow.svg') }}" alt="arrow">
                <img class="p-arrow-2" src="{{ asset('images/arrow.svg') }}" alt="arrow">
                <p class="paragraf-2">Powered by: Webflow</p>
            </div>
        </div>
   </footer>
</body>
</html>