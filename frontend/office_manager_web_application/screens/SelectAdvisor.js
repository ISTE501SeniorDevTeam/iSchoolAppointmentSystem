import React from "react";
import { View, StyleSheet, Text, Image, FlatList } from "react-native";
import { util } from "../assets/Utility";
// import CompleteAvailableAdvisorWithSelect from "../components/AvailabilityScreen/CompleteAvailableAdvisorWithSelect";

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

export default class SelectAdvisor extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      advisorsData: advisorsWithStudents,
    };
    // this.getData();
  }

  onSelectAdvisor = (advisorName, waitTime) => {
    this.props.navigation.navigate("reasons", {
      studentDisplayName: this.props.route.params.studentDisplayName,
      selectedAdvisor: advisorName,
      advisorWaitTime: waitTime,
    });
  };

  // getData = () => {
  // axios
  //   .get(util.api_url + "getAvailableAdvisorsWithStudentsInTheQueueApi/degreeLevel[grad or undergrad]()", {
  //     headers: { },
  //   })
  //   .then((res) => {
  //     this.state = {
  //        advisorsData: res.data
  //     }
  //   })
  //   .catch((res) => {});
  // };

  render() {
    return (
      <View style={styles.topView}>
        <View style={{ flexDirection: "row", justifyContent: "space-between" }}>
        </View>
        <View style={styles.appointmentSection}>
          <Text style={styles.appointmentHeader}>Appointments</Text>
          <Text style={styles.appointmentText}>No upcoming appointments</Text>
        </View>
        <View style={styles.availabilitySection}>
          <Text style={styles.availabilityHeader}>Walk In Availability</Text>
          <FlatList
            data={this.state.advisorsData}
            contentContainerStyle={styles.availableAdvisorContainer}
            renderItem={({ item }) => (
              <View style={styles.availableAdvisor} key={item.advisorName}>
                <CompleteAvailableAdvisorWithSelect
                  advisorName={item.advisorName}
                  waitTime={
                    item.studentsInTheQueue.length *
                    util.averageMettingTimePerStudent
                  }
                  onSelectAdvisor={() =>
                    this.onSelectAdvisor(
                      item.advisorName,
                      item.studentsInTheQueue.length *
                        util.averageMettingTimePerStudent
                    )
                  }
                />
              </View>
            )}
            numColumns={1}
            keyExtractor={(item) => item.advisorName.toString()}
          />
        </View>
      </View>
    );
  }
}

const dimensions = {
  marginLeft: 24,
};

const styles = StyleSheet.create({
  topView: {
    flex: 1,
    backgroundColor: "white",
    paddingStart: dimensions.marginLeft,
  },
  ritHeaderImage: {
    marginTop: 32,
    width: 278,
    height: 49.37,
  },
  ritTraingle: {
    flexDirection: "column",
    flexWrap: "wrap",
    display: "flex",
    alignSelf: "flex-end",
    height: 125,
    width: 200,
  },
  appointmentSection: {
    marginTop: 5,
  },
  appointmentHeader: {
    fontStyle: "normal",
    fontWeight: "300",
    fontSize: 38,
  },
  appointmentText: {
    marginTop: 8,
    marginStart: 8,
    fontSize: 16,
  },

  availabilitySection: {
    marginTop: 16,
  },

  availabilityHeader: {
    fontWeight: "300",
    fontSize: 38,
  },

  availableAdvisor: {
    marginLeft: 15,
    marginBottom: 45,
  },
  availableAdvisorContainer: {
    marginTop: 25,
  },
});
