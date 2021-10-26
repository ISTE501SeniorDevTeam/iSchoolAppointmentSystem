import React, {useState} from "react";
import { Student } from "../Student/student.component";
import "./studentlist.styles.css"

export const StudentList = (props) => {
    const [isActive, setActive] = useState("false");

    const SelectedStudent = () => {
        setActive(!isActive); 
    };

    // <div key={student.studentUID} className={`StudentNameContainer ${student.isActive ? "active" : ""}` }></div>

    // <span className="StudentName">{student.studentName}{student.isActive}</span>

    return(
    <div className="StudentContainer">
        {props.students.map(student => (
            <Student onClick={SelectedStudent} key={student.studentUID} student={student} className={`StudentNameContainer ${student.isActive ? "active" : ""}`}>{student.isActive}
            {console.log(student.isActive)}
            </Student>
            
        ))}
    </div>
)}