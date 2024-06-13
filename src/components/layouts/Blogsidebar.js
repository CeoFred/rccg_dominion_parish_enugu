import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import tags from "../../data/tags.json";
import category from "../../data/category.json";
import feeds from "../../data/feeds.json";
import instagram from "../../data/insta.json";
import { getRecentPost } from "../../helper/blogHelper";

class Blogsidebar extends Component {
    constructor(props) {
        super(props);
        this.state = {
            searchText: ''
        };
    }
    // Search Filter
    onChange(event) {
        this.setState({ searchText: event.target.value })
    }
    handleSubmit(e) {
        e.preventDefault();
        //const { history } = this.props;
        if (this.state.searchText === "") {
            return;
        } else {
            this.props.history.push("/blog/search/" + this.state.searchText);
        }
    }
    render() {
        return (
            <div className="sidebar">
                {/* Search Widget Start */}
                <div className="sidebar-widget widget-search">
                    <h5 className="widget-title">Search</h5>
                    <form onSubmit={this.handleSubmit.bind(this)} method="Get">
                        <div className="sigma_search-adv-input">
                            <input type="text" className="form-control" placeholder="Search Posts" name="searchText" value={this.state.searchText} onChange={this.onChange.bind(this)} required />
                            <button type="submit"><i className="fa fa-search" /></button>
                        </div>
                    </form>
                </div>
                {/* Search Widget End */}
                {/* Popular Feed Start */}
                <div className="sidebar-widget widget-recent-posts">
                    <h5 className="widget-title">Recent Posts</h5>
                    {/* Data */}
                    {getRecentPost().map((item, i) => (
                        <article className="sigma_recent-post" key={i}>
                            <Link to={"/blog-details/" + item.id}>
                                <img src={process.env.PUBLIC_URL + "/" + item.image[0]} alt={item.title} />
                            </Link>
                            <div className="sigma_recent-post-body">
                                <h6> <Link to={"/blog-details/" + item.id}>{item.title}</Link> </h6>
                                <Link to={"/blog-details/" + item.id}> <i className="far fa-calendar" /> {item.postdate}</Link>
                            </div>
                        </article>
                    ))}
                    {/* Data */}
                </div>
                {/* Popular Feed End */}
                {/* Categories Start */}
                <div className="sidebar-widget widget-categories">
                    <h5 className="widget-title"> Our Categories </h5>
                    <ul className="sidebar-widget-list">
                        {/* Data */}
                        {category.map((item, i) => (
                            <li key={i}>
                                <Link to={"/blog/cat/" + item.id}>{item.title} <span>{item.count}</span></Link>
                            </li>
                        ))}
                        {/* Data */}
                    </ul>
                </div>
                {/* Categories End */}
                {/* Social Media Start */}
                <div className="sidebar-widget">
                    <h5 className="widget-title">Never Miss Out</h5>
                    <ul className="sigma_sm square light">
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
                {/* Social Media End */}
                {/* Twitter Feed Start */}
                <div className="sidebar-widget widget-twitter">
                    <h5 className="widget-title">Twitter Feed</h5>
                    {/* Data */}
                    {feeds.map((item, i) => (
                        <div className="twitter-item d-flex align-items-start" key={i}>
                            <i className="fab fa-twitter custom-primary me-4 mt-2" />
                            <div className="twitter-item-content">
                                <p>{item.tweet}</p>
                                <strong>{item.date}</strong>
                            </div>
                        </div>
                    ))}
                    {/* Data */}
                </div>
                {/* Twitter Feed End */}
                {/* Instagram Start */}
                <div className="sidebar-widget widget-ig">
                    <h5 className="widget-title">Instagram</h5>
                    <div className="row">
                        {/* Data */}
                        {instagram.slice(0, 9).map((item, i) => (
                            <div className="col-lg-4 col-md-4 col-sm-4 col-6" key={i}>
                                <Link to="#" className="sigma_ig-item">
                                    <img src={process.env.PUBLIC_URL + "/" + item.image} alt="ig" />
                                </Link>
                            </div>
                        ))}
                        {/* Data */}
                    </div>
                </div>
                {/* Instagram End */}
                {/* Popular Tags Start */}
                <div className="sidebar-widget">
                    <h5 className="widget-title">Popular Tags</h5>
                    <div className="tagcloud">
                        {/* Data */}
                        {tags.map((item, i) => (
                            <Link to={"/blog/tag/" + item.id} key={i}>{item.title}</Link>
                        ))}
                        {/* Data */}
                    </div>
                </div>
                {/* Popular Tags End */}
                {/* Ad banner Start */}
                <div className="sidebar-widget widget-ad p-0 border-0">
                    <Link to="#">
                        <img src={process.env.PUBLIC_URL + "/assets/img/blog/ad.jpg"} alt="ad" />
                        <div>
                            <span>Add a Custom Text</span>
                            Add Banner here
                        </div>
                    </Link>
                </div>
                {/* Ad banner End */}
            </div>
        );
    }
}

export default withRouter(Blogsidebar);