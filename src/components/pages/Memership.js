import React,{Fragment} from 'react'
import Header from '../layouts/Headertwo';
import Footer from '../layouts/Footer';
import MetaTags from "react-meta-tags";

const pagelocation = "Membership";

export default function Membership() {
  return (
    <div>
       <Fragment>
                <MetaTags>
                    <title>RCCG Dominion Parish - Enugu Province 2. | {pagelocation}</title>
                    <meta
                        name="description"
                        content="Dear Member, thank you for taking the time to complete this form. The information collected will help us better serve our congregation and keep our records up-to-date. Your data will be kept confidential and used solely for church purposes."
                    />
                </MetaTags>
                <Header />
                      <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdLzH3gieceHh-DHcEOErscMHbaRcOpnRVKGioMVuoro06Pow/viewform?embedded=true" width="100%" height="1271" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                <footer className="sigma_footer footer-2">
                    <Footer />
                </footer>
            </Fragment>

    </div>
  )
}
