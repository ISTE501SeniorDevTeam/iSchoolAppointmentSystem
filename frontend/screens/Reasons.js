import React from "react";
import {FlatList, Pressable,View, StyleSheet, Text, ImageBackground, Dimensions, Image, TextInput} from 'react-native';
import axios from "axios";
import {util} from "../assets/Utility"
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
    "Other"
]

/**
 * This is the class displaying the Reasons view
 * Author: Raghul Krishnan
 */
export default class Reasons extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
          reasonsData: reasons,
        }
        // this.getData();
        this.prepareData();
    }

    // getData = () => {
    //   axios
    //     .get(util.api_url, {
    //       headers: { },
    //     })
    //     .then((res) => {
    //       this.setState({
    //       });
    //     })
    //     .catch((res) => {});
    // }

    prepareData = () => {
      let reasonsObject = []
      reasons.forEach(reason => {
        reasonsObject.push({
          reason,
          selected: false
        })
      })
      this.state = {
        reasonsData: reasonsObject
      }
    }

    onReasonSelect = (selectedReason) => {
      let newReasons  = this.state.reasonsData.map(ele => {
        ele.selected = false
        return ele
      })
      newReasons.filter(ele => ele.reason == selectedReason)[0].selected = true
      this.setState({
        reasonsData: newReasons
      })
    }

    doneSelected = () => {

    }

    render() {
        return(
            <View>
              <ImageBackground style={styles.backgroundImage} source={require('../assets/reasons-background.png')} >
                <Image style={styles.ritHeaderImage} source={require('../assets/RIT.jpg')} />
                <View style={styles.advisorImageTextContainer}>
                  <Image style={styles.advisorImage} source={require('../assets/advisor-image.png')} />
                  {/* change this line of code later */}
                  <View style={{flexDirection: "column", justifyContent: "space-between"}}>
                    <Text style={styles.advisorName}>{this.props.route.params ? this.props.route.params.selectedAdvisor : "Andy Advisor"}</Text>
                    <Text style={styles.waitTime}>Estimated Wait: <Text style={{fontWeight: "bold"}}>4 Minutes</Text></Text>
                  </View>
                </View>
                <Text style={styles.header}>Reason for Walk-in</Text>
                <FlatList
                    data={this.state.reasonsData}
                    contentContainerStyle={styles.reasonContainer}
                    renderItem={({item}) => (
                        <Pressable
                        onPress={() => this.onReasonSelect(item.reason)}
                        android_disableSound={true}
                        style={[
                          {
                            backgroundColor: item.selected ? colors.ritThemeColor : "none" ,
                            borderColor: item.selected ? colors.ritThemeColor : "#000",
                          },
                          styles.reasonCard
                        ]}
                        >
                        <Text style={[{color: item.selected ? "white": "#C75300"}, styles.reasonText]}>{item.reason}</Text>
                        </Pressable>
                    )}
                    numColumns={this.state.reasonsData.length > 8 ? 3 : 2}
                    keyExtractor={(item) => item.reason.toString()}
                />
                <View style={styles.actionButtonContainer}>
                  <Pressable onPress={() => this.props.navigation.goBack()} style={[styles.actionButton, {borderColor: colors.ritThemeColor}]}>
                      <Text style={[styles.actionButtonText, {color: colors.ritThemeColor}]}>Back</Text>
                  </Pressable>
                  <Pressable onPress={this.doneSelected} style={({pressed}) => [{
                      backgroundColor: pressed ? colors.ritThemeColor : "none",
                      borderColor: pressed ? colors.ritThemeColor : "black"
                    }, styles.actionButton
                  ]}>
                    <Text style={styles.actionButtonText}>Done</Text>
                  </Pressable>
                </View>
              </ImageBackground>
            </View>
        )
    }
}

const dimensions = {
  marginLeft: 24,
}

const styles = StyleSheet.create({
  backgroundImage: {
    flex: 1,
    display: "flex",
    height: Dimensions.get('window').height,
    width: Dimensions.get('window').width
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
    paddingRight: 60
  },
  waitTime: {
    marginLeft: 15
  },
  advisorImageTextContainer: {
    marginTop: 42,
    flexDirection:"row",
    flexWrap: "wrap"
  },
  header: {
    marginTop: 30,
    marginLeft: dimensions.marginLeft,
    fontSize: 36,
  },
  reasonContainer: {
    marginTop: 12,
    marginHorizontal: dimensions.marginLeft,
    alignContent: "space-around",
    marginBottom: 20
  },
  reasonCard: {
    textAlign:"center",
    borderWidth: 3,
    flex: 1,
    padding: 16,
    marginBottom: 20,
    marginRight: 20,
    borderRadius: 4,
    justifyContent: 'center',
  },
  reasonText: {
    fontWeight: "600",
    fontSize: 16
  },
  actionButtonContainer: {
    flexDirection: "row",
    justifyContent: "space-around"
  },
  actionButton: {
    borderWidth: 3,
    paddingVertical: 5,
    paddingHorizontal: 20,
    elevation: 3,
  },
  actionButtonText: {
    fontWeight: "bold"
  }
});