 <!-- footer -->
 <footer class="footer">
     <div class="footer_top">
         <div class="container">
             <div class="row">
                 <div class="col-xl-4 col-md-6 col-lg-4">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Nosso Endereço
                         </h3>
                         <p class="footer_text">  Rua Sebastião Souza Lemos, 240 - Bairro Jardim Pérola, CEP 08544-440 - Ferraz de Vasconcelos - S.P.</p>

                     </div>
                 </div>
                 <div class="col-xl-4 col-md-6 col-lg-4">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Nossas Reuniões
                         </h3>
                         <p class="footer_text">Nossas Reuniões são sempre na Primeira, Segunda e Terceira Quinta-feira de cada mês</p>
                     </div>
                 </div>
                 <div class="col-xl-4 col-md-6 col-lg-4">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Navegação
                         </h3>
                         <ul>
                             <li><a href="{{ url('/') }}">Home</a></li>
                             <li><a href="{{ url('/maconaria-jovens') }}">O que é Maçonaria ?</a></li>
                             <li><a href="{{ url('/mudar-cidadao') }}">Como a Maçonaria pode mudar um cidadão ?</a></li>
                             <li><a href="{{ url('/sobre-nos') }}">Sobre Nós</a></li>
                         </ul>
                     </div>
                 </div>
                 {{-- <div class="col-xl-4 col-md-6 col-lg-4">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Newsletter
                         </h3>
                         <form action="#" class="newsletter_form">
                             <input type="text" placeholder="Enter your mail">
                             <button type="submit">Sign Up</button>
                         </form>
                         <p class="newsletter_text">Subscribe newsletter to get updates</p>
                     </div>
                 </div> --}}
             </div>
         </div>
     </div>
     <div class="copy-right_text">
         <div class="container">
             <div class="footer_border"></div>
             <div class="row">
                 <div class="col-xl-8 col-md-7 col-lg-9">
                     <p class="copy_right">
                         <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                         Copyright &copy;
                         <script>
                             document.write(new Date().getFullYear());
                         </script> Todos os direitos reservados | Este Site foi feito com <i
                             class="fa fa-heart-o" aria-hidden="true"></i> por <a href="https://jmfsystem.com"
                             target="_blank">José Márcio</a>
                         <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 </div>
                 <div class="col-xl-4 col-md-5 col-lg-3">
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
                 </div>
             </div>
         </div>
     </div>
 </footer>

 <!-- link that opens popup -->

 <!-- form itself end-->
 <form id="test-form" class="white-popup-block mfp-hide">
     <div class="popup_box ">
         <div class="popup_inner">
             <h3>Check Availability</h3>
             <form action="#">
                 <div class="row">
                     <div class="col-xl-6">
                         <input id="datepicker" placeholder="Check in date">
                     </div>
                     <div class="col-xl-6">
                         <input id="datepicker2" placeholder="Check out date">
                     </div>
                     <div class="col-xl-6">
                         <select class="form-select wide" id="default-select" class="">
                             <option data-display="Adult">1</option>
                             <option value="1">2</option>
                             <option value="2">3</option>
                             <option value="3">4</option>
                         </select>
                     </div>
                     <div class="col-xl-6">
                         <select class="form-select wide" id="default-select" class="">
                             <option data-display="Children">1</option>
                             <option value="1">2</option>
                             <option value="2">3</option>
                             <option value="3">4</option>
                         </select>
                     </div>
                     <div class="col-xl-12">
                         <select class="form-select wide" id="default-select" class="">
                             <option data-display="Room type">Room type</option>
                             <option value="1">Laxaries Rooms</option>
                             <option value="2">Deluxe Room</option>
                             <option value="3">Signature Room</option>
                             <option value="4">Couple Room</option>
                         </select>
                     </div>
                     <div class="col-xl-12">
                         <button type="submit" class="boxed-btn3">Check Availability</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </form>
 <!-- form itself end -->

 <!-- JS here -->
 <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
 <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
 <script src="{{ asset('js/popper.min.js') }}"></script>
 <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
 <script src="{{ asset('js/ajax-form.js') }}"></script>
 <script src="{{ asset('js/waypoints.min.js') }}"></script>
 <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
 <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
 <script src="{{ asset('js/scrollIt.js') }}"></script>
 <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
 <script src="{{ asset('js/wow.min.js') }}"></script>
 <script src="{{ asset('js/nice-select.min.js') }}"></script>
 <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
 <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
 <script src="{{ asset('js/plugins.js') }}"></script>
 <script src="{{ asset('js/gijgo.min.js') }}"></script>

 <!--contact js-->
 <script src="{{ asset('js/contact.js') }}"></script>
 <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
 <script src="{{ asset('js/jquery.form.js') }}"></script>
 <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
 <script src="{{ asset('js/mail-script.js') }}"></script>

 <script src="{{ asset('js/main.js') }}"></script>
 <script>
     $('#datepicker').datepicker({
         iconsLibrary: 'fontawesome',
         icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
     });
     $('#datepicker2').datepicker({
         iconsLibrary: 'fontawesome',
         icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }

     });
 </script>



 </body>

 </html>
