import React from "react";
import { StyleSheet, View } from "react-native";
import AdvisorStudentQueue from "./AdvisorStudentQueue";

export default function App() {
  return (
    <View style={styles.container}>
      <AdvisorStudentQueue />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#fff",
  },
});
