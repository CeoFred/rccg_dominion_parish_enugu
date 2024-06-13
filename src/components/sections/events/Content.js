import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import eventblock from '../../../data/event/event.json';
import { getFilteredItems, getDateInitials } from '../../../helper/eventHelper';
import Sidebar from '../../layouts/Blogsidebar';
import Pagination from "react-js-pagination";

class Content extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: this.getEvents(),
            activePage: 1,
            itemPerpage: 4
        }
    }
    getEvents() {
        var tag = this.props.tagId ? this.props.tagId : '';
        var speaker = this.props.speakerId ? this.props.speakerId : '';
        var filteredItems = getFilteredItems(eventblock, { tag, speaker });
        return filteredItems;
    }
    handlePageChange(pageNumber) {
        this.setState({ activePage: pageNumber });
    }
    render() {
        const paginationData = this.state.data.slice((this.state.activePage - 1) * this.state.itemPerpage, this.state.activePage * this.state.itemPerpage).map((item, i) => {
            return <article key={i} className="sigma_post sigma_post-list event-list">
                <div className="sigma_post-thumb">
                    <Link to={"/event-details/" + item.id}>
                        <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                    </Link>
                    <div className="event-date-wrapper" dangerouslySetInnerHTML={{ __html: getDateInitials(item.eventdate) }} />
                </div>
                <div className="sigma_post-body">
                    <h5> <Link to={"/event-details/" + item.id}>{item.title}</Link> </h5>
                    <p>{item.shorttext}</p>
                    <div className="sigma_post-meta">
                        <Link to={"/event-details/" + item.id}> <i className="far fa-clock" />
                            {item.eventtime}</Link>
                        <Link to={"/event-details/" + item.id}> <i className="far fa-map-marker-alt" />
                            {item.location}</Link>
                    </div>
                    <div className="section-button d-flex align-items-center">
                        <Link to={"/event-details/" + item.id} className="sigma_btn-custom">Join Now <i className="far fa-arrow-right" /> </Link>
                    </div>
                </div>
            </article>
        });
        return (
            <div className="section">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8">
                            {/* Article Start */}
                            {paginationData}
                            {/* Article End */}
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
                        <div className="col-lg-4">
                            <Sidebar />
                        </div>
                    </div>
                </div>
            </div>

        );
    }
}

export default Content;