import React, { Component } from "react";
import "./blacksidebar.styles.css";
import {StudentList} from "../StudentList/studentlist.component"

let studentInfo = [
    {
        studentName:"Sally Student",
        studentUID:"123456789",
        studentMajor:"",
        studentEmail:"",
        usualAdvisor:"",
        modality:"",
        reasonForVisit:""
    }, 
    {
        studentName:"Sam Student",
        studentUID:"987654321",
        studentMajor:"Human Centered Computing",
        studentEmail:"sys8392@g.rit.edu",
        usualAdvisor:"Amy Advisor",
        modality:"In Person",
        reasonForVisit:"Request for Resource Info"
    }, 
    {
        studentName:"Garry Graduate",
        studentUID:"333333333",
        studentMajor:"",
        studentEmail:"",
        usualAdvisor:"",
        modality:"",
        reasonForVisit:""
    }, 
    {
        studentName:"Ursula Undergrad",
        studentUID:"444444444",
        studentMajor:"",
        studentEmail:"",
        usualAdvisor:"",
        modality:"",
        reasonForVisit:""
    }, 
    {
        studentName:"Frank Freshmen",
        studentUID:"555555555",
        studentMajor:"",
        studentEmail:"",
        usualAdvisor:"",
        modality:"",
        reasonForVisit:""
    }


]

class BlackSidebar extends Component{
    constructor(){
        super();
    
        this.state = {
          students:[]
          
        };
    }

    // selectStudent = (studentUID) => {
        
    // }

    componentDidMount(){
        this.setState({students:studentInfo})
    }


        render(){
            return (
                <div className="BlackContainer">
                <div className="StudentListContainer">
                    <StudentList students={this.state.students} ></StudentList>
                </div>
        
        
            </div>
              );
          }
}
   
  export default BlackSidebar;