import React from "react";
import { Dimensions, Pressable, StyleSheet, Text, View } from "react-native";
import { colors } from "../styles/Main";

/**
 * This is the class representing the black sidebar
 * that is part of the user's screen, that holds the inner buttons after the user selects an
 * option from the orange sidebar
 * Author: Raghul Krishnan
 */
export default class BlackSideBar extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      studentQueueClicked: true,
      createWalkInClicked: false,
      previouslyUploadedClicked: true,
      uploadClicked: false,
      showStudentsOptions: this.props.showStudentsOptions,
    };
  }

  studentQueueClicked = () => {
    this.props.studentQueueClicked();
    this.state.studentQueueClicked
      ? ""
      : this.setState({
          studentQueueClicked: true,
          createWalkInClicked: false,
        });
  };

  createWalkInClicked = () => {
    this.props.createWalkInClicked();
    this.state.createWalkInClicked
      ? ""
      : this.setState({
          createWalkInClicked: true,
          studentQueueClicked: false,
        });
  };

  previouslyUploadedClicked = () => {
    this.props.previouslyUploadedClicked();
    this.state.previouslyUploadedClicked
      ? ""
      : this.setState({
          previouslyUploadedClicked: true,
          uploadClicked: false,
        });
  };

  uploadClicked = () => {
    this.props.uploadClicked();
    this.state.uploadClicked
      ? ""
      : this.setState({
          previouslyUploadedClicked: false,
          uploadClicked: true,
        });
  };

  render() {
    return (
      <View style={styles.topView}>
        {this.props.showStudentsOptions ? (
          <View>
            <Pressable
              onPress={this.studentQueueClicked}
              style={
                this.state.studentQueueClicked
                  ? [styles.sideBarButton, styles.clickedButton]
                  : styles.sideBarButton
              }
            >
              <Text
                style={
                  this.state.studentQueueClicked
                    ? [styles.sideBarText, styles.clickedText]
                    : styles.sideBarText
                }
              >
                Student Queue
              </Text>
            </Pressable>
            <Pressable
              style={
                this.state.createWalkInClicked
                  ? [styles.sideBarButton, styles.clickedButton]
                  : styles.sideBarButton
              }
              onPress={this.createWalkInClicked}
            >
              <Text
                style={
                  this.state.createWalkInClicked
                    ? [styles.sideBarText, styles.clickedText]
                    : styles.sideBarText
                }
              >
                Create Walk-in
              </Text>
            </Pressable>
          </View>
        ) : (
          <View>
            <Pressable
              onPress={this.previouslyUploadedClicked}
              style={
                this.state.previouslyUploadedClicked
                  ? [styles.sideBarButton, styles.clickedButton]
                  : styles.sideBarButton
              }
            >
              <Text
                style={
                  this.state.previouslyUploadedClicked
                    ? [styles.sideBarText, styles.clickedText]
                    : styles.sideBarText
                }
              >
                Previously Uploaded
              </Text>
            </Pressable>
            <Pressable
              style={
                this.state.uploadClicked
                  ? [styles.sideBarButton, styles.clickedButton]
                  : styles.sideBarButton
              }
              onPress={this.uploadClicked}
            >
              <Text
                style={
                  this.state.uploadClicked
                    ? [styles.sideBarText, styles.clickedText]
                    : styles.sideBarText
                }
              >
                Upload
              </Text>
            </Pressable>
          </View>
        )}
      </View>
    );
  }
}

const dimensions = {
  width: Dimensions.get("window").width / 6,
};

const styles = StyleSheet.create({
  topView: {
    backgroundColor: colors.themeBlackColor,
    width: dimensions.width,
    paddingTop: 24,
    paddingLeft: 12,
  },
  sideBarButton: {
    marginBottom: 12,
    paddingVertical: 10,
    backgroundColor: colors.themeBlackColor,
    paddingLeft: 4,
    color: "white",
  },
  clickedButton: {
    backgroundColor: "white",
  },
  sideBarText: {
    fontSize: 16,
    fontWeight: "700",
    color: "white",
  },
  clickedText: {
    color: colors.ritThemeColor,
  },
});
