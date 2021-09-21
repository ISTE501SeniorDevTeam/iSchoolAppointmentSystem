import React, { Component } from "react";
import { StyleSheet, View } from "react-native";
import MaterialCardWithTextOverImage1 from "./MaterialCardWithTextOverImage1";
import MaterialCardWithoutImage1 from "./MaterialCardWithoutImage1";

function AdvisorProfile(props) {
  return (
    <View style={[styles.container, props.style]}>
      <View style={styles.materialCardWithTextOverImage1Stack}>
        <MaterialCardWithTextOverImage1
          style={styles.materialCardWithTextOverImage1}
        ></MaterialCardWithTextOverImage1>
        <MaterialCardWithoutImage1
          style={styles.materialCardWithoutImage1}
        ></MaterialCardWithoutImage1>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {},
  materialCardWithTextOverImage1: {
    height: 150,
    width: 150,
    position: "absolute",
    left: 0,
    top: 0,
    borderWidth: 5,
    borderColor: "rgba(247,105,2,1)",
    borderStyle: "solid"
  },
  materialCardWithoutImage1: {
    height: 33,
    width: 267,
    position: "absolute",
    left: 122,
    top: 14,
    backgroundColor: "rgba(247,105,2,1)"
  },
  materialCardWithTextOverImage1Stack: {
    width: 389,
    height: 150
  }
});

export default AdvisorProfile;
