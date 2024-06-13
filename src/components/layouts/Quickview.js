import React, { Component } from 'react';
import { getProduct, handleOutofStock } from '../../helper/shopHelper';
import { Rating, socialShare } from '../../helper/helper';
import { OverlayTrigger, Tooltip } from 'react-bootstrap';
import { Link } from 'react-router-dom';

class Quickview extends Component {
    constructor(props) {
        super(props)
        this.state = {
            qty: 1
        }
        this.increment = this.increment.bind(this);
        this.decrement = this.decrement.bind(this);
        this.openSocialPopup = this.openSocialPopup.bind(this);
    }
    increment() {
        this.setState({
            qty: this.state.qty + 1
        });
    }
    decrement() {
        this.setState({
            qty: this.state.qty > 1 ? this.state.qty - 1 : 1
        });
    }
    handleChange(event) {
        this.setState({ qty: event.target.value });
    }
    // Open window
    openSocialPopup(social) {
        window.open(social.link, "MsgWindow", "width=600,height=600")
        // alert(social.title)
    }
    render() {
        const productId = this.props.productId;
        const modalContent = getProduct(productId);
        return (
            <div className="row">
                <div className="col-md-6">
                    <div className="sigma_product-single-thumb">
                        <img src={process.env.PUBLIC_URL + "/" + modalContent.image[0]} alt={modalContent.title} className="w-100" />
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="sigma_product-single-content">
                        <h4 className="entry-title"> {modalContent.title} </h4>
                        <div className="sigma_product-price">
                            <span>${new Intl.NumberFormat().format((modalContent.price * (100 - modalContent.discount) / 100).toFixed(2))}</span>
                            {modalContent.discount > 0 || modalContent.discount !== '' ?
                                <span>${new Intl.NumberFormat().format((modalContent.price).toFixed(2))}</span>
                                : ''}
                        </div>
                        <div className="sigma_rating-wrapper">
                            <div className="sigma_rating">
                                {Rating(modalContent.rating)}
                            </div>
                            <span>{modalContent.reviews.length} Reviews</span>
                        </div>
                        <p>
                            <strong>Availablity:
                                {modalContent.stock === true ?
                                    <span>In Stock</span>
                                    :
                                    <span>Out of Stock</span>
                                }
                            </strong>
                        </p>
                        <p className="sigma_product-excerpt">{modalContent.shorttext}</p>
                        <form className="sigma_product-atc-form">
                            <div className="sigma_product-variation-wrapper">
                                <div className="sigma_product-radio form-group">
                                    {/* Data */}
                                    {modalContent.size.map((size, i) => (
                                        <label key={i}>
                                            <input type="radio" name="size" value={size} />
                                            <span>{size}</span>
                                        </label>
                                    ))}
                                    {/* Data */}
                                </div>
                            </div>
                            <div className="qty-outter">
                                {modalContent.stock === true ?
                                    <button type="button" className="sigma_btn-custom secondary">Add To Cart</button>
                                    :
                                    <button type="button" onClick={handleOutofStock} disabled className="sigma_btn-custom secondary">Add To Cart</button>
                                }
                                <div className="qty-inner">
                                    <h6>Qty:</h6>
                                    <div className="qty">
                                        <span className="qty-subtract" onClick={this.decrement}><i className="fa fa-minus" /></span>
                                        <input type="text" name="qty" value={this.state.qty} onChange={this.handleChange.bind(this)} readOnly />
                                        <span className="qty-add" onClick={this.increment}><i className="fa fa-plus" /></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {/* Post Meta Start */}
                        <div className="sigma_post-single-meta">
                            <div className="sigma_post-single-meta-item sigma_post-share">
                                <h6>Share</h6>
                                <ul className="sigma_sm">
                                    {/* Data */}
                                    {socialShare(modalContent.title).map((social, i) => (
                                        <li key={i}>
                                            <Link to="#" onClick={(e) => this.openSocialPopup(social, i)}>
                                                <i className={social.iconClass} />
                                            </Link>
                                        </li>
                                    ))}
                                    {/* Data */}
                                </ul>
                            </div>
                            <div className="sigma_post-single-meta-item">
                                <div className="sigma_product-controls">
                                    <OverlayTrigger placement="top" overlay={<Tooltip> Compare </Tooltip>} >
                                        <Link to="#"> <i className="far fa-signal-4" /> </Link>
                                    </OverlayTrigger>
                                    {/* Wishlist */}
                                    <OverlayTrigger placement="top" overlay={<Tooltip> Add To Wishlist </Tooltip>} >
                                        <Link to="#"> <i className="far fa-heart" /> </Link>
                                    </OverlayTrigger>
                                </div>
                            </div>
                        </div>
                        {/* Post Meta End */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Quickview;