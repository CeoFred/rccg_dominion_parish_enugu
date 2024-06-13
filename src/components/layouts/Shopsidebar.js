import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import category from "../../data/category.json";
import IonRangeSlider from 'react-ion-slider'

class Shopsidebar extends Component {
    constructor(props) {
        super(props);
        this.state = {
            searchText: '',
            priceFilter: [1, 100],
            minPrice: 1,
            maxPrice: 0,
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
            this.props.history.push("/shop/search/" + this.state.searchText);
        }
    }
    // Price filter
    onPriceChange(event) {
        this.setState({
            minPrice: event.from,
            maxPrice: event.to
        })
        if (this.state.maxPrice !== 0 && this.state.minPrice !== 0) {
            this.props.history.push(`/shop/${this.state.minPrice}/${this.state.maxPrice}`);
        }
    }
    render() {
        return (
            <div className="sidebar">
                {/* Search Start */}
                <div className="sidebar-widget widget-search">
                    <h6 className="widget-title">Search</h6>
                    <form onSubmit={this.handleSubmit.bind(this)} method="Get">
                        <div className="sigma_search-adv-input">
                            <input type="text" className="form-control" placeholder="Look for Products" name="searchText" value={this.state.searchText} onChange={this.onChange.bind(this)} required />
                            <button type="submit"><i className="fa fa-search" /></button>
                        </div>
                    </form>
                </div>
                {/* Search End */}
                {/* Filter: Price Start */}
                <div className="sidebar-widget">
                    <h5 className="widget-title"> Price </h5>
                    <IonRangeSlider type="double" skin="flat" hide_min_max={true} min={1} max={100} from={this.state.priceFilter[0]} to={this.state.priceFilter[1]} grid={false} prefix="$" onChange={this.onPriceChange.bind(this)} />
                </div>
                {/* Filter: Price End */}
                {/* Tags Start */}
                <div className="sidebar-widget widget-categories">
                    <h5 className="widget-title"> Our Categories </h5>
                    <ul className="sidebar-widget-list">
                        {/* Data */}
                        {category.slice(0, 4).map((item, i) => (
                            <li key={i}>
                                <Link to={"/shop/cat/" + item.id}>{item.title} <span>{item.count}</span></Link>
                            </li>
                        ))}
                        {/* Data */}
                    </ul>
                </div>
                {/* Tags End */}
                {/* Ad banner Start */}
                <div className="sidebar-widget widget-ad p-0 border-0">
                    <Link to="#">
                        <img src={process.env.PUBLIC_URL + "/assets/img/blog/ad2.jpg"} alt="ad" />
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

export default withRouter(Shopsidebar);