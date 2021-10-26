import React, { useState } from "react";

import "./student.styles.css"


//   const SelectedStudent = () => {
//     const [isActive, setActive] = useState("false");
//     setActive(!isActive); 
//    };

export const Student = (props) => {
    const [isActive, setActive] = useState("false");

    const SelectedStudent = () => {
        setActive(!isActive); 
    };
    
    return(
    <button onClick={SelectedStudent} 
    className={"StudentNameButtonContainer"}>
            <span className="StudentName">{props.student.studentName}</span>
            {/* {console.log(props.student.studentName)} */}
    </button>
    )

}
