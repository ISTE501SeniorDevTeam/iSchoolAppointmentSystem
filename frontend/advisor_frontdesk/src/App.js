import React, { Component } from "react";
import {OrangeSidebar} from "./advisor/components/OrangeSidebar/orangesidebar.component";
import StudentOverview from "./advisor/components/StudentOverview/studentoverview.component";
import './App.css';


// let advisors = [
//   "Amy Advisor",
//   "Sam Advisor",
//   "Betty Advisor"
// ];

class App extends Component{
  constructor(props){
    super(props);

    this.state = {
      advisor: "Amy Advisor",
      students:[]
    };
  }

  render(){
    return (
      <div className="flex-container">
       <OrangeSidebar className="item1" advisor={this.state.advisor}>
       </OrangeSidebar>
       <StudentOverview className="item2"></StudentOverview>
      </div>
      );
  }
}


export default App;
