import React from "react";
import {
  Dimensions,
  ImageBackground,
  StyleSheet,
  View,
  Text,
} from "react-native";
import { util } from "../assets/Utility";

export default class Welcome extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      UID: "",
    };
  }

  componentDidMount() {
    this.listenForSwipe();
  }

  listenForSwipe = () => {
    document.addEventListener("keydown", (event) => {
      let keyCode = event.keyCode;
      if (keyCode >= 48 && keyCode <= 57) {
        this.setState(
          {
            UID: this.state.UID + (keyCode - 48),
          },
          () => {
            if (this.state.UID.length == util.numberOfDigitisInUID) {
              this.onSwiped();
            }
          }
        );
      }
    });
  };

  onSwiped = () => {
    // axios
    //   .post(util.api_url + "getStudentFromUID()", {
    // UID: this.state.UID
    // }, {
    //     headers: { },
    //   })
    //   .then((res) => {
    //     this.props.navigation.navigate("swiped_screen", {
    //          studentDisplayName: res.data.name
    // });
    //   .catch((res) => {});
    this.props.navigation.navigate("swiped_screen", {
      studentDisplayName: "John Doe",
    });
  };

  render() {
    return (
      <View style={styles.container}>
        <ImageBackground
          style={styles.image}
          source={require("../assets/Group85.png")}
        >
          <Text style={styles.headerText}>Welcome</Text>
          <Text style={styles.bodyText}>Please Swipe Your ID</Text>
          <Text style={styles.uidText}>{this.state.UID}</Text>
        </ImageBackground>
      </View>
    );
  }
}

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
    position: "absolute",
    width: 329,
    height: 86,
    left: 95,
    top: 151,
    fontStyle: "normal",
    fontWeight: "bold",
    fontSize: 75,
    lineHeight: 86,
  },
  bodyText: {
    position: "absolute",
    width: 349,
    height: 126,
    left: 95,
    top: 271,
    fontStyle: "normal",
    fontWeight: "normal",
    fontSize: 55,
    lineHeight: 63,
    /* Text/Default */
    color: "#212519",
  },
  uidText: {
    color: "white",
    width: 0,
    height: 0,
  },
});
