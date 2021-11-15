import React from "react";
import { View, StyleSheet, Image, Dimensions } from "react-native";
// import axios from "axios";
import AdvisorStudentCard from "./AdvisorStudentCard";

let advisorsWithStudents = [
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
      {
        studentDisplayName: "Rick Hoffman",
        emailAddress: "rb1234@rit.edu",
      },
    ],
  },
  {
    advisorName: "Jill Advisor",
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
 * This class is responsible for showing the advisors and the students in thier queue
 * Author: Raghul Krishnan
 */
export default class AdvisorStudentQueue extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      advisorStudentList: advisorsWithStudents,
    };
    this.getData();
  }

  getData = () => {
    // setTimeout(() =>{
    // axios
    //   .get(util.api_url + "getAvailableAdvisorsWithStudentsInTheQueueApi()", {
    //     headers: { },
    //   })
    //   .then((res) => {
    //     this.state = {
    //        advisorsStudentList: res.data
    //     }
    //   })
    //   .catch((res) => {});
    // axios
    //   .get(util.api_url + "getMediaContent()", {
    //     headers: {},
    //   })
    //   .then((res) => {
    //     this.state = {
    //       mediaContent: res.data,
    //     };
    //   });
    // }, 5000)
  };

  render() {
    return (
      <View style={styles.topView}>
        <Image
          style={styles.leftTraingle}
          source={require("./assets/bg_left_triangle.png")}
        />
        <View style={styles.advisorsListContainer}>
          {this.state.advisorStudentList.map((advisor) => {
            return (
              <AdvisorStudentCard
                advisorStudentList={this.state.advisorStudentList}
                advisorStudentItem={advisor}
                key={advisor.advisorName}
              />
            );
          })}
        </View>
        <Image
          source={require("./assets/bg_right_triangle.png")}
          style={styles.rightTraingle}
        />
      </View>
    );
  }
}

const styles = StyleSheet.create({
  topView: {
    flex: 1,
  },
  leftTraingle: {
    position: "absolute",
    left: 0,
    top: 0,
    width: 350,
    height: 295,
  },
  advisorsListContainer: {
    flexDirection: "row",
    justifyContent: "center",
    marginVertical: 30,
    marginBottom: 60,
  },
  rightTraingle: {
    position: "absolute",
    right: 0,
    bottom: Dimensions.get("window").height * 0.4 - 185,
    width: 310,
    height: 350,
    zIndex: -1,
  },
});
