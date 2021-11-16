import React from "react";
import "./studentinfopage.styles.css"

export const StudentInfoPage = (props) => (
  <div className="StudentInfoPageContainer">
    <div className="StudentInfoContainer">
      <div className="StudentInfoPage"
      ></div>
      <div className="StudentInfoNameContainer">
        <span className="StudentNameText"> {props.student?.studentName}
        </span>
      </div>
      <span className="StudentMajorText">{props.student?.studentMajor}</span>
      <span className="StudentEmailText">{props.student?.studentEmail}</span>
      <span className="StudentUIDText">{props.student?.studentUID}</span>
      <div className="UsualAdvisorContainer">
      {/* <div className="LeftCut" /> */}
        <span className="UsualAdvisorText">Usual Advisor</span>
      </div>
      <span className="VariableUsualAdvisor">{props.student?.usualAdvisor}</span>
      <div className="StudentModalityContainer">
        <span className="StudentModalityText">Student Modality</span>
      </div>
      <span className="VariableModality">{props.student?.modality}</span>
      <div className="StudentReasonForVisitContainer">
        <span className="StudentReasonForVisitText">Reason for Visit</span>
      </div>
      <span className="VariableReasonForVisit">{props.student?.reasonForVisit}</span>
      <button className="StartMeetingContainer">
        <span className="StartMeetingText" >Start Meeting</span>
      </button>
    </div>
  </div>
)