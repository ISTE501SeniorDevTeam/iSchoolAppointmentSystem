import React from "react";

import "./student.styles.css"

let selectedStudent = () =>{
    
}

export const Student = (props) => (
    <button onClick={selectedStudent} className="StudentNameButtonContainer">
            <span className="StudentName">{props.student.studentName}</span>
            {/* {console.log(props.student.studentName)} */}
    </button>


)