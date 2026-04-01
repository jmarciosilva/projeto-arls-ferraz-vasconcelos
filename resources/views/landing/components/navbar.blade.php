   <!-- header-start -->
   <header>
       <div class="header-area ">
           <div id="sticky-header" class="main-header-area">
               <div class="container-fluid p-0">
                   <div class="row align-items-center no-gutters">
                       <div class="col-xl-5 col-lg-6">
                           <div class="main-menu  d-none d-lg-block">
                               <nav>
                                   <ul id="navigation">
                                       <li><a class="active" href="{{ url('/') }}">home</a></li>
                                       <li><a  href="{{ url('/noticias') }}">Notícias</a></li>
                                       <li><a href="#">Maçonaria <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="{{ url('/maconaria') }}">O que é Maçonaria ?</a></li>
                                            <li><a href="{{ url('/maconaria-jovens') }}">Maçonaria para Jovens</a></li>
                                            <li><a href="{{ url('/mudar-cidadao') }}">Como a Maçonaria pode mudar um cidadão ?</a></li>
                                        </ul>
                                    </li>
                                       <li><a href="{{ url('/sobre-nos') }}">Sobre Nós</a></li>
                                       {{-- <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                           <ul class="submenu">
                                               <li><a href="blog.html">blog</a></li>
                                               <li><a href="single-blog.html">single-blog</a></li>
                                           </ul>
                                       </li> --}}

                                       {{-- <li><a href="contact.html">Contact</a></li> --}}
                                   </ul>
                               </nav>
                           </div>
                       </div>
                       <div class="col-xl-2 col-lg-2">
                           <div class="logo-img">
                               <a  href="{{ url('/') }}">
                                   <img src="{{ asset('img/logo2.png') }}" alt="">
                               </a>
                           </div>
                       </div>
                       <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                           <div class="book_room">
                               <div class="socail_links">
                                   <ul>
                                       <li>
                                           <a href="#">
                                               <i class="fa fa-facebook-square"></i>
                                           </a>
                                       </li>
                                       <li>
                                           <a href="#">
                                               <i class="fa fa-twitter"></i>
                                           </a>
                                       </li>
                                       <li>
                                           <a href="#">
                                               <i class="fa fa-instagram"></i>
                                           </a>
                                       </li>
                                   </ul>
                               </div>
                               <div class="book_btn d-none d-lg-block">
                                   <a href="{{ route('admin.login') }}">Área Restrita</a>
                               </div>
                           </div>
                       </div>
                       <div class="col-12">
                           <div class="mobile_menu d-block d-lg-none"></div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </header>
   <!-- header-end -->
