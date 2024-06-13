import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import volunteerblock from "../../../data/volunteer/volunteer.json";

class Volunteers extends Component {
    constructor(props) {
        super(props);
        this.state = {
            visible: null
        }
        this.socialTrigger = this.socialTrigger.bind(this);
    }
    socialTrigger(item) {
        this.setState({ visible: item });
        if (this.state.visible === item) {
            this.setState({ visible: null })
        }
    }
    render() {
        return (
            <div className="row">
                {/* Data */}
                {volunteerblock.slice(0, 2).map((item, i) => (
                    <div className="col-lg-6 col-md-6" key={i}>
                        <div className="sigma_volunteers volunteers-5">
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
                                    <h5 className="text-white">
                                        <Link to={"/volunteer-details/" + item.id}>{item.name}</Link>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
                {/* Data */}
            </div>
        );
    }
}

export default Volunteers;