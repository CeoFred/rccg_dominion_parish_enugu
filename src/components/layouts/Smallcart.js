import React, { Component, Fragment } from 'react';
import { Link } from 'react-router-dom';
import cartItems from "../../data/shop/shop.json";

class Smallcart extends Component {
    render() {
        return (
            <Fragment>
                {cartItems.slice(0, 5).map((item, i) => (
                    <li key={i}>
                        <Link to={"/product-single/" + item.id} className="sigma_cart-product-wrapper">
                            <img src={process.env.PUBLIC_URL + "/" + item.image[0]} alt={item.title} />
                            <div className="sigma_cart-product-body">
                                <h6>{item.title}</h6>
                                <div className="sigma_product-price justify-content-start">
                                    <span>{new Intl.NumberFormat().format((item.price * (100 - item.discount) / 100).toFixed(2))}$</span>
                                </div>
                            </div>
                        </Link>
                    </li>
                ))}
            </Fragment>
        );
    }
}

export default Smallcart;