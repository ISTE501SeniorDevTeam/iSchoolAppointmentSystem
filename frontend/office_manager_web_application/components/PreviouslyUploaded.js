import { Link } from "@react-navigation/native";
import React, { useEffect, useRef, useState } from "react";
import {
  Image,
  Pressable,
  ScrollView,
  StyleSheet,
  Text,
  View,
} from "react-native";
import { useHover } from "react-native-web-hooks";
import { images } from "../assets/Utility";
import { colors } from "../styles/Main";

let currentlyDisplayingStatic = [
  {
    fileName: "Week 10 Info",
    url: "https://cpb-us-e2.wpmucdn.com/faculty.sites.uci.edu/dist/1/303/files/2016/06/Anth-102-0419-syllabus-Fall-2011.pdf",
  },
  {
    fileName: "Enrollment Help",
    url: "https://cpb-us-e2.wpmucdn.com/faculty.sites.uci.edu/dist/1/303/files/2016/06/Anth-102-0419-syllabus-Fall-2011.pdf",
  },
];

let previouslyUploadedStatic = [
  {
    fileName: "Week 9 Info",
    url: "https://source.unsplash.com/1920x1080",
  },
  {
    fileName: "Week 8 Info",
    url: "https://cpb-us-e2.wpmucdn.com/faculty.sites.uci.edu/dist/1/303/files/2016/06/Anth-102-0419-syllabus-Fall-2011.pdf",
  },
];
export const PreviouslyUploaded = (props) => {
  const [currentlyDisplaying, setCurrentyDisplaying] = useState(
    currentlyDisplayingStatic
  );
  const [previouslyUploaded, setPreviouslyUploaded] = useState(
    previouslyUploadedStatic
  );
  useEffect(() => {
    // axios
    //   .get(util.api_url + "getPreviouslyUploadedItems()", {
    //     headers: {},
    //   })
    //   .then((res) => {
    //     this.state = {
    //       currentlyDisplaying: res.data,
    //     };
    //   })
    //   .catch((res) => {});
    // axios
    //   .get(util.api_url + "getCurrentlyDisplaying()", {
    //     headers: {},
    //   })
    //   .then((res) => {
    //     this.state = {
    //       previouslyUploaded: res.data,
    //     };
    //   })
    //   .catch((res) => {});
  });
  return (
    <ScrollView style={styles.topView} showsVerticalScrollIndicator={false}>
      <View style={styles.headerTextContainer}>
        <Text style={styles.headerText}>Currently Displaying</Text>
      </View>
      <View style={styles.filesContainer}>
        {currentlyDisplaying.map((file) => {
          const containerRef = useRef(null);
          const containerIsHovered = useHover(containerRef);
          const stopDisplayingRef = useRef(null);
          const stopDisplayingIsHovered = useHover(stopDisplayingRef);
          const viewButtonRef = useRef(null);
          const viewButtonIsHovered = useHover(viewButtonRef);
          const deleteButtonRef = useRef(null);
          const deleteButtonIsHovered = useHover(deleteButtonRef);
          return (
            <View
              style={[
                styles.fileNameRow,
                containerIsHovered && styles.fileNameRowHovered,
              ]}
              ref={containerRef}
              key={file.fileName}
            >
              <Text style={styles.fileName}>{file.fileName}</Text>
              <View style={styles.actionButtonContainer}>
                <Pressable
                  ref={stopDisplayingRef}
                  style={[
                    styles.actionButton,
                    styles.stopDisplayingButton,
                    stopDisplayingIsHovered &&
                      styles.stopDisplayingButtonHovered,
                  ]}
                >
                  <Text style={styles.stopDisplayingText}>Stop Displaying</Text>
                </Pressable>
                <Pressable
                  ref={viewButtonRef}
                  style={[
                    styles.actionButton,
                    viewButtonIsHovered && styles.deleteButtonHovered,
                  ]}
                  onPress={() => window.open(file.url)}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      viewButtonIsHovered && styles.deleteTextHovered,
                    ]}
                  >
                    View
                  </Text>
                </Pressable>
                <Pressable
                  ref={deleteButtonRef}
                  style={[
                    styles.actionButton,
                    deleteButtonIsHovered && styles.deleteButtonHovered,
                  ]}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      deleteButtonIsHovered && styles.deleteTextHovered,
                    ]}
                  >
                    Delete
                  </Text>
                </Pressable>
              </View>
            </View>
          );
        })}
      </View>
      <View style={styles.headerTextContainer}>
        <Text style={styles.headerText}>Previously Uploaded</Text>
      </View>
      <View style={styles.filesContainer}>
        {previouslyUploaded.map((file) => {
          const containerRef = useRef(null);
          const containerIsHovered = useHover(containerRef);
          const stopDisplayingRef = useRef(null);
          const stopDisplayingIsHovered = useHover(stopDisplayingRef);
          const viewButtonRef = useRef(null);
          const viewButtonIsHovered = useHover(viewButtonRef);
          const deleteButtonRef = useRef(null);
          const deleteButtonIsHovered = useHover(deleteButtonRef);
          return (
            <View
              style={[
                styles.fileNameRow,
                containerIsHovered && styles.fileNameRowHovered,
              ]}
              ref={containerRef}
              key={file.fileName}
            >
              <Text style={styles.fileName}>{file.fileName}</Text>
              <View style={styles.actionButtonContainer}>
                <Pressable
                  ref={stopDisplayingRef}
                  style={[
                    styles.actionButton,
                    styles.stopDisplayingButton,
                    stopDisplayingIsHovered &&
                      styles.stopDisplayingButtonHovered,
                  ]}
                >
                  <Text style={styles.stopDisplayingText}>
                    Start Displaying
                  </Text>
                </Pressable>
                <Pressable
                  ref={viewButtonRef}
                  onPress={() => window.open(file.url)}
                  style={[
                    styles.actionButton,
                    viewButtonIsHovered && styles.deleteButtonHovered,
                  ]}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      viewButtonIsHovered && styles.deleteTextHovered,
                    ]}
                  >
                    View
                  </Text>
                </Pressable>
                <Pressable
                  ref={deleteButtonRef}
                  style={[
                    styles.actionButton,
                    deleteButtonIsHovered && styles.deleteButtonHovered,
                  ]}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      deleteButtonIsHovered && styles.deleteTextHovered,
                    ]}
                  >
                    Delete
                  </Text>
                </Pressable>
              </View>
            </View>
          );
        })}
      </View>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  topView: {
    flex: 1,
    marginRight: 48,
    marginStart: 35,
  },
  headerTextContainer: {
    marginTop: 30,
    flexDirection: "row",
  },
  headerText: {
    paddingEnd: 22,
    paddingVertical: 4,
    backgroundColor: colors.ritThemeColor,
    color: "white",
    paddingStart: 56,
    fontSize: 20,
  },
  filesContainer: {
    marginTop: 16,
  },
  fileNameRow: {
    flexDirection: "row",
    justifyContent: "space-between",
    padding: 12,
  },
  fileNameRowHovered: {
    backgroundColor: "rgba(247, 105, 2, 0.2)",
  },
  fileName: {
    alignSelf: "center",
    fontSize: 16,
  },
  actionButtonContainer: {
    flexDirection: "row",
  },
  actionButton: {
    borderColor: colors.ritThemeColor,
    borderWidth: 3,
    paddingVertical: 6,
    paddingHorizontal: 16,
    marginRight: 10,
  },
  stopDisplayingButton: {
    backgroundColor: colors.ritThemeColor,
  },
  stopDisplayingButtonHovered: {
    backgroundColor: "black",
    borderColor: "black",
  },
  stopDisplayingText: {
    color: "white",
    fontWeight: "600",
  },
  deleteButtonHovered: {
    backgroundColor: "black",
    borderColor: "black",
  },
  deleteText: {
    color: colors.ritThemeColor,
    fontWeight: "600",
  },
  deleteTextHovered: {
    color: "white",
  },
});
