import React from "react";
import "./orangesidebar.styles.css";
import logo from "../../assets/images/Horizontal-Collapsed-Whitee.png";

export const OrangeSidebar = (props) => (
    <div className="Container">
            <div className="OrangeSection">
                <span className="WelcomeText">Welcome</span>
                <span className="AdvisorText">
                {props.advisor}
                </span>
                <span className="TechnicalSupportLink">Technical Support</span>
                <span className="SignOutLink">Sign Out</span>
                <div className="RITLogoContainer">
                <img className="RITLogo" src={logo} alt="Logo" />
                </div>
            </div>
            <div className="BlackSection">
                <span className="CurrentQueueText">
                    Current Queue
                </span>

            </div>


    </div>
)
    
