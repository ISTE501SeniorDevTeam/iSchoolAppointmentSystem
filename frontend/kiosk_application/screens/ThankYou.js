import React, { useEffect } from "react";
import {
  View,
  StyleSheet,
  ImageBackground,
  Text,
  Dimensions,
  Image,
} from "react-native";

export const ThankYou = (props) => {
  useEffect(() => {
    setTimeout(() => {
      props.navigation.navigate("welcome");
    }, 6000);
  });

  return (
    <View style={styles.container}>
      <ImageBackground
        style={styles.image}
        source={require("../assets/ThankYouBackground.png")}
      >
        <Text style={styles.headerText}>Thank You!</Text>
        <Text style={styles.bodyText}>
          Please take a seat until an advisor comes to get you
        </Text>
        <Image
          style={styles.ritHeaderImage}
          source={require("../assets/RIT.jpg")}
        ></Image>
      </ImageBackground>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#fff",
  },
  image: {
    flex: 1,
    resizeMode: "cover",
    justifyContent: "center",
    width: Dimensions.get("window").width,
  },
  headerText: {
    color: "#F76902",
    textAlign: "center",
    position: "absolute",
    width: 400,
    height: 85,
    left: 310,
    top: 220,
    fontFamily: "Helvetica",
    fontStyle: "normal",
    fontWeight: "bold",
    fontSize: 75,
    lineHeight: 86,
  },
  bodyText: {
    marginTop: 25,
    textAlign: "center",
    position: "absolute",
    width: 455,
    height: 90,
    left: 285,
    top: 395,
    fontFamily: "Helvetica",
    fontStyle: "normal",
    fontWeight: "normal",
    fontSize: 38,
    lineHeight: 44,
    color: "#212519",
  },
  ritHeaderImage: {
    position: "absolute",
    width: 278,
    height: 49.37,
    left: 37,
    top: 34,
  },
});
