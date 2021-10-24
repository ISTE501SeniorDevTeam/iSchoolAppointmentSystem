import React from "react";

import "./student.styles.css"

export const Student = (props) => (
    <div className="StudentNameContainer">
            <span className="StudentName">{props.student.studentName}</span>
            {console.log(props.student.studentName)}
    </div>
)