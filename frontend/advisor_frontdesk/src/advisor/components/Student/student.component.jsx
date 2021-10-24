import React from "react";

import "./student.styles.css"

export const Student = (props) => (
    <button className="StudentNameButtonContainer">
            <span className="StudentName">{props.student.studentName}</span>
            {/* {console.log(props.student.studentName)} */}
    </button>
)