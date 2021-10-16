import React, { Component } from "react";
import { StyleSheet, View, Text } from "react-native";

function MaterialCardWithoutImage1(props) {
  return (
    <View style={[styles.container, props.style]}>
      <Text style={styles.advisorName}>{props.advisorName}</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    borderWidth: 1,
    borderRadius: 2,
    borderColor: "#CCC",
    flexWrap: "nowrap",
    backgroundColor: "rgba(247,105,2,1)",
    shadowColor: "#000",
    shadowOffset: {
      width: -2,
      height: 2,
    },
    shadowOpacity: 0.1,
    shadowRadius: 1.5,
    elevation: 3,
    overflow: "hidden",
    justifyContent: "center",
  },
  advisorName: {
    color: "rgba(255,255,255,1)",
    fontSize: 24,
    alignSelf: "center",
  },
});

export default MaterialCardWithoutImage1;
