import React from "react";
import { View, StyleSheet, Image, Dimensions, Text } from "react-native";
// import axios from "axios";
import { images, util } from "./Utility";
import { Video } from "expo-av";

let mediaContent = {
  title:
    "Golisano College School of Information Presents: Jump Starting Your Career",
  firstLine: "November 09, 2021",
  secondLine: "3:30 pm - 4:30 pm",
  thirdLine: "Virtual",
  /* Uncomment the media and mediaType values that are commented and comment the current media and mediaType values to see an image 
  instead of video being displayed at the bottom bar */
  media: "http://d23dyxeqlo5psv.cloudfront.net/big_buck_bunny.mp4",
  //   media: "https://source.unsplash.com/830x350?technology",
  mediaType: "video",
  //   mediaType: "image",
};

/**
 * This class is resposnsible for rendering the bottom bar that shows the news content.
 * Author: Raghul Krishnan
 */
export default class InformationContainer extends React.Component {
  videoRef;
  constructor(props) {
    super(props);
    this.state = {
      mediaContent: mediaContent,
    };
    this.getData();
  }

  getData = () => {
    // setTimeout(() =>{
    // axios
    //   .get(util.api_url + "getAvailableAdvisorsWithStudentsInTheQueueApi()", {
    //     headers: { },
    //   })
    //   .then((res) => {
    //     this.state = {
    //        advisorsStudentList: res.data
    //     }
    //   })
    //   .catch((res) => {});
    // axios
    //   .get(util.api_url + "getMediaContent()", {
    //     headers: {},
    //   })
    //   .then((res) => {
    //     this.state = {
    //       mediaContent: res.data,
    //     };
    //   });
    // }, 5000)
  };

  render() {
    return (
      <View style={styles.topView}>
        <View style={styles.newsContainer}>
          <View style={styles.newsContentContainer}>
            <View style={styles.floatingHeader}>
              <Text style={styles.newsHeaderText}>What's Going On?</Text>
            </View>
            <Text style={styles.newsTitleText}>
              {this.state.mediaContent.title}
            </Text>
            <View style={styles.informationContainer}>
              {Object.keys(this.state.mediaContent).map((key) => {
                return (
                  !key.startsWith("media") &&
                  key != "title" && (
                    <Text style={styles.informationText} key={key}>
                      {this.state.mediaContent[key]}
                    </Text>
                  )
                );
              })}
            </View>
          </View>
          {this.state.mediaContent.mediaType == "image" && (
            <Image
              source={this.state.mediaContent.media}
              style={{
                width: Dimensions.get("window").width * 0.5 - 165,
              }}
            />
          )}
          {this.state.mediaContent.mediaType == "video" && (
            <Video
              style={{
                width: Dimensions.get("window").width * 0.5 - 165,
              }}
              source={{
                uri: this.state.mediaContent.media,
              }}
              useNativeControls
              resizeMode="cover"
              isLooping
              shouldPlay={true}
            />
          )}
          <Image
            source={images.rit_gccis_image}
            style={{
              width: 289,
            }}
          />
        </View>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  topView: {
    flex: 1,
  },
  floatingHeader: {
    flexDirection: "row",
    zIndex: 10,
  },
  newsContainer: {
    flex: 1,
    bottom: 0,
    position: "absolute",
    left: 0,
    borderWidth: 6,
    borderColor: util.rit_primary_color,
    flexDirection: "row",
    maxHeight: Dimensions.get("window").height * 0.32,
  },
  newsContentContainer: {
    position: "relative",
    bottom: 40,
    left: 20,
    marginStart: 24,
    flexDirection: "column",
    marginRight: 32,
    flexWrap: "wrap",
    width: Dimensions.get("window").width * 0.4,
  },
  newsHeaderText: {
    padding: 12,
    backgroundColor: util.rit_primary_color,
    borderRadius: 4,
    borderBottomLeftRadius: 16,
    color: "white",
    fontSize: 32,
    fontWeight: "bold",
  },
  newsTitleText: {
    marginTop: 24,
    fontSize: 24,
    fontWeight: "bold",
    flexWrap: "wrap",
  },
  informationContainer: {
    marginTop: 56,
    fontWeight: "bold",
    fontSize: 24,
  },
  informationText: {
    fontSize: 24,
  },
});
