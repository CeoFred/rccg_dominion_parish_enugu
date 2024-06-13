import React from 'react';
import Contacthelper from "../../helper/Contacthelper";
import clients from "../../data/clients.json";
import ReCAPTCHA from "react-google-recaptcha";
import { Alert } from 'react-bootstrap';

class Quotecta extends Contacthelper {
    render() {
        return (
            <div className="section dark-overlay dark-overlay-3 bg-cover bg-center bg-norepeat" style={{ backgroundImage: "url(" + process.env.PUBLIC_URL + "/assets/img/bg1.jpg)" }}>
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-lg-6 mb-lg-30">
                            <form onSubmit={this.handleSubmit.bind(this)} method="Get">
                                <div className="form-row">
                                    <div className="col-lg-6">
                                        <div className="form-group">
                                            <i className="far fa-user" />
                                            <input type="text" className="form-control transparent" placeholder="Full Name" name="name" value={this.state.name} onChange={this.onNameChange.bind(this)} required />
                                        </div>
                                    </div>
                                    <div className="col-lg-6">
                                        <div className="form-group">
                                            <i className="far fa-envelope" />
                                            <input type="email" className="form-control transparent" placeholder="Email Id" name="email" value={this.state.email} onChange={this.onEmailChange.bind(this)} required />
                                        </div>
                                    </div>
                                    <div className="col-lg-6">
                                        <div className="form-group">
                                            <i className="far fa-pencil" />
                                            <input type="text" className="form-control transparent" placeholder="Subject" name="subject" value={this.state.subject} onChange={this.onSubjectChange.bind(this)} required />
                                        </div>
                                    </div>
                                    <div className="col-lg-6">
                                        <div className="form-group">
                                            <i className="far fa-phone" />
                                            <input type="text" className="form-control transparent" placeholder="Phone No." name="phone" value={this.state.phone} onChange={this.onPhoneChange.bind(this)} required />
                                        </div>
                                    </div>
                                    <div className="col-lg-12">
                                        <div className="form-group">
                                            <textarea className="form-control transparent" placeholder="Enter Message" rows={4} name="message" value={this.state.message} onChange={this.onMessageChange.bind(this)} required />
                                        </div>
                                    </div>
                                    <div className="col-lg-12">
                                        <button type="submit" className="sigma_btn-custom btn-block"> Get a Quote <i className="far fa-arrow-right" /> </button>
                                        {/* Form Messages */}
                                        <Alert variant="success" className="d-none mt-3 mb-0" id="server_response_success">
                                            <strong>Success!</strong> Contact form has been successfully submitted.
                                        </Alert>
                                        <Alert variant="danger" className="d-none mt-3 mb-0" id="server_response_danger">
                                            <strong>Oops!</strong> Something bad happened. Please try again later.
                                        </Alert>
                                        {/* Form Messages */}
                                    </div>
                                    <ReCAPTCHA
                                        sitekey="6LdxUhMaAAAAAIrQt-_6Gz7F_58S4FlPWaxOh5ib"
                                        onChange={this.reCaptchaLoaded.bind(this)}
                                        size="invisible"
                                    />
                                </div>
                            </form>
                        </div>
                        <div className="col-lg-6">
                            <div className="row">
                                {/* Data */}
                                {clients.slice(0, 6).map((item, i) => (
                                    <div className="col-lg-6" key={i}>
                                        <div className="sigma_client">
                                            <img src={process.env.PUBLIC_URL + "/" + item.image} alt="client" />
                                        </div>
                                    </div>
                                ))}
                                {/* Data */}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Quotecta;