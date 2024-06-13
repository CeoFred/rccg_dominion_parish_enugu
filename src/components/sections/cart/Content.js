import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import cartItems from "../../../data/shop/shop.json";
import { handleDeleteFromCart } from "../../../helper/shopHelper";

class Content extends Component {
    constructor(props) {
        super(props);
        this.state = {
            cartItems: cartItems,
            priceTotal: cartItems.slice(0, 5).reduce((totalPrice, item) => totalPrice + item.price * (100 - item.discount) / 100 * item.rating, 0),
        };
        this.increment = this.increment.bind(this);
        this.decrement = this.decrement.bind(this);
    }
    increment(item) {
        item.rating = item.rating + 1;
        this.setState({ cartItems: this.state.cartItems, priceTotal: cartItems.slice(0, 5).reduce((totalPrice, item) => totalPrice + item.price * (100 - item.discount) / 100 * item.rating, 0) });
    }
    decrement(item) {
        item.rating = item.rating > 1 ? item.rating - 1 : 1;
        this.setState({ cartItems: this.state.cartItems, priceTotal: cartItems.slice(0, 5).reduce((totalPrice, item) => totalPrice + item.price * (100 - item.discount) / 100 * item.rating, 0) });
    }
    render() {
        return (
            <div className="section">
                <div className="container">
                    {/* Cart Table Start */}
                    <table className="sigma_responsive-table">
                        <thead>
                            <tr>
                                <th className="remove-item" />
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {/* Data */}
                            {cartItems.slice(0, 5).map((item, i) => (
                                <tr key={i}>
                                    <td className="remove">
                                        <button type="button" className="close-btn close-danger remove-from-cart" onClick={handleDeleteFromCart}>
                                            <span />
                                            <span />
                                        </button>
                                    </td>
                                    <td data-title="Product">
                                        <div className="sigma_cart-product-wrapper">
                                            <img src={process.env.PUBLIC_URL + "/" + item.image[0]} alt={item.title} />
                                            <div className="sigma_cart-product-body">
                                                <h6> <Link to={"/product-single/" + item.id}>{item.title}</Link> </h6>
                                                <p>{item.rating} Pieces</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="Price"> <strong>{new Intl.NumberFormat().format((item.price * (100 - item.discount) / 100).toFixed(2))}$</strong> </td>
                                    <td className="quantity" data-title="Quantity">
                                        <div className="qty">
                                            <span className="qty-subtract" onClick={(e) => this.decrement(item)}><i className="fa fa-minus" /></span>
                                            <input type="text" name="qty" value={item.rating} readOnly />
                                            <span className="qty-add" onClick={(e) => this.increment(item)}><i className="fa fa-plus" /></span>
                                        </div>
                                    </td>
                                    <td data-title="Total"> <strong>{new Intl.NumberFormat().format((item.price * (100 - item.discount) / 100 * item.rating).toFixed(2))}$</strong> </td>
                                </tr>
                            ))}
                            {/* Data */}
                        </tbody>
                    </table>
                    {/* Cart Table End */}
                    {/* Coupon Code Start */}
                    <div className="row">
                        <div className="col-lg-5">
                            <div className="form-group mb-0">
                                <div className="input-group mb-0">
                                    <input type="text" className="form-control" placeholder="Enter Coupon Code" aria-label="Coupon Code" />
                                    <div className="input-group-append">
                                        <button className="sigma_btn-custom shadow-none" type="button">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {/* Coupon Code End */}
                </div>
            </div>
        );
    }
}

export default Content;