import React from "react";
import {
  Dimensions,
  ImageBackground,
  StyleSheet,
  View,
  Text,
  TextInput,
} from "react-native";

export default class Welcome extends React.Component {
  textInput = "";

  constructor(props) {
    super(props);
    this.state = {
      UID: "",
    };
  }

  componentDidMount() {
    setTimeout(() => {
      this.textInput.focus();
    });
  }

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

  onTextInputFocus = () => {
    // Code to eliminate the outline for a textinput
    this.textInput.setNativeProps({
      style: {
        outline: "none",
      },
    });
  };

  onChangeInvisibleTextBox = (text) => {
    this.setState(
      {
        UID: text.trim(),
      },
      () => {
        if (this.state.UID.length == 9 && this.state.UID.match("^[0-9]*$")) {
          this.onSwiped();
        }
      }
    );
  };

  render() {
    return (
      <View style={styles.container}>
        <ImageBackground
          style={styles.image}
          source={require("../assets/Group85.png")}
        >
          <TextInput
            ref={(ref) => (this.textInput = ref)}
            placeholder=""
            style={{ height: 1, width: 1 }}
            value={this.state.UID}
            onChangeText={this.onChangeInvisibleTextBox}
            onFocus={this.onTextInputFocus}
            showSoftInputOnFocus={false}
          />
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
