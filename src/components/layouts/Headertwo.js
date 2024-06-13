import React, { Fragment } from 'react';
import Navhelper from "../../helper/Navhelper";
import Canvas from "./Canvas";
import Mobilemenu from "./Mobilemenu";
import { Link } from 'react-router-dom';
import navigation from '../../data/navigation.json';

class Headertwo extends Navhelper {
    render() {
        const stickyHeader = this.state.stickyHeader ? ' sticky' : '';
        return (
            <Fragment>
                {/* partial:partia/__sidenav.html */}
                <aside className={this.state.canvasMethod === true ? 'sigma_aside sigma_aside-right sigma_aside-right-panel sigma_aside-bg open' : 'sigma_aside sigma_aside-right sigma_aside-right-panel sigma_aside-bg'}>
                    <Canvas />
                </aside>
                <div className="sigma_aside-overlay aside-trigger-right" onClick={this.toggleCanvas} />
                {/* partial */}
                {/* partial:partia/__mobile-nav.html */}
                <aside className={this.state.navMethod === true ? 'sigma_aside sigma_aside-left open' : 'sigma_aside sigma_aside-left'}>
                    <Mobilemenu />
                </aside>
                <div className="sigma_aside-overlay aside-trigger-left" onClick={this.toggleNav} />
                {/* partial */}
                {/* Search Start */}
                <div className={this.state.searchMethod === true ? 'sigma_search-form-wrapper open' : 'sigma_search-form-wrapper'}>
                    <div className="sigma_search-trigger close-btn" onClick={this.toggleSearch}>
                        <span />
                        <span />
                    </div>
                    <form className="sigma_search-form">
                        <input type="text" placeholder="Search..." />
                        <button type="submit" className="sigma_search-btn">
                            <i className="fal fa-search" />
                        </button>
                    </form>
                </div>
                {/* Search End */}
                {/* partial:partia/__header.html */}
                <header className={"sigma_header header-2 can-sticky" + stickyHeader}>
                    {/* Middle Header Start */}
                    <div className="sigma_header-middle">
                        <nav className="navbar">
                            {/* Controls */}
                            <div className="sigma_header-controls style-2">
                                <ul className="sigma_header-controls-inner">
                                    {/* Desktop Toggler */}
                                    <li className="aside-toggler style-2 aside-trigger-right desktop-toggler" onClick={this.toggleCanvas}>
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                    </li>
                                    {/* Mobile Toggler */}
                                    <li className="aside-toggler style-2 aside-trigger-left" onClick={this.toggleNav}>
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                        <span />
                                    </li>
                                </ul>
                            </div>
                            {/* Menu */}
                            <ul className="navbar-nav">
                                {/* Data */}
                                {navigation.map((item, i) => (
                                    <li key={i} className={item.child === true ? 'menu-item menu-item-has-children' : 'menu-item'}>
                                        {item.child === true ?
                                            <Link to="#">{item.linkText}</Link>
                                            :
                                            <Link to={item.link}>{item.linkText}</Link>
                                        }
                                        {item.child === true ?
                                            <ul className="sub-menu">
                                                {item.submenu.map((item, i) => (
                                                    <li key={i} className={item.child === true ? 'menu-item menu-item-has-children' : 'menu-item'}>
                                                        {item.child === true ?
                                                            <Link to="#">{item.linkText}</Link>
                                                            :
                                                            <Link to={item.link}>{item.linkText}</Link>
                                                        }
                                                        {item.child === true ?
                                                            <ul className="sub-menu">
                                                                {item.submenu.map((item, i) => (
                                                                    <li className="menu-item" key={i}>
                                                                        <Link to={item.link}>{item.linkText}</Link>
                                                                    </li>
                                                                ))}
                                                            </ul>
                                                            : ''}
                                                    </li>
                                                ))}
                                            </ul>
                                            : ''}
                                    </li>
                                ))}
                                {/* Data */}
                            </ul>
                            {/* Logo Start */}
                            <div className="sigma_logo-wrapper">
                                <Link to="/" className="navbar-brand">
                                    <img src={process.env.PUBLIC_URL + "/assets/img/logo.png"} alt="logo" />
                                </Link>
                            </div>
                            {/* Logo End */}
                            {/* Button & Phone */}
                            <div className="sigma_header-controls sigma_header-button">
                                <a rel={"external"} href="tel:+123456789" className="sigma_header-contact">
                                    <i className="flaticon-telephone" />
                                    <div className="sigma_header-contact-inner">
                                        <span>Get Support</span>
                                        <h6>987-879-428-48</h6>
                                    </div>
                                </a>
                                <Link to="/donation" className="sigma_btn-custom"> Donate Now </Link>
                            </div>
                            {/* Controls */}
                            <div className="sigma_header-controls style-1">
                                <Link to="#" className="sigma_search-trigger" onClick={this.toggleSearch}> <i className="flaticon-magnifying-glass" /> </Link>
                            </div>
                        </nav>
                    </div>
                    {/* Middle Header End */}
                </header>
                {/* partial */}
            </Fragment>
        );
    }
}

export default Headertwo;