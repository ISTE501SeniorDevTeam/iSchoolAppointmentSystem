import React, { Component } from "react";
import { StyleSheet, View, Image } from "react-native";
import { images } from "../../assets/Utility";

function MaterialCardWithTextOverImage1(props) {
  return (
    <View style={[styles.container, props.style]}>
      <Image
        source={images.andy_advisor_image_url}
        style={styles.cardItemImagePlace}
      ></Image>
      <View style={styles.cardBody}></View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    borderWidth: 1,
    borderRadius: 2,
    borderColor: "#CCC",
    flexWrap: "nowrap",
    backgroundColor: "#FFF",
    shadowColor: "#000",
    shadowOffset: {
      width: -2,
      height: 2,
    },
    shadowOpacity: 0.1,
    shadowRadius: 1.5,
    elevation: 3,
    overflow: "hidden",
  },
  cardItemImagePlace: {
    backgroundColor: "#ccc",
    width: 150,
    height: 150,
  },
  cardBody: {
    position: "absolute",
    bottom: 2,
    backgroundColor: "rgba(0,0,0,0.2)",
    left: 0,
    right: 8,
  },
});

export default MaterialCardWithTextOverImage1;
