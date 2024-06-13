import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { getPostByCategory, getBlog } from '../../../helper/blogHelper';
import { getAuthor, getTags, getCategories, socialShare } from '../../../helper/helper';
import Sidebar from '../../layouts/Blogsidebar';

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
        const item = getBlog(detailId);
        return (
            <div className="section sigma_post-single">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8">
                            <div className="post-detail-wrapper">
                                <div className="entry-content">
                                    <div className="sigma_post-meta">
                                        <div className="sigma_post-categories">
                                            {/* Data */}
                                            {getCategories(item.category).slice(0, 2).map((cat, i) => (
                                                <Link to={"/blog/cat/" + cat.id} className="sigma_post-category" key={i}>{cat.title}</Link>
                                            ))}
                                            {/* Data */}
                                        </div>
                                    </div>
                                    <h4 className="entry-title">{item.title}</h4>
                                    <div className="sigma_post-meta">
                                        <Link to={"/blog-details/" + item.id}> <i className="far fa-eye" /> {item.views} Views</Link>
                                        <Link to={"/blog-details/" + item.id}> <i className="far fa-comments" /> {item.reviews.length} Comments</Link>
                                        <Link to={"/blog-details/" + item.id}> <i className="far fa-calendar" /> {item.postdate}</Link>
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
                                                <Link to={"/blog/tag/" + tag.id} key={i}>{tag.title}</Link>
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
                                {/* Related Posts Start */}
                                <div className="section">
                                    <h5>Related Posts</h5>
                                    <div className="row">
                                        {/* Article Start */}
                                        {getPostByCategory(item.category, detailId).slice(0, 2).map((post, i) => (
                                            <div className="col-md-6" key={i}>
                                                <article className="sigma_post">
                                                    <div className="sigma_post-thumb">
                                                        <Link to={"/blog-details/" + post.id}>
                                                            <img src={process.env.PUBLIC_URL + "/" + post.image[0]} alt={post.title} />
                                                        </Link>
                                                    </div>
                                                    <div className="sigma_post-body">
                                                        <div className="sigma_post-meta">
                                                            <Link to={"/blog-details/" + post.id} className="sigma_post-date"> <i className="far fa-calendar" /> {post.postdate}</Link>
                                                        </div>
                                                        <h5> <Link to={"/blog-details/" + post.id}>{post.title}</Link> </h5>
                                                        <p>{post.shorttext.slice(0, 70)}</p>
                                                    </div>
                                                </article>
                                            </div>
                                        ))}
                                        {/* Article End */}
                                    </div>
                                </div>
                                {/* Related Posts End */}
                                {/* About Author Start */}
                                {getAuthor(item.author).map((author, i) => (
                                    <div className="section" key={i}>
                                        <div className="sigma_author-about">
                                            <img src={process.env.PUBLIC_URL + "/" + author.image} alt={author.name} />
                                            <div className="sigma_author-about-content">
                                                <span>Written By</span>
                                                <h3>{author.name}</h3>
                                                <div dangerouslySetInnerHTML={{ __html: author.htmltext.slice(0, 250) }} />
                                            </div>
                                        </div>
                                    </div>
                                ))}
                                {/* About Author End */}
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
                            {getAuthor(item.author).map((author, i) => (
                                <div className="sidebar" key={i} style={{ marginBottom: 30 + 'px' }}>
                                    {/* About Author Start */}
                                    <div className="sidebar-widget widget-about-author">
                                        <h5 className="widget-title">About Me</h5>
                                        <div className="widget-about-author-inner">
                                            <img src={process.env.PUBLIC_URL + "/" + author.image} alt={author.name} />
                                            <h5>{author.name}</h5>
                                            <div dangerouslySetInnerHTML={{ __html: author.htmltext.slice(0, 150) }} />
                                            <ul className="sigma_sm">
                                                {/* Data */}
                                                {author.social.map((social, i) => (
                                                    <li key={i}>
                                                        <a rel={"external"} href={social.text + "/" + author.name}><i className={social.icon} /></a>
                                                    </li>
                                                ))}
                                                {/* Data */}
                                            </ul>
                                        </div>
                                    </div>
                                    {/* About Author End */}
                                </div>
                            ))}
                            <Sidebar />
                        </div>
                        {/* Sidebar End */}
                    </div>
                </div>
            </div>
        );
    }
}

export default Content;