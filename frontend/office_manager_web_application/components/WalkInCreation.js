import React from "react";
import {
  Dimensions,
  Pressable,
  StyleSheet,
  View,
  Text,
  TextInput,
} from "react-native";
import { colors } from "../styles/Main";
import Loading from "./walkIn/Loading";
import Preview from "./walkIn/Preview";
import ProgressBar from "./walkIn/ProgressBar";
import SelectAdvisor from "./walkIn/SelectAdvisor";
import SelectModality from "./walkIn/SelectModality";
import SelectReason from "./walkIn/SelectReason";
import WalkInCreation from "./walkIn/WalkInCreationUID";


const nav = ["UID", "Loading", "Advisor", "Modality", "Reason", "Preview"]
export default class WalkIn extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      UID: "",
      active: 0,
      advisor: null,
      modality: null,
      reason: null
    };
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

  startOver = () => {
    this.setState({
      active: 0,
      advisor: null,
      modality: null,
      reason: null
    })
  }
  render() {
    const { active, advisor, modality, reason } = this.state;
    return (
      <View style={styles.StudentInfoPageContainer}>

        {
          nav[active] == "UID" &&
          <WalkInCreation onPress={(data) => this.setState({ active: 1, UID: data })} />
        }
        {
          nav[active] == "Loading" &&
          <Loading onPress={() => this.setState({ active: 2 })} />
        }
        {
          nav[active] == "Advisor" &&
          <SelectAdvisor
            advisor={advisor}
            onPress={(data) => this.setState({ active: 3, advisor: data })}
            onStartOver={() => this.startOver()}
            onConfirm={(data) => this.setState({ active: 5, advisor: data })}
          />
        }
        {
          nav[active] == "Modality" &&
          <SelectModality
            modality={modality}
            onPress={(data) => this.setState({ active: 4, modality: data })}
            onStartOver={() => this.startOver()}
            onConfirm={(data) => this.setState({ active: 5, modality: data })}
          />
        }
        {
          nav[active] == "Reason" &&
          <SelectReason
            reason={reason}
            onPress={(data) => this.setState({ active: 5, reason: data })}
            onStartOver={() => this.startOver()}
            onConfirm={(data) => this.setState({ active: 5, reason: data })}
          />
        }
        {
          nav[active] == "Preview" &&
          <Preview
            advisor={advisor}
            modality={modality}
            reason={reason}
            onStartOver={() => this.startOver()}
            onChange={(item) => this.setState({ active: parseInt(item.id) + 1 })}
          />
        }
      </View>
    );
  }
}
const dimensions = {
  width: Dimensions.get("window").width / 1.5,
};

const styles = StyleSheet.create({
  StudentInfoPageContainer: {
    display: "flex",
    flexDirection: "column",
    width: dimensions.width,
    paddingHorizontal: 60,
    paddingVertical: 66
  },
  StudentInfoContainer: {
    width: 1280,
    height: 100,
    position: "absolute"
  },
  StudentInfoNameContainer: {
    top: 65,
    left: 120,
    width: 450,
    height: 50,
    position: "absolute",
    backgroundColor: "rgba(247, 105, 2, 1)",
    flexDirection: "column",
    display: "flex"
  },
  StudentNameText: {
    fontFamily: "Helvetica",
    fontStyle: "normal",
    fontWeight: 400,
    color: "rgba(255, 255, 255, 1)",
    height: 40,
    textAlign: "center",
    fontSize: 36,
    marginTop: 5
  },
  StudentMajorText: {
    fontFamily: "Helvetica",
    top: 145,
    left: 189,
    position: "absolute",
    fontStyle: "normal",
    fontWeight: 400,
    color: "#121212",
    height: 30,
    width: 300
  },
  StudentEmailText: {
    fontFamily: "Helvetica",
    top: 205,
    left: 189,
    position: "absolute",
    fontStyle: "normal",
    fontWeight: 400,
    color: "rgba(247, 105, 2, 1)",
    height: 30,
    width: 300
  },
  StudentUIDText: {
    fontFamily: "Helvetica",
    top: 260,
    left: 189,
    position: "absolute",
    fontStyle: "normal",
    fontWeight: 400,
    color: "rgba(247, 105, 2, 1)",
    height: 30,
    width: 300
  },
});
