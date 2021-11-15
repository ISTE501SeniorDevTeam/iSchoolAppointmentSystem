import React from "react";
import { StyleSheet, View } from "react-native";
import AdvisorStudentQueue from "./AdvisorStudentQueue";
import InformationContainer from "./InformationContainer";

/**
 * This is the entry point of the application, it displays the home page which contains the advisors and students in thier queue,
 * as well as iSchool news/events and their details
 * Author: Raghul Krishnan
 */
export default function App() {
  return (
    <View style={styles.container}>
      <AdvisorStudentQueue />
      <InformationContainer />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#fff",
  },
});
