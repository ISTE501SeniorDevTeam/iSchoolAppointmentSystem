import React, { useState } from "react";
import { Student } from "../Student/student.component";
import "./studentlist.styles.css"

export const StudentList = (props) => {
    
    return (
        <div className="StudentContainer">
            {props.students.map(student => (
                <Student
                    onClick={(data) => props.selectStudent(data)}
                    isActive={props.selectedStudent.studentUID === student.studentUID}
                    key={student.studentUID}
                    student={student}
                >
                    {student.isActive}
                    {/* {console.log(student.isActive)} */}
                </Student>

            ))}
        </div>
    )
}