import React, { Component } from "react";
import "./blacksidebar.styles.css";
import {StudentList} from "../StudentList/studentlist.component"
class BlackSidebar extends Component{
    constructor(props){
        super(props);
    
        this.state = {  
        };
    }

        render(){
            return (
                <div className="BlackContainer">
                <div className="StudentListContainer">
                    <StudentList students={this.props.listofstudents}
                        selectStudent={(data) => this.props.setStudent(data)}
                        selectedStudent={this.props.student} ></StudentList>
                    
                </div>
        
        
            </div>
              );
          }
}
 
  export default BlackSidebar;