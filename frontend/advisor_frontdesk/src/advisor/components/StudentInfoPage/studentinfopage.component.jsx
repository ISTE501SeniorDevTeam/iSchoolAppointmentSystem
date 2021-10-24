import React from "react";
// import { Student } from "../Student/student.component";
import "./studentinfopage.styles.css"

export const StudentInfoPage = (props) => (
    <div className= "StudentInfoPageContainer">
      <div className= "StudentInfoContainer">
        <div className= "StudentInfoPage"
        ></div>
        <div className= "StudentInfoNameContainer">
          <span className= "StudentNameText">Sam Student</span>
        </div>
        <span className= "StudentMajorText">Major</span>
        <span className= "StudentEmailText">email</span>
        <span className= "StudentUIDText">UID</span>
        <div className= "UsualAdvisorContainer">
          <span className= "UsualAdvisorText">Usual Advisor</span>
        </div>
        <span className= "VariableUsualAdvisor">Adam Advisor</span>
        <div className= "StudentModalityContainer">
          <span className= "StudentModalityText">Student Modality</span>
        </div>
        <span className= "VariableModality">In Person</span>
        <div className= "StudentReasonForVisitContainer">
          <span className= "StudentReasonForVisitText">Reason for Visit</span>
        </div>
        <span className= "VariableReasonForVisit">Request for Resource Info</span>
        <div className= "StartMeetingContainer">
          <span className= "StartMeetingText" >Start Meeting</span>
        </div>
        {/* <span className= "VariableUsualAdvisor">Adam Advisor</span> */}
        {/* <span className= "VariableModality">In Person</span> */}
        {/* <span className= "VariableReasonForVisit">Request for Resource Info</span> */}
      </div>
    </div>
)