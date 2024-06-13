import React, { Component, Fragment } from 'react';
import { Link } from 'react-router-dom';
import sermonblock from '../../../data/sermon/sermon.json';
import { getFilteredItems } from '../../../helper/sermonHelper';
import { getAuthor } from '../../../helper/helper';
import Pagination from "react-js-pagination";
import Brands from '../../layouts/Brands';

class Content extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: this.getSermons(),
            activePage: 1,
            itemPerpage: 4
        }
    }
    getSermons() {
        var author = this.props.authorId ? this.props.authorId : '';
        var filteredItems = getFilteredItems(sermonblock, { author });
        return filteredItems;
    }
    handlePageChange(pageNumber) {
        this.setState({ activePage: pageNumber });
    }
    render() {
        const paginationData = this.state.data.slice((this.state.activePage - 1) * this.state.itemPerpage, this.state.activePage * this.state.itemPerpage).map((item, i) => {
            return <div key={i} className="col-lg-6">
                <div className="sigma_sermon-box">
                    <div className="sigma_sermon-image">
                        <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                    </div>
                    <div className="sigma_box">
                        <span className="subtitle">Latest Sermons</span>
                        <h4 className="title mb-0">
                            <Link to={"/sermon-details/" + item.id}>{item.title}</Link>
                        </h4>
                        <ul className="sigma_sermon-info mb-0">
                            {getAuthor(item.author).map((author, i) => (
                                <li key={i}>
                                    <i className="far fa-user" />
                                    Message From
                                    <Link to={"/sermon/author/" + author.id} className="ms-2"><u>{author.name}</u></Link>
                                </li>
                            ))}
                            <li className="mt-0 ms-4">
                                <i className="far fa-calendar-check" />
                                {item.sermondate}
                            </li>
                        </ul>
                        <ul className="sigma_sm square">
                            {/* Data */}
                            {item.social.map((social, i) => (
                                <li key={i}>
                                    <a rel={"external"} href={social.url}>
                                        <i className={social.icon} />
                                    </a>
                                </li>
                            ))}
                            {/* Data */}
                        </ul>
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
                <Brands />
            </Fragment>
        );
    }
}

export default Content;