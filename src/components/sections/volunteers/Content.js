import React, { Component, Fragment } from 'react';
import { Link } from 'react-router-dom';
import volunteerblock from '../../../data/volunteer/volunteer.json';
import Pagination from "react-js-pagination";
import Quotecta from '../../layouts/Quotecta';
import Blogs from './Blogs';

class Content extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: volunteerblock,
            activePage: 1,
            itemPerpage: 8,
            visible: false
        }
        this.socialTrigger = this.socialTrigger.bind(this);
    }
    handlePageChange(pageNumber) {
        this.setState({ activePage: pageNumber });
    }
    socialTrigger(item) {
        this.setState({ visible: item });
        if (this.state.visible === item) {
            this.setState({ visible: null })
        }
    }
    render() {
        const paginationData = this.state.data.slice((this.state.activePage - 1) * this.state.itemPerpage, this.state.activePage * this.state.itemPerpage).map((item, i) => {
            return <div className="col-lg-3 col-md-6" key={i}>
                <div className="sigma_volunteers volunteers-4">
                    <div className="sigma_volunteers-thumb">
                        <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.name} />
                        <ul className={this.state.visible === item ? 'sigma_sm visible' : 'sigma_sm'}>
                            <li>
                                <Link to="#" className="trigger-volunteers-socials" onClick={(e) => this.socialTrigger(item)}>
                                    <i className="fal fa-plus" />
                                </Link>
                            </li>
                            {item.social.map((social, i) => (
                                <li key={i}>
                                    <a rel={"external"} href={social.text + "/" + item.name}><i className={social.icon} /></a>
                                </li>
                            ))}
                        </ul>
                    </div>
                    <div className="sigma_volunteers-body">
                        <div className="sigma_volunteers-info">
                            <p>{item.post}</p>
                            <h5>
                                <Link to={"/volunteer-details/" + item.id}>{item.name}</Link>
                            </h5>
                        </div>
                    </div>
                </div>
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
                <Quotecta />
                <Blogs />
            </Fragment>
        );
    }
}

export default Content;