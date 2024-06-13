import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import donationblock from '../../../data/donation/donation.json';
import Pagination from "react-js-pagination";

class Donationblock extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: donationblock,
            activePage: 1,
            itemPerpage: 6
        }
    }
    handlePageChange(pageNumber) {
        this.setState({ activePage: pageNumber });
    }
    render() {
        const paginationData = this.state.data.slice((this.state.activePage - 1) * this.state.itemPerpage, this.state.activePage * this.state.itemPerpage).map((item, i) => {
            return <div className="col-lg-4 col-md-6" key={i}>
                <div className="sigma_service style-2">
                    <div className="sigma_service-thumb">
                        <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                    </div>
                    <div className="sigma_service-body">
                        <h5>
                            <Link to="/donation">{item.title}</Link>
                        </h5>
                        <p>{item.shorttext}</p>
                        <div className="sigma_service-progress">
                            <div className="progress-content">
                                <p>Raised: ${new Intl.NumberFormat().format(item.raised)}</p>
                                <p>Goal: ${new Intl.NumberFormat().format(item.goal)}</p>
                            </div>
                            <div className="sigma_progress">
                                <div className="progress">
                                    <div className="progress-bar" style={{ width: item.raised * 100 / item.goal + "%" }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Link to="/donation" className="sigma_btn-custom">
                            Donate
                        </Link>
                    </div>
                </div>
            </div>
        });
        return (
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

        );
    }
}

export default Donationblock;