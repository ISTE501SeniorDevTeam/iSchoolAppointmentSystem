import React from "react";
import { StyleSheet, View, Text, Pressable, Image } from "react-native";
import { colors } from "../styles/Main";

export let degreeLevels = ["Undergrad", "Graduate"];

export default class DegreeLevel extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      degreeLevels,
      selectedDegreeLevel: "",
      studentDisplayName:
        (this.props.route.params &&
          this.props.route.params.studentDisplayName) ||
        "John Doe",
    };
    this.prepareData();
  }

  prepareData = () => {
    let degreeLevelsObject = [];
    degreeLevels.forEach((degreeLevel) => {
      degreeLevelsObject.push({
        degreeLevel,
        selected: false,
      });
    });
    this.state = {
      degreeLevels: degreeLevelsObject,
    };
  };

  onDegreeLevelSelect = (selectedDegreeLevel) => {
    let newDegreeLevels = this.deselectAllOptions();
    newDegreeLevels.filter(
      (ele) => ele.degreeLevel == selectedDegreeLevel
    )[0].selected = true;
    this.setState({
      degreeLevels: newDegreeLevels,
      selectedDegreeLevel,
    });
  };

  deselectAllOptions = () => {
    return this.state.degreeLevels.map((ele) => {
      ele.selected = false;
      return ele;
    });
  };

  backPressed = () => {
    this.props.navigation.goBack();
  };

  nextSelected = () => {
    // check if a degree level is selected
    if (
      this.state.selectedDegreeLevel &&
      this.state.selectedDegreeLevel.trim() != ""
    ) {
      this.props.navigation.navigate("major_selection", {
        studentDisplayName: this.state.studentDisplayName,
        degreeLevel: this.state.selectedDegreeLevel,
      });
    }
  };

  render() {
    return (
      <View style={styles.topView}>
        <View style={styles.assestsContainer}>
          <Image
            style={styles.ritHeaderImage}
            source={require("../assets/RIT.jpg")}
          />
          <Image
            style={styles.ritTraingle}
            source={require("../assets/reasons-background.png")}
          />
        </View>
        <Text style={styles.header}>Degree Level</Text>
        <View style={styles.degreeLevelsContainer}>
          {this.state.degreeLevels.map((item, index) => {
            return (
              <Pressable
                onPress={() => this.onDegreeLevelSelect(item.degreeLevel)}
                android_disableSound={true}
                style={[
                  {
                    backgroundColor: item.selected
                      ? colors.ritThemeColor
                      : "white",
                    borderColor: item.selected ? colors.ritThemeColor : "#000",
                    marginRight: index == 0 ? 58 : 0,
                  },
                  styles.degreeLevelCard,
                ]}
                key={item.degreeLevel}
              >
                <Text
                  style={[
                    { color: item.selected ? "white" : "#C75300" },
                    styles.degreeLevelText,
                  ]}
                >
                  {item.degreeLevel}
                </Text>
              </Pressable>
            );
          })}
        </View>
        <View style={styles.actionButtonContainer}>
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
          <Pressable
            onPress={this.nextSelected}
            style={({ pressed }) => [
              {
                backgroundColor: pressed ? colors.ritThemeColor : "white",
                borderColor: pressed ? colors.ritThemeColor : "black",
              },
              styles.actionButton,
            ]}
          >
            <Text style={styles.actionButtonText}>Next</Text>
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
  assestsContainer: {
    flexDirection: "row",
    justifyContent: "space-between",
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
  header: {
    marginTop: 16,
    marginLeft: dimensions.marginLeft,
    fontSize: 36,
  },
  degreeLevelsContainer: {
    flex: 1,
    marginTop: 42,
    marginHorizontal: dimensions.marginLeft,
    marginBottom: 20,
    flexDirection: "row",
  },
  degreeLevelCard: {
    flex: 1,
    borderWidth: 3,
    padding: 32,
    marginBottom: 20,
    borderRadius: 4,
    maxHeight: 360,
    justifyContent: "center",
  },
  degreeLevelText: {
    textAlign: "center",
    fontWeight: "600",
    fontSize: 42,
  },
  actionButtonContainer: {
    flexDirection: "row",
    justifyContent: "space-around",
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
