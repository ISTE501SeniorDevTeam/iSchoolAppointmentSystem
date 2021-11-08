import React from "react";
import {
  FlatList,
  Image,
  Pressable,
  StyleSheet,
  Text,
  View,
} from "react-native";
import { colors } from "../styles/Main";
import { degreeLevels } from "./DegreeLevel";

let undergradMajorsList = [
  "Computing and Information Technologies",
  "Human-Centered Computing",
  "Digital Humanities and Social Sciences",
  "Web and Mobile Computing",
  "Other",
];

let gradMajorsList = [
  "Health Informatics",
  "Information Technology and Analytics",
  "Human-Computer Interaction",
  "Web Development",
  "Data Science",
  "Other",
];

export default class MajorSelection extends React.Component {
  numberOfColumns = 2;

  constructor(props) {
    super(props);
    let selectedDegreeLevel =
      this.props.route.params && this.props.route.params.degreeLevel;

    this.state = {
      majorsData:
        selectedDegreeLevel == degreeLevels[0]
          ? undergradMajorsList
          : gradMajorsList,
      selectedDegreeLevel,
      studentDisplayName:
        (this.props.route.params &&
          this.props.route.params.studentDisplayName) ||
        "John Doe",
      selectedMajor: "",
    };
    this.prepareData();
  }

  prepareData = () => {
    let majorsObject = [];
    this.state.majorsData.forEach((major) => {
      majorsObject.push({
        major,
        selected: false,
      });
    });
    this.state = {
      majorsData: majorsObject,
    };
  };

  onMajorSelect = (selectedMajor) => {
    let newMajors = this.deselectAllOptions();
    newMajors.filter((ele) => ele.major == selectedMajor)[0].selected = true;
    this.setState({
      majorsData: newMajors,
      selectedMajor: selectedMajor,
    });
  };

  deselectAllOptions = () => {
    return this.state.majorsData.map((ele) => {
      ele.selected = false;
      return ele;
    });
  };

  backPressed = () => {
    this.props.navigation.goBack();
  };

  nextSelected = () => {
    // check if a major is selected
    if (this.state.selectedMajor && this.state.selectedMajor.trim() != "") {
      this.props.navigation.navigate("availability", {
        studentDisplayName: this.state.studentDisplayName,
        degreeLevel: this.state.selectedDegreeLevel,
        major: this.state.selectedMajor,
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
        <Text style={styles.header}>Select your Major</Text>
        <FlatList
          data={this.state.majorsData}
          contentContainerStyle={styles.majorsContainer}
          renderItem={({ item, index }) => (
            <Pressable
              onPress={() => this.onMajorSelect(item.major)}
              android_disableSound={true}
              style={[
                {
                  backgroundColor: item.selected
                    ? colors.ritThemeColor
                    : "white",
                  borderColor: item.selected ? colors.ritThemeColor : "#000",
                  marginRight:
                    index % this.numberOfColumns == 0 &&
                    index != this.state.majorsData.length - 1
                      ? 32
                      : 0,
                },
                styles.majorCard,
              ]}
              key={item.major}
            >
              <Text
                style={[
                  { color: item.selected ? "white" : "#C75300" },
                  styles.majorText,
                ]}
              >
                {item.major}
              </Text>
            </Pressable>
          )}
          numColumns={this.numberOfColumns}
          keyExtractor={(item) => item.major.toString()}
        />
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
    flex: 1,
    backgroundColor: "white",
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
  majorsContainer: {
    marginTop: 42,
    marginHorizontal: dimensions.marginLeft,
    marginBottom: 20,
  },
  majorCard: {
    flex: 1,
    borderWidth: 3,
    padding: 32,
    marginBottom: 20,
    borderRadius: 4,
    maxHeight: 360,
    justifyContent: "center",
  },
  majorText: {
    textAlign: "center",
    fontWeight: "600",
    fontSize: 24,
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
