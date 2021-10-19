import React from "react";
import { StyleSheet, View, Text, Dimensions } from "react-native";
import { util } from "./Utility";

export const AdvisorStudentCard = (props) => {
  let getFormattedStudentName = (studentName) => {
    let firstIntial = studentName.split(" ")[0].substring(0, 1);
    let lastName = studentName.split(" ")[1];
    return firstIntial + ". " + lastName;
  };

  return (
    <View
      style={styles.advisorStudentCard}
      key={props.advisorStudentItem.advisorName}
    >
      <View style={styles.advisorNameContainer}>
        <Text style={styles.advisorDetailText}>
          {props.advisorStudentItem.advisorName}
        </Text>
        <Text style={[styles.advisorDetailText]}>
          {props.advisorStudentItem.studentsInTheQueue.length *
            util.averageMettingTimePerStudent}{" "}
          Minutes
        </Text>
      </View>
      <View style={styles.queueContainer}>
        <Text style={styles.mediumBlackText}>Up Next</Text>
        {props.advisorStudentItem.studentsInTheQueue.length > 0 ? (
          <Text style={styles.boldBigOrangeText}>
            {getFormattedStudentName(
              props.advisorStudentItem.studentsInTheQueue.at(0)
                .studentDisplayName
            )}
          </Text>
        ) : (
          <Text style={styles.boldBigOrangeText}>Open</Text>
        )}
        <Text
          style={[styles.mediumBlackText, { marginTop: 28, marginBottom: 16 }]}
        >
          Queue
        </Text>
        {props.advisorStudentItem.studentsInTheQueue.length > 1 &&
          props.advisorStudentItem.studentsInTheQueue.map((student, index) => {
            return (
              index != 0 &&
              index < util.maxStudentsDisplayedInQueue + 1 && (
                <Text
                  style={[styles.mediumOrangeText, { marginVertical: 12 }]}
                  key={student.studentDisplayName}
                >
                  {getFormattedStudentName(student.studentDisplayName)}
                </Text>
              )
            );
          })}
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  advisorStudentCard: {
    flex: 1,
    marginHorizontal: 50,
    borderWidth: 3,
    maxWidth: Dimensions.get("window").width / 2 - 120,
    height: Dimensions.get("window").height * 0.58,
  },
  advisorNameContainer: {
    flexDirection: "column",
    backgroundColor: "black",
    paddingStart: 28,
    paddingVertical: 14,
  },
  queueContainer: {
    flex: 1,
    backgroundColor: "white",
    paddingHorizontal: 24,
    paddingVertical: 32,
  },
  advisorDetailText: {
    color: "white",
    fontSize: 36,
    fontWeight: "700",
    paddingBottom: 16,
  },
  mediumBlackText: {
    fontSize: 24,
    fontWeight: "bold",
  },
  boldBigOrangeText: {
    color: util.rit_primary_color,
    fontSize: 36,
    fontWeight: "bold",
    marginTop: 18,
  },
  mediumOrangeText: {
    color: util.rit_primary_color,
    fontSize: 28,
  },
});

export default AdvisorStudentCard;
