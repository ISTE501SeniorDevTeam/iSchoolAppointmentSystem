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
      studentMajor:"Web and Mobile Computing",
      studentEmail:"sas1234@rit.edu",
      usualAdvisor:"Amy Advisor",
      modality:"In Person",
      reasonForVisit:"Change of Program"
  }, 
  {
      studentName:"Sam Student",
      studentUID:"987654321",
      studentMajor:"Human Centered Computing",
      studentEmail:"sys8392@g.rit.edu",
      usualAdvisor:"Andy Advisor",
      modality:"Online",
      reasonForVisit:"Request for Resource Info"
  }, 
  {
      studentName:"Garry Graduate",
      studentUID:"333333333",
      studentMajor:"Computing and Information Technologies",
      studentEmail:"gag3333@rit.edu",
      usualAdvisor:"Amy Advisor",
      modality:"In Person",
      reasonForVisit:"Graduation Questions"
  }, 
  {
      studentName:"Ursula Undergrad",
      studentUID:"444444444",
      studentMajor:"Human Centered Computing",
      studentEmail:"uru4444@gmail.com",
      usualAdvisor:"Andy Advisor",
      modality:"Online",
      reasonForVisit:"Update Worksheet"
  }, 
  {
      studentName:"Frank Freshmen",
      studentUID:"555555555",
      studentMajor:"Web and Mobile Computing",
      studentEmail:"frf5555@rit.edu",
      usualAdvisor:"Amy Advisor",
      modality:"In Person",
      reasonForVisit:"Next Semester Planning"
  }


]

class StudentOverview extends Component {
  constructor(props) {
    super(props);

    this.state = {
      advisor: "Amy Advisor",
      student: '',
    };
  }

  componentWillMount() {
    this.setState({ student: studentInfo[0] })
  }

  render() {
    console.log(this.state.student)
    return (
      <div className="flex-container">
        <BlackSidebar
          className="item2"
          listofstudents={studentInfo}
          student={this.state.student}
          setStudent={(data) => this.setState({ student: data })}
        />
        <StudentInfoPage
          className="item3"
          student={this.state.student}
        />
      </div>
    );
  }
}


export default StudentOverview;
