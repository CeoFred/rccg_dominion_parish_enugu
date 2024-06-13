import React, { Fragment } from 'react';
import Contacthelper from '../../../helper/Contacthelper';
import ReCAPTCHA from "react-google-recaptcha";
import { Alert } from 'react-bootstrap';

class Contactblock extends Contacthelper {
    render() {
        return (
            <Fragment>
                {/* Map Start */}
                <div className="sigma_map">
                    <iframe title="contact map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9914406081493!2d2.292292615201654!3d48.85837360866272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sEiffel%20Tower!5e0!3m2!1sen!2sin!4v1571115084828!5m2!1sen!2sin" allowFullScreen />
                </div>
                {/* Map End */}
                {/* Contact form Start */}
                <div className="section mt-negative pt-0">
                    <div className="container">
                        <form className="sigma_box box-lg m-0" onSubmit={this.handleSubmit.bind(this)} method="Get">
                            <div className="row">
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <i className="far fa-user" />
                                        <input type="text" className="form-control dark" placeholder="Full Name" name="name" value={this.state.name} onChange={this.onNameChange.bind(this)} required />
                                    </div>
                                </div>
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <i className="far fa-envelope" />
                                        <input type="email" className="form-control dark" placeholder="Email Id" name="email" value={this.state.email} onChange={this.onEmailChange.bind(this)} required />
                                    </div>
                                </div>
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <i className="far fa-pencil" />
                                        <input type="text" className="form-control dark" placeholder="Subject" name="subject" value={this.state.subject} onChange={this.onSubjectChange.bind(this)} required />
                                    </div>
                                </div>
                                <div className="col-lg-6">
                                    <div className="form-group">
                                        <i className="far fa-phone" />
                                        <input type="text" className="form-control dark" placeholder="Phone No." name="phone" value={this.state.phone} onChange={this.onPhoneChange.bind(this)} required />
                                    </div>
                                </div>
                            </div>
                            <div className="form-group">
                                <textarea placeholder="Enter Message" cols={45} rows={5} className="form-control dark" name="message" value={this.state.method} onChange={this.onMessageChange.bind(this)} required />
                            </div>
                            <div className="text-center">
                                <ReCAPTCHA
                                    sitekey="6LdxUhMaAAAAAIrQt-_6Gz7F_58S4FlPWaxOh5ib"
                                    onChange={this.reCaptchaLoaded.bind(this)}
                                    size="invisible"
                                />
                                <button type="submit" className="sigma_btn-custom" name="button">Submit Now</button>
                                {/* Form Messages */}
                                <Alert variant="success" className="d-none mt-3 mb-0" id="server_response_success">
                                    <strong>Success!</strong> Contact form has been successfully submitted.
                                </Alert>
                                <Alert variant="danger" className="d-none mt-3 mb-0" id="server_response_danger">
                                    <strong>Oops!</strong> Something bad happened. Please try again later.
                                </Alert>
                                {/* Form Messages */}
                            </div>
                        </form>
                    </div>
                </div>
                {/* Contact form End */}
            </Fragment>
        );
    }
}

export default Contactblock;