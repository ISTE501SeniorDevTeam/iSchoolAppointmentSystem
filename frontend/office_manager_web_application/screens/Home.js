// import axios from "axios";
import React from "react";
import { StyleSheet, Text, View } from "react-native";
import BlackSideBar from "../components/BlackSideBar";
import OrangeSideBar from "../components/OrangeSideBar";
import { PreviouslyUploaded } from "../components/PreviouslyUploaded";
import { StudentQueue } from "../components/StudentQueue";
import  WalkIn  from "../components/WalkInCreation";
import { UploadMedia } from "../components/UploadMedia";



let queueData = [
  {
    advisorName: "Andy Advisor",
    studentsInTheQueue: [
      {
        studentDisplayName: "Jim Parker",
        emailAddress: "jpa1234@rit.edu",
      },
      {
        studentDisplayName: "John Simson",
        emailAddress: "jss1234@rit.edu",
      },
    ],
  },
  {
    advisorName: "Amy Advisor",
    studentsInTheQueue: [
      {
        studentDisplayName: "John Doe",
        emailAddress: "jde1234@rit.edu",
      },
      {
        studentDisplayName: "Ryan Borger",
        emailAddress: "rb1234@rit.edu",
      },
    ],
  },
  {
    advisorName: "Amy Advisor2",
    studentsInTheQueue: [
      {
        studentDisplayName: "John Doe",
        emailAddress: "jde1234@rit.edu",
      },
      {
        studentDisplayName: "Ryan Borger",
        emailAddress: "rb1234@rit.edu",
      },
    ],
  },
];

/**
 * This is the class representing the home page view
 * that is displayed after the user logs in to the system
 * Author: Raghul Krishnan
 */
export default class Home extends React.Component {
  blackSideBar = null;
  constructor(props) {
    super(props);
    this.state = {
      displayStudentQueue: true,
      displayWalkIn: false,
      queueData,
      showStudentsOptions: true,
      displayPreviosulyUploaded: false,
      displayUpload: false,
    };

    this.getData();
  }

  getData = () => {
    // axios
    //   .get(util.api_url + "getAvisorandStudentsInTheirQueueApi()", {
    //     headers: {},
    //   })
    //   .then((res) => {
    //     this.state = {
    //       queueData: res.data,
    //     };
    //   })
    //   .catch((res) => {});
  };

  studentQueueClicked = () => {
    this.setState({
      displayStudentQueue: true,
      displayWalkIn: false,
    });
  };

  createWalkInClicked = () => {
    this.setState({
      displayStudentQueue: false,
      displayWalkIn: true,
    });
  };

  studentsButtonInSideBarClicked = () => {
    this.blackSideBar.state.createWalkInClicked
      ? this.setState({
          showStudentsOptions: true,
          displayPreviosulyUploaded: false,
          displayStudentQueue: false,
          displayWalkIn: true,
          displayUpload: false,
        })
      : this.setState({
          showStudentsOptions: true,
          displayPreviosulyUploaded: false,
          displayStudentQueue: true,
          displayWalkIn: false,
          displayUpload: false,
        });
  };

  infoUploadInSideBarClicked = () => {
    this.blackSideBar.state.uploadClicked
      ? this.setState({
          showStudentsOptions: false,
          displayPreviosulyUploaded: false,
          displayUpload: true,
          displayStudentQueue: false,
          displayWalkIn: false,
        })
      : this.setState({
          showStudentsOptions: false,
          displayPreviosulyUploaded: true,
          displayUpload: false,
          displayStudentQueue: false,
          displayWalkIn: false,
        });
  };

  uploadClicked = () => {
    this.setState({ displayUpload: true, displayPreviosulyUploaded: false });
  };

  previouslyUploadedClicked = () => {
    this.setState({ displayUpload: false, displayPreviosulyUploaded: true });
  };

  render() {
    return (
      <View style={styles.topView}>
        {/* need to get props from login page */}
        <OrangeSideBar
          userName={this.props.userName || "Olivia Officeworker"}
          userRole={"Office Manager"}
          studentsClicked={this.studentsButtonInSideBarClicked}
          infoUploadClicked={this.infoUploadInSideBarClicked}
        />
        <BlackSideBar
          ref={(ref) => (this.blackSideBar = ref)}
          studentQueueClicked={this.studentQueueClicked}
          createWalkInClicked={this.createWalkInClicked}
          showStudentsOptions={this.state.showStudentsOptions}
          uploadClicked={this.uploadClicked}
          previouslyUploadedClicked={this.previouslyUploadedClicked}
        />

        {this.state.displayStudentQueue && (
          <StudentQueue queueData={this.state.queueData} />
        )}

        {this.state.displayWalkIn && <WalkIn />}
        {this.state.displayPreviosulyUploaded && <PreviouslyUploaded />}
        {this.state.displayUpload && <UploadMedia />}

      </View>
    );
  }
}

const styles = StyleSheet.create({
  topView: {
    flex: 1,
    backgroundColor: "white",
    flexDirection: "row",
  },
});
