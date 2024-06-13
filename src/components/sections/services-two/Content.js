import React, { Component, Fragment } from 'react';
import { Link } from 'react-router-dom';
import serviceblock from '../../../data/service/service.json';
import Pagination from "react-js-pagination";
import Brands from '../../layouts/Brands';
import Cta from '../../layouts/Cta';

class Content extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: serviceblock,
            activePage: 1,
            itemPerpage: 8
        }
    }
    handlePageChange(pageNumber) {
        this.setState({ activePage: pageNumber });
    }
    render() {
        const paginationData = this.state.data.slice((this.state.activePage - 1) * this.state.itemPerpage, this.state.activePage * this.state.itemPerpage).map((item, i) => {
            return <div className="col-lg-4 col-md-6" key={i}>
                <Link to="/sermons" className="sigma_service style-2">
                    <div className="sigma_service-thumb">
                    <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                        <i className={item.icon} />
                    </div>
                    <div className="sigma_service-body">
                        <h5>{item.title}</h5>
                        <p>{item.shorttext}</p>
                    </div>
                </Link>
            </div>
        });
        return (
            <Fragment>
                <div className="section section-padding">
                    <div className="container">
                        <div className="row">
                            {/* Data */}
                            {paginationData}
                            {/* Data */}
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
                </div>
                <Brands />
                <Cta />
            </Fragment>
        );
    }
}

export default Content;