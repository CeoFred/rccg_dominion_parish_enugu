import React,{Fragment} from 'react'
import Header from '../layouts/Headertwo';
import Footer from '../layouts/Footer';
import MetaTags from "react-meta-tags";

const pagelocation = "Testimony";

export default function Testimony() {
  return (
    <div>
       <Fragment>
                <MetaTags>
                    <title>RCCG Dominion Parish - Enugu Province 2. | {pagelocation}</title>
                    <meta
                        name="description"
                        content="#"
                    />
                </MetaTags>
                <Header />
                      <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSc-ULLuDlXkwm-HuPRbLh9sRxjewn54QthuYGr985qfoW_uHQ/viewform?embedded=true" width="100%" height="1090" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                <footer className="sigma_footer footer-2">
                    <Footer />
                </footer>
            </Fragment>

    </div>
  )
}
