import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import wishlistItems from "../../../data/shop/shop.json";
import { handleDeleteFromWishlist } from "../../../helper/shopHelper";

class Content extends Component {
    render() {
        return (
            <div className="section">
                <div className="container">
                    {/* Wishlist Table Start */}
                    <table className="sigma_responsive-table">
                        <thead>
                            <tr>
                                <th className="remove-item" />
                                <th>Product</th>
                                <th>Price</th>
                                <th>Availability</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {/* Data */}
                            {wishlistItems.slice(0, 5).map((item, i) => (
                                <tr key={i}>
                                    <td className="remove">
                                        <button type="button" className="close-btn close-danger remove-from-cart" onClick={handleDeleteFromWishlist}>
                                            <span />
                                            <span />
                                        </button>
                                    </td>
                                    <td data-title="Product">
                                        <div className="sigma_cart-product-wrapper">
                                            <img src={process.env.PUBLIC_URL + "/" + item.image[0]} alt={item.title} />
                                            <div className="sigma_cart-product-body">
                                                <h6> <Link to={"/product-single/" + item.id}>{item.title}</Link> </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="Price"> <strong>{new Intl.NumberFormat().format((item.price * (100 - item.discount) / 100).toFixed(2))}$</strong> </td>
                                    <td data-title="Availability">
                                        {item.stock === true ?
                                            <span className="sigma_product-stock instock">In Stock</span>
                                            :
                                            <span className="sigma_product-stock outofstock">Out of Stock</span>
                                        }
                                    </td>
                                    <td data-title="Actions">
                                        {item.stock === true ?
                                            <button type="button" className="sigma_btn-custom btn-sm shadow-none">Add to Cart</button>
                                            :
                                            <button type="button" className="sigma_btn-custom btn-sm shadow-none" disabled>Add to Cart</button>
                                        }
                                    </td>
                                </tr>
                            ))}
                            {/* Data */}
                        </tbody>
                    </table>
                    {/* Wishlist Table End */}
                    {/* Share Wishlist Start */}
                    <div className="text-center">
                        <h5>Share Your Wishlist</h5>
                        {/* Post Share Start */}
                        <div className="sigma_post-share">
                            <ul className="sigma_sm justify-content-center">
                                <li>
                                    <Link to="#">
                                        <i className="fab fa-facebook-f" />
                                    </Link>
                                </li>
                                <li>
                                    <Link to="#">
                                        <i className="fab fa-linkedin-in" />
                                    </Link>
                                </li>
                                <li>
                                    <Link to="#">
                                        <i className="fab fa-twitter" />
                                    </Link>
                                </li>
                                <li>
                                    <Link to="#">
                                        <i className="fab fa-youtube" />
                                    </Link>
                                </li>
                            </ul>
                        </div>
                        {/* Post Share End */}
                    </div>
                    {/* Share Wishlist End */}
                </div>
            </div>
        );
    }
}

export default Content;