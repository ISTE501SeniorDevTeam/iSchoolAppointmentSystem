import React, { Component } from "react";
import { StyleSheet, View } from "react-native";
import AdvisorProfile from "./AdvisorProfile";
import SelectButton from "./SelectButton";

function AvailableAdvisorWithSelect(props) {
  return (
    <View style={[styles.container, props.style]}>
      <View style={styles.rect}>
        <View style={styles.advisorProfileRow}>
          <AdvisorProfile style={styles.advisorProfile}></AdvisorProfile>
          <SelectButton style={styles.selectButton}></SelectButton>
        </View>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {},
  rect: {
    width: 940,
    height: 150,
    backgroundColor: "#FFFFFF",
    flexDirection: "row"
  },
  advisorProfile: {
    height: 150,
    width: 389
  },
  selectButton: {
    height: 55,
    width: 119,
    marginLeft: 432,
    marginTop: 48
  },
  advisorProfileRow: {
    height: 150,
    flexDirection: "row",
    flex: 1
  }
});

export default AvailableAdvisorWithSelect;
