import React from "react";
import "./studentinfopage.styles.css"

export const StudentInfoPage = (props) => (
    <div className= "StudentInfoPageContainer">
      <div className= "StudentInfoContainer">
        <div className= "StudentInfoPage"
        ></div>
        <div className= "StudentInfoNameContainer">
          <span className= "StudentNameText"> {props.student[1].studentName}
          </span>
        </div>
        <span className= "StudentMajorText">{props.student[1].studentMajor}</span>
        <span className= "StudentEmailText">{props.student[1].studentEmail}</span>
        <span className= "StudentUIDText">{props.student[1].studentUID}</span>
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
        <button className= "StartMeetingContainer">
          <span className= "StartMeetingText" >Start Meeting</span>
        </button>
      </div>
    </div>
)