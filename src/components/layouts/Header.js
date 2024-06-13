import React, { Fragment } from 'react';
import Navhelper from "../../helper/Navhelper";
import Canvas from "./Canvas";
import Mobilemenu from "./Mobilemenu";
import Smallcart from "./Smallcart";
import Smallwishlist from "./Smallwishlist";
import { Link } from 'react-router-dom';
import navigation from '../../data/navigation.json';
import navigationtwo from '../../data/smallnav.json';

const cartlength = 5;

class Header extends Navhelper {
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
                {/* partial:partia/__header.html */}
                <header className={"sigma_header header-4 can-sticky header-absolute" + stickyHeader}>
                    {/* Top Header Start */}
                    <div className="sigma_header-top">
                        <div className="container-fluid">
                            <div className="sigma_header-top-inner">
                                <ul className="sigma_header-top-links">
                                    <li className="menu-item"> <a rel={"external"} href="tel:+123456789"> <i className="fal fa-phone" /> (+123) 123 4567
                                        890</a> </li>
                                    <li className="menu-item"> <a rel={"external"} href="mailto:info@example.com"> <i className="fal fa-envelope" />
                                        info@domain.com</a> </li>
                                </ul>
                                <div className="sigma_header-middle">
                                    <div className="navbar p-0 shadow-none bg-transparent">
                                        <ul className="navbar-nav">
                                            {/* Data */}
                                            {navigationtwo.map((item, i) => (
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
                                    </div>
                                </div>
                                <ul className="sigma_sm">
                                    <li className="d-flex align-items-center">
                                        <Link to="/broadcast" className="live">
                                            <i className="fa fa-circle" />
                                            Live
                                        </Link>
                                    </li>
                                    <li> <Link to="#"> <i className="fab fa-facebook-f" /> </Link> </li>
                                    <li> <Link to="#"> <i className="fab fa-twitter" /> </Link> </li>
                                    <li> <Link to="#"> <i className="fab fa-instagram" /> </Link> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {/* Top Header End */}
                    {/* Middle Header Start */}
                    <div className="sigma_header-middle">
                        <div className="container-fluid">
                            <nav className="navbar">
                                {/* Logo Start */}
                                <div className="sigma_logo-wrapper">
                                    <Link to="/" className="navbar-brand">
                                        <img src={process.env.PUBLIC_URL + "/assets/img/logo.png"} alt="logo" />
                                    </Link>
                                </div>
                                {/* Logo End */}
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
                                {/* Controls */}
                                <div className="sigma_header-controls style-2">
                                    <ul className="sigma_header-controls-inner">
                                        <li className="style-2 d-none d-xl-block">
                                            <Link to="#">
                                                <i className="flaticon-bible" />
                                            </Link>
                                        </li>
                                        <li className="sigma_header-cart style-2">
                                            <Link to="/cart"> <i className="flaticon-shopping-cart" /> </Link>
                                            <span className="number">{cartlength}</span>
                                            <ul className="cart-dropdown">
                                                <Smallcart />
                                            </ul>
                                        </li>
                                        <li className="sigma_header-wishlist style-2">
                                            <Link to="/wishlist"> <i className="flaticon-heart" /> </Link>
                                            <ul className="cart-dropdown">
                                                <Smallwishlist />
                                            </ul>
                                        </li>
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
                            </nav>
                        </div>
                    </div>
                    {/* Middle Header End */}
                </header>
                {/* partial */}
            </Fragment>
        );
    }
}

export default Header;