import React, { Component, Fragment } from 'react';
import { Link } from "react-router-dom";
import { getProduct, handleOutofStock } from "../../../helper/shopHelper";
import { getAuthor, Rating, socialShare } from "../../../helper/helper";
import { Tab, Nav } from "react-bootstrap";
import Slider from "react-slick";
import Sidebar from "../../layouts/Shopsidebar";
import { OverlayTrigger, Tooltip } from 'react-bootstrap';

const settings = {
    slidesToShow: 1, slidesToScroll: 1, arrows: false, fade: true
};
const settingsThumb = {
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    centerMode: false,
    arrows: false,
    focusOnSelect: true
};

class Content extends Component {
    constructor(props) {
        super(props)
        this.state = {
            qty: 1,
            nav1: null,
            nav2: null
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
    componentDidMount() {
        this.setState({
            nav1: this.slider1,
            nav2: this.slider2
        });
    }
    // Open window
    openSocialPopup(social) {
        window.open(social.link, "MsgWindow", "width=600,height=600")
        // alert(social.title)
    }
    render() {
        const detailId = this.props.detailId;
        const item = getProduct(detailId);
        return (
            <Fragment>
                {/* Product Content Start */}
                <div className="section section-padding">
                    <div className="container">
                        <div className="row">
                            <div className="col-lg-4 col-md-6">
                                <div className="sigma_product-single-thumb">
                                    <Slider asNavFor={this.state.nav2}
                                        ref={slider => (this.slider1 = slider)} {...settings} className="slider">
                                        {/* Data */}
                                        {item.image.map((image, i) => (
                                            <img key={i} src={process.env.PUBLIC_URL + "/" + image} alt={item.title} />
                                        ))}
                                        {/* Data */}
                                    </Slider>
                                    <Slider asNavFor={this.state.nav1}
                                        ref={slider => (this.slider2 = slider)} {...settingsThumb} focusOnSelect={true} className="slider-nav">
                                        {/* Data */}
                                        {item.image.map((image, i) => (
                                            <img key={i} src={process.env.PUBLIC_URL + "/" + image} alt={item.title} />
                                        ))}
                                        {/* Data */}
                                    </Slider>
                                </div>
                            </div>
                            <div className="col-lg-4 col-md-6">
                                <div className="sigma_product-single-content">
                                    <div className="sigma_rating-wrapper">
                                        <div className="sigma_rating">
                                            {Rating(item.rating)}
                                        </div>
                                        <span>{item.reviews.length} Reviews</span>
                                    </div>
                                    <h4 className="entry-title">{item.title}</h4>
                                    <div className="sigma_product-price">
                                        <span>${new Intl.NumberFormat().format((item.price * (100 - item.discount) / 100).toFixed(2))}</span>
                                        {item.discount > 0 || item.discount !== '' ?
                                            <span>${new Intl.NumberFormat().format((item.price).toFixed(2))}</span>
                                            : ''}
                                    </div>
                                    <p>
                                        <strong>Availablity:
                                            {item.stock === true ?
                                                <span>In Stock</span>
                                                :
                                                <span>Out of Stock</span>
                                            }
                                        </strong>
                                    </p>
                                    <p className="sigma_product-excerpt">{item.shorttext}</p>
                                    <form className="sigma_product-atc-form">
                                        <div className="sigma_product-variation-wrapper">
                                            <div className="sigma_product-radio form-group">
                                                {/* Data */}
                                                {item.size.map((size, i) => (
                                                    <label key={i}>
                                                        <input type="radio" name="size" value={size} />
                                                        <span>{size}</span>
                                                    </label>
                                                ))}
                                                {/* Data */}
                                            </div>
                                        </div>
                                        <div className="qty-outter">
                                            {item.stock === true ?
                                                <button type="button" className="sigma_btn-custom">Add To Cart</button>
                                                :
                                                <button type="button" onClick={handleOutofStock} disabled className="sigma_btn-custom">Add To Cart</button>
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
                                                {socialShare(item.title).map((social, i) => (
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
                                    <h6>Guaranteed Safe Checkout</h6>
                                    <img src={process.env.PUBLIC_URL + "/assets/img/payments.png"} alt="payments" />
                                </div>
                            </div>
                            {/* Sidebar Start */}
                            <div className="col-lg-4 shop_sidebar">
                                <Sidebar />
                            </div>
                            {/* Sidebar End */}
                        </div>
                    </div>
                </div>
                {/* Product Content End */}
                {/* Additional Information Start */}
                <div className="section pt-0">
                    <div className="container">
                        <div className="sigma_product-additional-info">
                            <Tab.Container defaultActiveKey="tab1">
                                <Nav as="ul" varient="tabs">
                                    <Nav.Item as="li">
                                        <Nav.Link eventKey="tab1">Description</Nav.Link>
                                    </Nav.Item>
                                    <Nav.Item as="li">
                                        <Nav.Link eventKey="tab2">Additional Information</Nav.Link>
                                    </Nav.Item>
                                    <Nav.Item as="li">
                                        <Nav.Link eventKey="tab3">Reviews</Nav.Link>
                                    </Nav.Item>
                                </Nav>
                                <Tab.Content>
                                    <Tab.Pane eventKey="tab1">
                                        <h4>Description</h4>
                                        <div dangerouslySetInnerHTML={{ __html: item.htmltext }} />
                                    </Tab.Pane>
                                    <Tab.Pane eventKey="tab2">
                                        <h4>Additional Information</h4>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th scope="col">Attributes</th>
                                                    <th scope="col">Values</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {/* Data */}
                                                {item.addinfo.map((info, i) => (
                                                    <tr key={i}>
                                                        <td><strong>{info.title}</strong></td>
                                                        <td>{info.text}</td>
                                                    </tr>
                                                ))}
                                                {/* Data */}
                                            </tbody>
                                        </table>
                                    </Tab.Pane>
                                    <Tab.Pane eventKey="tab3">
                                        <h4>Leave a Review</h4>
                                        <div className="sigma_rating-wrapper">
                                            <div className="sigma_rating">
                                                <i className="fa fa-star" />
                                                <i className="fa fa-star" />
                                                <i className="fa fa-star" />
                                                <i className="fa fa-star" />
                                                <i className="fa fa-star" />
                                            </div>
                                            <span>Your Review</span>
                                        </div>
                                        {/* Review Form start */}
                                        <div className="comment-form">
                                            <form>
                                                <div className="row">
                                                    <div className="col-md-6 form-group">
                                                        <input type="text" className="form-control" placeholder="Full Name" name="fname" required />
                                                    </div>
                                                    <div className="col-md-6 form-group">
                                                        <input type="email" className="form-control" placeholder="Email Address" name="email" required />
                                                    </div>
                                                    <div className="col-md-12 form-group">
                                                        <textarea className="form-control" placeholder="Type your comment..." name="comment" rows={7} required />
                                                    </div>
                                                </div>
                                                <button type="submit" className="sigma_btn-custom">Post Review</button>
                                            </form>
                                        </div>
                                        {/* Review Form End */}
                                        {/* Reviews Start */}
                                        <div className="comments-list">
                                            <ul>
                                                {/* Data */}
                                                {item.reviews.map((review, i) => (
                                                    <li className="comment-item" key={i}>
                                                        {getAuthor(review.user).map((user, i) => (
                                                            <img key={i} src={process.env.PUBLIC_URL + "/" + user.image} alt={user.name} />
                                                        ))}
                                                        {getAuthor(review.user).map((user, i) => (
                                                            <div className="comment-body" key={i}>
                                                                <h5>{user.name}</h5>
                                                                <div className="sigma_rating">
                                                                    {Rating(review.rating)}
                                                                </div>
                                                                <p>{review.comment}</p>
                                                                <Link to="#" className="btn-link"> Reply <i className="far fa-reply" /> </Link>
                                                                <span><i className="far fa-clock" /> {review.commentdate}</span>
                                                            </div>
                                                        ))}
                                                    </li>
                                                ))}
                                                {/* Data */}
                                            </ul>
                                        </div>
                                        {/* Reviews End */}
                                    </Tab.Pane>
                                </Tab.Content>
                            </Tab.Container>
                        </div>
                    </div>
                </div>
                {/* Additional Information End */}
            </Fragment>
        );
    }
}

export default Content;