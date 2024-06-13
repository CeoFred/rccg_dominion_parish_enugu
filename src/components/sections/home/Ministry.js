import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import block from "../../../data/ministry/ministry.json";
import category from "../../../data/ministry/category.json";
 
class Ministry extends Component {
    constructor(props) {
        super(props);
        this.state = {
            filteredProducts: block,
            activeItem: 0
        };
    }
    handleClick = id => {
        let filteredProducts = [];
        if (id === 0) {
            filteredProducts = block;
        } else {
            filteredProducts = block.filter(
                (product) => product.category.includes(id)
            );
        }
        this.setState({ filteredProducts, activeItem: id });
    };
    render() {
        const renderAll = this.state.filteredProducts.map((item, i) => (
            <div className="col-lg-4" key={i}>
                <div className="sigma_portfolio-item">
                    <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                    <div className="sigma_portfolio-item-content">
                        <div className="sigma_portfolio-item-content-inner">
                            <h5> <Link to={"/ministry-details/" + item.id}>{item.title}</Link> </h5>
                            <p className="blockquote bg-transparent">{item.shorttext.slice(0, 70)}</p>
                        </div>
                        <Link to={"/ministry-details/" + item.id}><i className="fal fa-plus" /></Link>
                    </div>
                </div>
            </div>
        ));
        return (
            <div className="section section-padding light-bg">
                <div className="container">
                    <div className="section-title text-start flex-title">
                        <div>
                            <p className="subtitle">Ministries</p>
                            <h4 className="title mb-lg-0">Our Ministries</h4>
                        </div>
                        <div className="text-center filter-items me-0 mb-0">
                            <h5 className={this.state.activeItem === 0 ? 'portfolio-trigger active' : 'portfolio-trigger'} onClick={this.handleClick.bind(this, 0)}>All</h5>
                            {category.map((item, i) => (
                                <h5 key={i} className={this.state.activeItem === parseInt(item.id) ? 'portfolio-trigger active' : 'portfolio-trigger'} onClick={this.handleClick.bind(this, item.id)}>{item.title}
                                </h5>
                            ))}
                        </div>
                    </div>
                    <div className="portfolio-filter row">
                        {/* Data */}
                        {renderAll}
                        {/* Data */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Ministry;