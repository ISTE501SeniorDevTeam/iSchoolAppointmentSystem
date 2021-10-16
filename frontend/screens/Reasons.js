import React from "react";
import {
  FlatList,
  Pressable,
  View,
  StyleSheet,
  Text,
  Image,
  TextInput,
} from "react-native";
import { images, util } from "../assets/Utility";
// import axios from "axios";
import { colors } from "../styles/Main";

let reasons = [
  "Next Semester Planning",
  "Update Worksheet",
  "Problems with Registration",
  "Leave Of Absence/Institute Withdrawal",
  "Change Of Program – out",
  "Course Withdrawal",
  "Waitlist",
  "Faculty/Grade Concern",
  "Received an Early Alert",
  "Transfer Credit/AP",
  "Request for Resource Info",
  "Minor/Concentration Selection",
  "Graduation Questions",
  "Personal Issue",
  "Other",
];

/**
 * This is the class displaying the Reasons view
 * Author: Raghul Krishnan
 */
export default class Reasons extends React.Component {
  OTHER_STRING = "Other";
  otherReasonInputBox = "";

  constructor(props) {
    super(props);
    this.state = {
      reasonsData: reasons,
      otherClicked: false,
      otherReason: "",
      selectedReason: "",
    };
    // this.getData();
    this.prepareData();
  }

  // getData = () => {
  // axios
  //   .get(util.api_url + "getReasonsApi()", {
  //     headers: { },
  //   })
  //   .then((res) => {
  //     this.setState({
  //     });
  //   })
  //   .catch((res) => {});
  // };

  prepareData = () => {
    let reasonsObject = [];
    reasons.forEach((reason) => {
      reasonsObject.push({
        reason,
        selected: false,
      });
    });
    this.state = {
      reasonsData: reasonsObject,
    };
  };

  onReasonSelect = (selectedReason) => {
    let newReasons = this.deselectAllReasons();
    newReasons.filter((ele) => ele.reason == selectedReason)[0].selected = true;
    this.setState(
      {
        reasonsData: newReasons,
        otherClicked: selectedReason == this.OTHER_STRING,
        selectedReason,
      },
      () => {
        selectedReason == this.OTHER_STRING && this.otherReasonInputBox.focus();
      }
    );
  };

  deselectAllReasons = () => {
    return this.state.reasonsData.map((ele) => {
      ele.selected = false;
      return ele;
    });
  };

  onOtherInputFocus = () => {
    // Code to eliminate the outline for a textinput
    this.otherReasonInputBox.setNativeProps({
      style: {
        outline: "none",
      },
    });
  };

  onOtherInputChange = (text) => {
    this.setState({
      otherReason: text,
    });
  };

  doneSelected = () => {
    // check if a reason is selected
    if (this.state.selectedReason && this.state.selectedReason.trim() != "") {
      // check if selected reason is other
      if (this.state.selectedReason == this.OTHER_STRING) {
        // if selected reason is other but the reason is not typed in i.e, that it is not blank or just has white space in it, then make an appointment
        this.state.otherReason &&
          this.state.otherReason.trim() != "" &&
          this.makeAppointment();
      } else {
        this.makeAppointment();
      }
    }
  };

  makeAppointment = () => {
    // axios
    //   .post(
    //     util.api_url + "createAppointmentApi()",
    //     {
    //       reason: this.state.selectedReason == this.OTHER_STRING ? this.state.otherReason : this.state.selectedReason,
    //       student: this.props.route.params.studentDisplayName,
    //       advisor: this.props.route.params.selectedAdvisor,
    //     },
    //     {
    //       headers: {},
    //     }
    //   )
    //   .then((res) => {
    //     res.data.success && this.props.navigation.navigate("thank_you");
    //   })
    //   .catch((res) => {});
  };

  backPressed = () => {
    this.state.otherClicked
      ? [
          this.setState({
            otherClicked: false,
            selectedReason: "",
          }),
          this.deselectAllReasons(),
        ]
      : this.props.navigation.goBack();
  };

