import React, { Component } from "react";
import  BlackSidebar from "./advisor/components/BlackSidebar/blacksidebar.component";
import {OrangeSidebar} from "./advisor/components/OrangeSidebar/orangesidebar.component";
import './App.css';
import {StudentInfoPage}  from "./advisor/components/StudentInfoPage/studentinfopage.component";

// let advisors = [
//   "Amy Advisor",
//   "Sam Advisor",
//   "Betty Advisor"
// ];

class App extends Component{
  constructor(){
    super();

    this.state = {
      advisor: "Amy Advisor"
    };
  }

  render(){
    return (
      <div className="flex-container">
       <OrangeSidebar className="item1" advisor={this.state.advisor}>
       </OrangeSidebar>
       <BlackSidebar className="item2">
       </BlackSidebar>
       <StudentInfoPage className="item3">
       </StudentInfoPage>
      </div>
      );
  }
}


export default App;
