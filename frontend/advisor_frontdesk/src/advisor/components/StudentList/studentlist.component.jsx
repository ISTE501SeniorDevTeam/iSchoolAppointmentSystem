import React from "react";
import { Student } from "../Student/student.component";
import "./studentlist.styles.css"

export const StudentList = (props) => (
    <div className="StudentContainer">
        {props.students.map(student => (
            <Student key={student.studentUID} student={student}></Student>
        ))}
    </div>
)