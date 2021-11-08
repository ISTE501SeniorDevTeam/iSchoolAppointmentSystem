import React from "react";
import {
  Dimensions,
  Pressable,
  StyleSheet,
  View,
  Text,
  TextInput,
} from "react-native";
import { colors } from "../../styles/Main";
import Loading from "./Loading";
import ProgressBar from "./ProgressBar";

export default class WalkInCreation extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      UID: "",
    };
    this.handleChange = this.handleChange.bind(this);
  }

  nextSelected = () => {
    if (
      this.state.UID &&
      this.state.UID.trim() != ""
    ) {
      this.props.navigation.navigate("SelectAdvisor", {
        UID: this.state.UID
      });
    }
  };

  handleChange = (text) => {
    console.log(text.target.value)
    this.setState(
      {
        UID: text.target.value
      },
      () => {
        if (this.state.UID.length == 9 && this.state.UID.match("^[0-9]*$")) {
          this.nextSelected();
        }
      }
    );
  };

  render() {
    return (
      <View style={styles.container}>
        <ProgressBar width={"7%"} />
        <View style={styles.UIDContainer}>
          <Text style={styles.EnterUIDText}> Please Enter Student's UID
          </Text>
          {/* <TextInput
            ref={(ref) => (this.textInput = ref)}
            placeholder="UID"
            style={{ height: 1, width: 1 }}
            value={this.state.UID}
            // onChangeText={this.onChangeInvisibleTextBox}
            // onFocus={this.onTextInputFocus}
            // showSoftInputOnFocus={true}
          /> */}
          <View style={styles.leftCut} />
        </View>
        <TextInput style={styles.UIDTextInput}
          placeholder="UID"
          ref="uidvalue"
          onChangeText={(UID) => this.setState({ UID })}
          value={this.state.UID}
        />
        <View style={styles.actionButtonContainer}>
          <Pressable
            onPress={this.nextSelected}
            style={({ pressed }) => [
              {
                backgroundColor: pressed ? "#C75300" + 50 : colors.white,
                borderColor: pressed ? "#C75300" : "black",
              },
              styles.actionButton,
            ]}
          >
            <Text style={[
              styles.actionButtonText,
              {
                color: "#C75300"
              }
            ]}
            >
              Start Over
            </Text>
          </Pressable>
          <Pressable
            onPress={this.nextSelected}
            onPress={() => this.props.onPress()}
            style={({ pressed }) => [
              styles.actionButton,
              {
                backgroundColor: pressed ? colors.ritThemeColor + 80 : colors.ritThemeColor,
              },
            ]}
          >
            <Text style={[
              {
                color: colors.white
              },
              styles.actionButtonText,
            ]}
            >
              Next
            </Text>
          </Pressable>
        </View>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: colors.white,
  },
  uidText: {
    color: "white",
    width: 0,
    height: 0,
  },
  UIDContainer: {
    width: 360,
    height: 55,
    marginTop: 100,
    position: "relative",
    backgroundColor: "#F76902",
    display: "flex",
    justifyContent: "center",
    alignItems: "center",

  },
  leftCut: {
    position: 'absolute',
    top: 40,
    left: -20,
    height: 40,
    width: 40,
    transform: [
      {
        rotate: '45deg'
      }
    ],
    backgroundColor: colors.white
  },
  EnterUIDText: {
    fontFamily: "Helvetica",
    fontStyle: "normal",
    fontWeight: 700,
    color: "#FFFFFF",
    // height: 40,
    lineHeight: 27,
    textAlign: "center",
    fontSize: 24,
  },
  UIDTextInput: {
    // position: "absolute",
    width: 465,
    height: 40,
    marginVertical: 50,
    background: "#FFFFFF",
    borderWidth: 2,
    borderColor: colors.border,
    paddingHorizontal: 20,
  },
  actionButtonContainer: {
    position: "absolute",
    flexDirection: "row",
    justifyContent: "space-between",
    // marginBottom: 5,
    left: 0,
    right: 0,
    bottom: 60,
  },
  actionButton: {
    borderWidth: 1,
    paddingVertical: 7,
    paddingHorizontal: 20,
    elevation: 3,
    borderColor: colors.ritThemeColor,
  },
  actionButtonText: {
    fontWeight: "bold",
  },
});
