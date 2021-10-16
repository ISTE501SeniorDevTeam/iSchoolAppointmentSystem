import React from "react";
import { Button, View } from "react-native";
import { util } from "../assets/Utility";

export default class Availability extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      advisorWaitTime: "",
    };
  }

  onSelect = () => {
    this.props.navigation.navigate("reasons", {
      selectedAdvisor: "Andy Advisor",
      advisorWaitTime:
        this.state.advisorWaitTime != "" ? this.state.advisorWaitTime : 4,
    });
  };

  // getAdvisorWaitTime = () => {
  //     axios
  //       .get(util.api_url + "getAdvisorAndStudentsInTheirQueueApi()", {
  //         headers: {},
  //       })
  //       .then((res) => {
  //         this.setState({
  //                 advisorWaitTime: res.data.length * util.averageTimePerStudent,
  //         });
  //       })
  //       .catch((res) => {});
  //   };

  render() {
    return (
      <View>
        <Button title="Select" onPress={this.onSelect} />
      </View>
    );
  }
}
