    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">CONTACT US</h2>
                <p class="text-center wow fadeInDown">We'd like to hear from you!</p>
            </div>
            
            <div class="row">        
            <div class="col-sm-12">
            
            <form action="{{url('contact')}}" method="post" name="contact-form" id="main-contact-form">
                                <div class="form-group">
                                    <input type="text" required placeholder="Name" class="form-control" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <input type="email" required placeholder="Email" class="form-control" name="email" id="email">
                                </div>
                                <div class="form-group">
                                    <input type="text" required placeholder="Subject" class="form-control" name="subject" id="subject">
                                </div>
                                <div class="form-group">
                                    <textarea required placeholder="Message" rows="8" class="form-control" name="message" id="message"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">SEND MESSAGE</button>
                            </form>
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->