  render() {
    return (
      <View style={styles.topView}>
        <View style={{ flexDirection: "row", justifyContent: "space-between" }}>
          <Image
            style={styles.ritHeaderImage}
            source={require("../assets/RIT.jpg")}
          />
          <Image
            style={styles.ritTraingle}
            source={require("../assets/reasons-background.png")}
          />
        </View>
        <View style={styles.advisorImageTextContainer}>
          {
            <Image
              style={styles.advisorImage}
              source={images.andy_advisor_image_url}
            />
          }
          {/* change this line of code later  */}
          <View
            style={{ flexDirection: "column", justifyContent: "space-between" }}
          >
            <Text style={styles.advisorName}>
              {this.props.route.params
                ? this.props.route.params.selectedAdvisor
                : "Andy Advisor"}
            </Text>
            <Text style={styles.waitTime}>
              Estimated Wait:{" "}
              <Text style={{ fontWeight: "bold" }}>
                {this.props.route.params
                  ? this.props.route.params.advisorWaitTime
                  : 4 + " Minutes"}
              </Text>
            </Text>
          </View>
        </View>
        <Text style={styles.header}>Reason for Walk-in</Text>
        {!this.state.otherClicked && (
          <FlatList
            data={this.state.reasonsData}
            contentContainerStyle={styles.reasonContainer}
            renderItem={({ item }) => (
              <Pressable
                onPress={() => this.onReasonSelect(item.reason)}
                android_disableSound={true}
                style={[
                  {
                    backgroundColor: item.selected
                      ? colors.ritThemeColor
                      : "white",
                    borderColor: item.selected ? colors.ritThemeColor : "#000",
                  },
                  styles.reasonCard,
                ]}
              >
                <Text
                  style={[
                    { color: item.selected ? "white" : "#C75300" },
                    styles.reasonText,
                  ]}
                >
                  {item.reason}
                </Text>
              </Pressable>
            )}
            numColumns={this.state.reasonsData.length > 8 ? 3 : 2}
            keyExtractor={(item) => item.reason.toString()}
          />
        )}
        <View
          style={
            this.state.otherClicked
              ? [styles.actionButtonContainer, { marginTop: 40 }]
              : styles.actionButtonContainer
          }
        >
          <Pressable
            onPress={this.backPressed}
            style={[styles.actionButton, { borderColor: colors.ritThemeColor }]}
          >
            <Text
              style={[styles.actionButtonText, { color: colors.ritThemeColor }]}
            >
              Back
            </Text>
          </Pressable>
          {this.state.otherClicked && (
            <TextInput
              ref={(ref) => {
                this.otherReasonInputBox = ref;
              }}
              onFocus={this.onOtherInputFocus}
              style={styles.textInputBox}
              defaultValue={this.state.otherReason}
              onChangeText={this.onOtherInputChange}
              placeholder={"Other reason for visit"}
              key={"OtherReasonInputBox"}
            />
          )}
          <Pressable
            onPress={this.doneSelected}
            style={({ pressed }) => [
              {
                backgroundColor: pressed ? colors.ritThemeColor : "white",
                borderColor: pressed ? colors.ritThemeColor : "black",
              },
              styles.actionButton,
            ]}
          >
            <Text style={styles.actionButtonText}>Done</Text>
          </Pressable>
        </View>
      </View>
    );
  }
}

const dimensions = {
  marginLeft: 24,
};

const styles = StyleSheet.create({
  topView: {
    backgroundColor: "white",
    flex: 1,
  },
  ritTraingle: {
    flexDirection: "column",
    flexWrap: "wrap",
    display: "flex",
    alignSelf: "flex-end",
    height: 125,
    width: 200,
  },
  ritHeaderImage: {
    marginLeft: dimensions.marginLeft,
    marginTop: 32,
    width: 278,
    height: 49.37,
  },
  advisorImage: {
    width: 67,
    height: 67,
    borderColor: colors.ritThemeColor,
    borderWidth: 4,
    marginLeft: dimensions.marginLeft,
  },
  advisorName: {
    borderColor: colors.ritThemeColor,
    backgroundColor: colors.ritThemeColor,
    paddingBottom: 1,
    paddingLeft: 15,
    color: "white",
    paddingRight: 60,
  },
  waitTime: {
    marginLeft: 15,
  },
  advisorImageTextContainer: {
    marginTop: 15,
    flexDirection: "row",
    flexWrap: "wrap",
  },
  header: {
    marginTop: 20,
    marginLeft: dimensions.marginLeft,
    fontSize: 36,
  },
  reasonContainer: {
    marginTop: 18,
    marginHorizontal: dimensions.marginLeft,
    alignContent: "space-around",
    marginBottom: 20,
  },
  reasonCard: {
    textAlign: "center",
    borderWidth: 3,
    flex: 1,
    padding: 16,
    marginBottom: 20,
    marginRight: 20,
    borderRadius: 4,
    justifyContent: "center",
  },
  reasonText: {
    fontWeight: "600",
    fontSize: 16,
  },
  actionButtonContainer: {
    flexDirection: "row",
    justifyContent: "space-around",
    marginTop: 10,
    marginBottom: 5,
  },
  textInputBox: {
    borderWidth: 2,
    borderColor: "#D0D3D4",
    paddingHorizontal: 10,
    minWidth: 300,
  },
  actionButton: {
    borderWidth: 3,
    paddingVertical: 7,
    paddingHorizontal: 20,
    elevation: 3,
  },
  actionButtonText: {
    fontWeight: "bold",
  },
});
