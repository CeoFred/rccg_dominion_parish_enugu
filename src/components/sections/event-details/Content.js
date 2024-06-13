import React, { Component } from 'react';
import { getEvent, getDateInitials } from '../../../helper/eventHelper';
import { getAuthor, getTags, getSpeaker, socialShare } from '../../../helper/helper';
import Sidebar from '../../layouts/Eventsidebar';
import { Accordion, Card, Button } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import Countdown from 'react-countdown';

// Random component
const Completionist = () => <span>You are good to go!</span>;

// Renderer callback with condition
const renderer = ({ days, hours, minutes, seconds, completed }) => {
    if (completed) {
        // Render a completed state
        return <Completionist />;
    } else {
        // Render a countdown
        return <ul className="sigma_countdown-timer">
            <li>
                <h5 className="days">{days}</h5>
                <span>Days</span>
            </li>
            <li>
                <h5 className="hours">{hours}</h5>
                <span>Hours</span>
            </li>
            <li>
                <h5 className="minutes">{minutes}</h5>
                <span>Minutes</span>
            </li>
            <li>
                <h5 className="seconds">{seconds}</h5>
                <span>Seconds</span>
            </li>
        </ul>;
    }
};

class Content extends Component {
    constructor(props) {
        super(props);
        this.openSocialPopup = this.openSocialPopup.bind(this);
    }
    // Open window
    openSocialPopup(social) {
        window.open(social.link, "MsgWindow", "width=600,height=600")
        // alert(social.title)
    }
    render() {
        const detailId = this.props.detailId;
        const item = getEvent(detailId);
        return (
            <div className="section sigma_post-single">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8">
                            <div className="post-detail-wrapper">
                                <div className="entry-content">
                                    <a rel={"external"} href={process.env.PUBLIC_URL + "/" + item.image} className="gallery-thumb">
                                        <img src={process.env.PUBLIC_URL + "/" + item.image} alt={item.title} />
                                        <div className="sigma_event-timer">
                                            <div className="sigma_event-date" dangerouslySetInnerHTML={{ __html: getDateInitials(item.eventdate) }} />
                                            <Countdown
                                                date={new Date().setDate(new Date().getDate() + 5)}
                                                renderer={renderer}
                                            />
                                        </div>
                                    </a>
                                    <h4>{item.title}</h4>
                                    <div className="sigma_post-meta">
                                        <Link to={"/event-details/" + item.id}> <i className="far fa-clock" />
                                            {item.eventtime}</Link>
                                        <Link to={"/event-details/" + item.id}> <i className="far fa-map-marker-alt" />
                                            {item.location}</Link>
                                    </div>
                                    <div dangerouslySetInnerHTML={{ __html: item.htmltext }} />
                                </div>
                                {/* Post Meta Start */}
                                <div className="sigma_post-single-meta">
                                    <div className="sigma_post-single-meta-item">
                                        <h6>Tags</h6>
                                        <div className="tagcloud">
                                            {/* Data */}
                                            {getTags(item.tags).slice(0, 3).map((tag, i) => (
                                                <Link to={"/event/tag/" + tag.id} key={i}>{tag.title}</Link>
                                            ))}
                                            {/* Data */}
                                        </div>
                                    </div>
                                    <div className="sigma_post-single-meta-item sigma_post-share">
                                        <h6>Share</h6>
                                        <ul className="sigma_sm">
                                            {/* Data */}
                                            {socialShare(item.title).map((social, i) => (
                                                <li key={i}>
                                                    <Link to="#" onClick={(e) => this.openSocialPopup(social, i)}>
                                                        <i className={social.iconClass} />
                                                    </Link>
                                                </li>
                                            ))}
                                            {/* Data */}
                                        </ul>
                                    </div>
                                </div>
                                {/* Post Meta End */}
                                {/* Post Pagination Start */}
                                <div className="section">
                                </div>
                                {/* Post Pagination End */}
                                {/* Comments Start */}
                                <div className="section">
                                    <h5>{item.reviews.length} Comments</h5>
                                    <div className="comments-list">
                                        <ul>
                                            {/* Data */}
                                            {item.reviews.map((review, i) => (
                                                <li className="comment-item" key={i}>
                                                    {getAuthor(review.user).map((user, i) => (
                                                        <img key={i} src={process.env.PUBLIC_URL + "/" + user.image} alt={user.name} />
                                                    ))}
                                                    {getAuthor(review.user).map((user, i) => (
                                                        <div className="comment-body" key={i}>
                                                            <h5>{user.name}</h5>
                                                            <span> <i className="far fa-clock" /> {review.commentdate}</span>
                                                            <p>{review.comment}</p>
                                                            <Link to="#" className="btn-link"> Reply <i className="far fa-reply" /> </Link>
                                                        </div>
                                                    ))}
                                                </li>
                                            ))}
                                            {/* Data */}
                                        </ul>
                                    </div>
                                </div>
                                <div className="section">
                                    <h5>Leave a Comment</h5>
                                    <div className="comment-form">
                                        <form>
                                            <div className="form-group">
                                                <textarea className="form-control" placeholder="Enter your Message" name="comment" rows={7} />
                                            </div>
                                            <div className="form-group">
                                                <i className="far fa-user custom-primary" />
                                                <input type="text" placeholder="Full Name" className="form-control" name="fname" />
                                            </div>
                                            <div className="form-group">
                                                <i className="far fa-envelope custom-primary" />
                                                <input type="email" placeholder="Email Address" className="form-control" name="email" />
                                            </div>
                                            <div className="form-group">
                                                <i className="far fa-globe custom-primary" />
                                                <input type="text" placeholder="Website" className="form-control" name="website" />
                                            </div>
                                            <button type="submit" className="sigma_btn-custom" name="button">Post Comment <i className="far fa-comments" /> </button>
                                        </form>
                                    </div>
                                </div>
                                {/* Comments End */}
                            </div>
                        </div>
                        {/* Sidebar Start */}
                        <div className="col-lg-4">
                            <div className="sidebar">
                                {/* About Author Start */}
                                <div className="sidebar-widget event-info">
                                    <h5 className="widget-title"> Information </h5>
                                    <ul className="sidebar-widget-list">
                                        <li><span>Date:</span> {item.eventdate}</li>
                                        <li><span>Time:</span> {item.eventtime}</li>
                                        <li><span>Location:</span> {item.location}</li>
                                        <li><span>Organizer:</span> {item.organizer}</li>
                                        <li><span>Phone:</span> {item.phone}</li>
                                        <li><span>Email:</span> {item.email}</li>
                                    </ul>
                                    <button type="button" className="sigma_btn-custom d-block w-100 mt-4">Book Now</button>
                                </div>
                                {/* About Author End */}
                                {/* Popular Feed Start */}
                                <div className="sidebar-widget widget-recent-posts widget widget-speakers">
                                    <h5 className="widget-title">Speakers</h5>
                                    <Accordion defaultActiveKey={1} className="accordion">
                                        {getSpeaker(item.speakers).map((faq, i) => (
                                            <Card key={i}>
                                                <Accordion.Collapse eventKey={1 + i} className="collapseparent">
                                                    <Card.Body>
                                                        <div dangerouslySetInnerHTML={{ __html: faq.htmltext.slice(0, 200) }} />
                                                    </Card.Body>
                                                </Accordion.Collapse>
                                                <Card.Header>
                                                    <Accordion.Toggle as={Button} variant="link" eventKey={1 + i}>
                                                        <article className="sigma_recent-post">
                                                            <div className="speaker-image"><img src={process.env.PUBLIC_URL + "/" + faq.image} alt={faq.name} /></div>
                                                            <div className="sigma_recent-post-body">
                                                                <h6> {faq.name}</h6>
                                                                <p className="m-0">{faq.post}</p>
                                                            </div>
                                                        </article>
                                                    </Accordion.Toggle>
                                                </Card.Header>
                                            </Card>
                                        ))}
                                    </Accordion>
                                </div>
                                {/* Popular Feed End */}
                                <Sidebar />
                            </div>
                        </div>
                        {/* Sidebar End */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Content;