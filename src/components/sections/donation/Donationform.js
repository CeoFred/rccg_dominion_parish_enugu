import React, { Component } from 'react';

class Donationform extends Component {
    render() {
        return (
            <div className="section">
                <div className="container">
                    <div className="section-title text-center">
                        <p className="subtitle">DONATE TO HELP</p>
                        <h4 className="title">Make a donation to help us</h4>
                    </div>
                    <form>
                        <div className="form-row sigma_donation-form">
                            <div className="col-lg-6">
                                <div className="col-12">
                                    <div className="form-group mb-5">
                                        <h5>Donation Amount</h5>
                                        <div className="input-group">
                                            <div className="input-group-prepend">
                                                <button className="sigma_btn-custom shadow-none btn-sm" type="button">$</button>
                                            </div>
                                            <input type="text" className="form-control ms-0" placeholder="$100" />
                                        </div>
                                        <ul className="sigma_select-amount">
                                            <li>$15.00</li>
                                            <li>$25.00</li>
                                            <li>$45.00</li>
                                            <li className="active">$100.00</li>
                                            <li>$500.00</li>
                                        </ul>
                                    </div>
                                </div>
                                <div className="col-12">
                                    <div className="form-group mb-5">
                                        <h5>Payment Method</h5>
                                        <div className="d-flex align-items-center">
                                            <div className="d-flex align-items-center">
                                                <input type="radio" id="radio" name="radio" defaultValue="Online Payment" />
                                                <label htmlFor="radio" className="mb-0">Online Payment</label>
                                            </div>
                                            <div className="d-flex align-items-center ms-4">
                                                <input type="radio" id="radio2" name="radio" defaultValue="Offline Payment" />
                                                <label htmlFor="radio2" className="mb-0">Offline Payment</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-lg-6">
                                <div className="col-12">
                                    <div className="form-group">
                                        <h5>Donator Details</h5>
                                        <div className="row">
                                            <div className="col-lg-6">
                                                <input type="text" className="form-control" placeholder="Full Name" name="name" />
                                            </div>
                                            <div className="col-lg-6 mt-3 mt-lg-0">
                                                <input type="email" placeholder="Email Address" name="email" className="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-12">
                                    <div className="form-group">
                                        <h5>Campaigns</h5>
                                        <select className="form-control">
                                            <option value={1}>Education for Every Child - (Target: 10000.00)</option>
                                            <option value={2}>Education for Every Child - (Target: 10000.00)</option>
                                            <option value={3}>Education for Every Child - (Target: 15000.00)</option>
                                            <option value={4}>Education for Every Child - (Target: 25000.00)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div className="col-12">
                                <div className="form-group">
                                    <h5>Message</h5>
                                    <textarea name="message" className="form-control" placeholder="Enter Message" rows={6} />
                                </div>
                            </div>
                            <div className="col-lg-12 text-center">
                                <button type="submit" className="sigma_btn-custom" name="button"> Donate Now </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
}

export default Donationform;