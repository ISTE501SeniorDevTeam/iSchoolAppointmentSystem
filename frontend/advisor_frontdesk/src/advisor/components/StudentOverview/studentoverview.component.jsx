import React, { Component } from "react";
import  BlackSidebar from "../BlackSidebar/blacksidebar.component";
import './studentoverview.styles.css';
import {StudentInfoPage}  from "../StudentInfoPage/studentinfopage.component";

// let advisors = [
//   "Amy Advisor",
//   "Sam Advisor",
//   "Betty Advisor"
// ];

let studentInfo = [
  {
      studentName:"Sally Student",
      studentUID:"123456789",
      studentMajor:"",
      studentEmail:"",
      usualAdvisor:"",
      modality:"",
      reasonForVisit:""
  }, 
  {
      studentName:"Sam Student",
      studentUID:"987654321",
      studentMajor:"Human Centered Computing",
      studentEmail:"sys8392@g.rit.edu",
      usualAdvisor:"Amy Advisor",
      modality:"In Person",
      reasonForVisit:"Request for Resource Info"
  }, 
  {
      studentName:"Garry Graduate",
      studentUID:"333333333",
      studentMajor:"",
      studentEmail:"",
      usualAdvisor:"",
      modality:"",
      reasonForVisit:""
  }, 
  {
      studentName:"Ursula Undergrad",
      studentUID:"444444444",
      studentMajor:"",
      studentEmail:"",
      usualAdvisor:"",
      modality:"",
      reasonForVisit:""
  }, 
  {
      studentName:"Frank Freshmen",
      studentUID:"555555555",
      studentMajor:"",
      studentEmail:"",
      usualAdvisor:"",
      modality:"",
      reasonForVisit:""
  }


]

class StudentOverview extends Component{
  constructor(props){
    super(props);

    this.state = {
      advisor: "Amy Advisor",
      students:[]
    };
  }

  componentWillMount(){
    this.setState({students:studentInfo})
  }

  render(){
    return (
      <div className="flex-container">
       <BlackSidebar className="item2" listofstudents={this.state.students}>
       </BlackSidebar>
       <StudentInfoPage className="item3" student={this.state.students}>
       </StudentInfoPage>
      </div>
      );
  }
}


export default StudentOverview;
