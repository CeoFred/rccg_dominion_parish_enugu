import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import shopblock from '../../../data/shop/shop.json';
import { getFilteredproducts, handleOutofStock } from '../../../helper/shopHelper';
import Sidebar from '../../layouts/Shopsidebar';
import Pagination from "react-js-pagination";
import Quickview from '../../layouts/Quickview';
import { Modal, OverlayTrigger, Tooltip } from 'react-bootstrap';

class Content extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: this.getProducts(),
            activePage: 1,
            itemPerpage: 12,
            modalshow: false,
            lastActiveBox: -1
        }
        this.modalShow = this.modalShow.bind(this);
        this.modalClose = this.modalClose.bind(this);
    }
    getProducts() {
        var cat = this.props.catId ? this.props.catId : '';
        var tag = this.props.tagId ? this.props.tagId : '';
        var minPrice = this.props.minPrice ? this.props.minPrice : '';
        var maxPrice = this.props.maxPrice ? this.props.maxPrice : '';
        var searchQuery = this.props.query ? this.props.query : '';
        var filteredItems = getFilteredproducts(shopblock, { cat, tag, priceFilter: [minPrice, maxPrice], searchQuery });
        return filteredItems;
    }
    handlePageChange(pageNumber) {
        this.setState({ activePage: pageNumber });
    }
    // Modal
    modalShow(index) {
        this.setState({ modalshow: true, lastActiveBox: index });
    }
    modalClose() {
        this.setState({ modalshow: false });
    }
    render() {
        const paginationData = this.state.data.slice((this.state.activePage - 1) * this.state.itemPerpage, this.state.activePage * this.state.itemPerpage).map((item, i) => {
            return <div key={i} className="col-md-4 col-sm-6">
                <div className="sigma_product">
                    <div className="sigma_product-thumb">
                        <Link to={"/product-single/" + item.id}>
                            <img src={process.env.PUBLIC_URL + "/" + item.image[0]} alt={item.title} />
                        </Link>
                        <div className="sigma_product-controls">
                            {/* Wishlist */}
                            <OverlayTrigger placement="top" overlay={<Tooltip> Add To Wishlist </Tooltip>} >
                                <Link to="#"> <i className="far fa-heart" /> </Link>
                            </OverlayTrigger>
                            {/* Cart */}
                            {item.stock === true ?
                                <OverlayTrigger placement="top" overlay={<Tooltip> Add To Cart </Tooltip>} >
                                    <Link to="#"> <i className="far fa-shopping-basket" />
                                    </Link>
                                </OverlayTrigger>
                                :
                                <OverlayTrigger placement="top" overlay={<Tooltip> Add To Cart </Tooltip>} >
                                    <Link to="#" onClick={handleOutofStock}> <i className="far fa-shopping-basket" />
                                    </Link>
                                </OverlayTrigger>
                            }
                            {/* Quick view */}
                            <Link to="#" placement="top" ngbtooltip="Quick View"> <i className="far fa-eye" onClick={(e) => this.modalShow(item.id)} /> </Link>
                        </div>
                    </div>
                    <div className="sigma_product-body">
                        <h5 className="sigma_product-title"> <Link to={"/product-single/" + item.id}>{item.title}</Link> </h5>
                        <div className="sigma_product-price">
                            <span>${new Intl.NumberFormat().format((item.price * (100 - item.discount) / 100).toFixed(2))}</span>
                            {item.discount > 0 || item.discount !== '' ?
                                <span>${new Intl.NumberFormat().format((item.price).toFixed(2))}</span>
                                : ''}
                        </div>
                    </div>
                </div>
            </div>
        });
        return (
            <div className="section">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8">
                            {/* Product Count & Orderby Start */}
                            <div className="sigma_shop-global">
                                <p>Showing <b>{paginationData.length}</b> of <b>{shopblock.length}</b> products </p>
                                <form method="post">
                                    <select className="form-control" name="orderby">
                                        <option value="default">Default sorting</option>
                                        <option value="latest">Latest release</option>
                                        <option value="price-down">Price: High - Low</option>
                                        <option value="price-up">Price: Low - High</option>
                                        <option value="popularity">Popularity Sorting</option>
                                    </select>
                                </form>
                            </div>
                            {/* Product Count & Orderby End */}
                            <div className="row">
                                {/* Product Start */}
                                {paginationData}
                                {/* Product End */}
                                {/* Modal (Quick View) */}
                                <Modal size="lg" show={this.state.modalshow} className="sigma_quick-view-modal" onHide={this.modalClose} aria-labelledby="contained-modal-title-vcenter" centered>
                                    <Modal.Body>
                                        <div className="close-btn close-dark close" onClick={this.modalClose}>
                                            <span />
                                            <span />
                                        </div>
                                        <Quickview productId={this.state.lastActiveBox} />
                                    </Modal.Body>
                                </Modal>
                            </div>
                            {/* Pagination Start */}
                            <Pagination
                                activePage={this.state.activePage}
                                itemsCountPerPage={this.state.itemPerpage}
                                totalItemsCount={this.state.data.length}
                                pageRangeDisplayed={this.state.data.length}
                                onChange={this.handlePageChange.bind(this)}
                                innerClass="pagination mb-0"
                                activeClass="active"
                                itemClass="page-item"
                                linkClass="page-link"
                            />
                            {/* Pagination End */}
                        </div>
                        {/* Sidebar Start */}
                        <div className="col-lg-4">
                            <Sidebar />
                        </div>
                        {/* Sidebar End */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Content;