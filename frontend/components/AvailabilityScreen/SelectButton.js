import React, { Component } from "react";
import { StyleSheet, View } from "react-native";
import CupertinoButtonInfo from "./CupertinoButtonInfo";
import Icon from "react-native-vector-icons/Entypo";

function SelectButton(props) {
  return (
    <View style={[styles.container, props.style]}>
      <View style={styles.group2}>
        <View style={styles.cupertinoButtonInfoStack}>
          <CupertinoButtonInfo
            style={styles.cupertinoButtonInfo}
          ></CupertinoButtonInfo>
          <Icon name="chevron-small-right" style={styles.icon}></Icon>
        </View>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {},
  group2: {
    width: 119,
    height: 55
  },
  cupertinoButtonInfo: {
    height: 55,
    width: 119,
    position: "absolute",
    top: 0,
    left: 0
  },
  icon: {
    top: 5,
    left: 79,
    position: "absolute",
    color: "rgba(255,255,255,1)",
    fontSize: 40,
    height: 46,
    width: 40
  },
  cupertinoButtonInfoStack: {
    width: 119,
    height: 55
  }
});

export default SelectButton;
