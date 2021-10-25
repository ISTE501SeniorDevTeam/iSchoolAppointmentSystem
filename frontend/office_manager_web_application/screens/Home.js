import axios from "axios";
import React from "react";
import { StyleSheet, Text, View } from "react-native";
import { util } from "../assets/Utility";
import BlackSideBar from "../components/BlackSideBar";
import OrangeSideBar from "../components/OrangeSideBar";
import { StudentQueue } from "../components/StudentQueue";
import { WalkInCreation } from "../components/WalkInCreation";

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
  constructor(props) {
    super(props);
    this.state = {
      displayStudentQueue: true,
      displayWalkIn: false,
      queueData,
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

  render() {
    return (
      <View style={styles.topView} onMo>
        {/* need to get props from login page */}
        <OrangeSideBar
          userName={this.props.userName || "Olivia Officeworker"}
        />
        <BlackSideBar
          studentQueueClicked={this.studentQueueClicked}
          createWalkInClicked={this.createWalkInClicked}
        />
        {this.state.displayStudentQueue && (
          <StudentQueue queueData={this.state.queueData} />
        )}
        {this.state.displayWalkIn && <WalkInCreation />}
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
