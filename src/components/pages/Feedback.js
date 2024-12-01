import React,{Fragment} from 'react'
import Header from '../layouts/Headertwo';
import Footer from '../layouts/Footer';
import MetaTags from "react-meta-tags";

const pagelocation = "Service Feedback";

export default function Feedback() {
  return (
    <div>
       <Fragment>
                <MetaTags>
                    <title>RCCG Dominion Parish - Enugu Province 2. | {pagelocation}</title>
                    <meta property="og:title" content={`RCCG Dominion Parish - Enugu Province 2. | ${pagelocation}`} />
                    <meta
                        name="description"
                        content="Share your feedback on today’s service at RCCG Dominion Parish! Your insights help us enhance our worship experience and better serve our community. Complete the quick form to let us know what you loved and what we can improve. Together, we can grow in faith and fellowship."
                    />
                </MetaTags>
                <Header />
                      <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeF-m1PppjYWyRNrEl86FWv_3RAS_6c9zD7Kuabkd-iPLT-xg/viewform?usp=sf_link" width="100%" height="1271" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                <footer className="sigma_footer footer-2">
                    <Footer />
                </footer>
            </Fragment>

    </div>
  )
}
