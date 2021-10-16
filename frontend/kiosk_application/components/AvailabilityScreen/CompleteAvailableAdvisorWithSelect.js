import React, { Component } from "react";
import { StyleSheet, View, Text } from "react-native";
import AvailableAdvisorWithSelect from "./AvailableAdvisorWithSelect";

function CompleteAvailableAdvisorWithSelect(props) {
  return (
    <View style={[styles.container, props.style]}>
      <View style={styles.availableAdvisorWithSelectStack}>
        <AvailableAdvisorWithSelect
          style={styles.availableAdvisorWithSelect}
          advisorName={props.advisorName}
          onSelectAdvisor={props.onSelectAdvisor}
        />
        <Text style={styles.estimatedWait}>
          Estimated Wait:{" "}
          <Text style={{ fontWeight: "bold" }}>{props.waitTime} minutes</Text>
        </Text>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {},
  availableAdvisorWithSelect: {
    position: "absolute",
    top: 0,
    left: 0,
    height: 150,
    width: 940,
  },
  estimatedWait: {
    top: 106,
    left: 182,
    position: "absolute",
    color: "#121212",
    height: 28,
    width: 305,
    fontSize: 24,
  },
  availableAdvisorWithSelectStack: {
    width: 940,
    height: 150,
  },
});

export default CompleteAvailableAdvisorWithSelect;
