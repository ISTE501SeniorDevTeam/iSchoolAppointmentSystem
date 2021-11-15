import React, { useEffect, useState } from "react";
import {
  Dimensions,
  Pressable,
  ScrollView,
  StyleSheet,
  Text,
  View,
} from "react-native";
import Modal from "react-native-modal";
import { useHover } from "react-native-web-hooks";
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

  const [modalVisible, setModalVisible] = useState(false);
  const [selectedFile, setSelectedFile] = useState(null);
  const [currentlyDisplayingSelected, setCurrentlyDisplayingSelected] =
    useState(false);

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

  let removeFile = () => {
    if (currentlyDisplayingSelected) {
      let currentlyDisplayingCopy = currentlyDisplaying;
      let index = currentlyDisplayingCopy.findIndex((file) => {
        return file.fileName == selectedFile;
      });
      currentlyDisplayingCopy.splice(index, 1);
      setCurrentyDisplaying(currentlyDisplayingCopy);
    } else {
      let previouslyUploadedCopy = previouslyUploaded;
      let index = previouslyUploadedCopy.findIndex((file) => {
        return file.fileName == selectedFile;
      });
      previouslyUploadedCopy.splice(index, 1);
      setPreviouslyUploaded(previouslyUploadedCopy);
    }

    // axios
    //   .post(
    //     util.api_url + "deleteFileFromList()",
    //     {
    //       file: selectedFile
    //     },
    //     {
    //       headers: {},
    //     }
    //   )
    //   .then((res) => {
    //     this.state = {
    //       queueData: res.data,
    //     };
    //   })
    //   .catch((res) => {});
  };

  return (
    <ScrollView style={styles.topView} showsVerticalScrollIndicator={false}>
      <View style={styles.headerTextContainer}>
        <Text style={styles.headerText}>Currently Displaying</Text>
      </View>
      <View style={styles.filesContainer}>
        {currentlyDisplaying.length == 0 && (
          <View style={styles.fileNameRow}>
            <Text
              style={[
                styles.fileName,
                { color: colors.ritThemeColor, fontWeight: "500" },
              ]}
            >
              Currently no files
            </Text>
          </View>
        )}
        {currentlyDisplaying.map((file) => {
          // const containerRef = useRef(null);
          // const containerIsHovered = useHover(containerRef);
          // const stopDisplayingRef = useRef(null);
          // const stopDisplayingIsHovered = useHover(stopDisplayingRef);
          // const viewButtonRef = useRef(null);
          // const viewButtonIsHovered = useHover(viewButtonRef);
          // const deleteButtonRef = useRef(null);
          // const deleteButtonIsHovered = useHover(deleteButtonRef);
          return (
            <View
              style={[
                styles.fileNameRow,
                // containerIsHovered && styles.fileNameRowHovered,
              ]}
              // ref={containerRef}
              key={file.fileName}
            >
              <Text style={styles.fileName}>{file.fileName}</Text>
              <View style={styles.actionButtonContainer}>
                <Pressable
                  // ref={stopDisplayingRef}
                  style={[
                    styles.actionButton,
                    styles.stopDisplayingButton,
                    // stopDisplayingIsHovered &&
                    //   styles.stopDisplayingButtonHovered,
                  ]}
                >
                  <Text style={styles.stopDisplayingText}>Stop Displaying</Text>
                </Pressable>
                <Pressable
                  // ref={viewButtonRef}
                  style={[
                    styles.actionButton,
                    // viewButtonIsHovered && styles.deleteButtonHovered,
                  ]}
                  onPress={() => window.open(file.url)}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      // viewButtonIsHovered && styles.deleteTextHovered,
                    ]}
                  >
                    View
                  </Text>
                </Pressable>
                <Pressable
                  // ref={deleteButtonRef}
                  style={[
                    styles.actionButton,
                    // deleteButtonIsHovered && styles.deleteButtonHovered,
                  ]}
                  onPress={() => {
                    setSelectedFile(file.fileName);
                    setCurrentlyDisplayingSelected(true);
                    setModalVisible(!modalVisible);
                  }}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      // deleteButtonIsHovered && styles.deleteTextHovered,
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
        {previouslyUploaded.length == 0 && (
          <View style={styles.fileNameRow}>
            <Text
              style={[
                styles.fileName,
                { color: colors.ritThemeColor, fontWeight: "500" },
              ]}
            >
              Currently no files
            </Text>
          </View>
        )}
        {previouslyUploaded.map((file) => {
          // const containerRef = useRef(null);
          // const containerIsHovered = useHover(containerRef);
          // const stopDisplayingRef = useRef(null);
          // const stopDisplayingIsHovered = useHover(stopDisplayingRef);
          // const viewButtonRef = useRef(null);
          // const viewButtonIsHovered = useHover(viewButtonRef);
          // const deleteButtonRef = useRef(null);
          // const deleteButtonIsHovered = useHover(deleteButtonRef);
          return (
            <View
              style={[
                styles.fileNameRow,
                // containerIsHovered && styles.fileNameRowHovered,
              ]}
              // ref={containerRef}
              key={file.fileName}
            >
              <Text style={styles.fileName}>{file.fileName}</Text>
              <View style={styles.actionButtonContainer}>
                <Pressable
                  // ref={stopDisplayingRef}
                  style={[
                    styles.actionButton,
                    styles.stopDisplayingButton,
                    // stopDisplayingIsHovered &&
                    //   styles.stopDisplayingButtonHovered,
                  ]}
                >
                  <Text style={styles.stopDisplayingText}>
                    Start Displaying
                  </Text>
                </Pressable>
                <Pressable
                  // ref={viewButtonRef}
                  onPress={() => window.open(file.url)}
                  style={[
                    styles.actionButton,
                    // viewButtonIsHovered && styles.deleteButtonHovered,
                  ]}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      // viewButtonIsHovered && styles.deleteTextHovered,
                    ]}
                  >
                    View
                  </Text>
                </Pressable>
                <Pressable
                  // ref={deleteButtonRef}
                  onPress={() => {
                    setSelectedFile(file.fileName);
                    setCurrentlyDisplayingSelected(false);
                    setModalVisible(!modalVisible);
                  }}
                  style={[
                    styles.actionButton,
                    // deleteButtonIsHovered && styles.deleteButtonHovered,
                  ]}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      // deleteButtonIsHovered && styles.deleteTextHovered,
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
      <Modal
        animationType="none"
        animationInTiming={1}
        animationOutTiming={1}
        transparent={true}
        isVisible={modalVisible}
        onRequestClose={() => {
          setModalVisible(!modalVisible);
        }}
      >
        <View style={styles.centeredView}>
          <View style={styles.modalView}>
            <Text style={styles.modalHeader}>Confirm Delete</Text>
            <View style={styles.modalBody}>
              <Text style={styles.blackMediumBoldText}>Are you sure?</Text>
              <Text style={styles.blackMediumText}>
                You are currently trying to delete
              </Text>
              <Text style={styles.orangeLargeBoldText}>{selectedFile}</Text>
              <View style={styles.modalActionButtonContainer}>
                <Pressable
                  // ref={cancelButtonInModalRef}
                  onPress={() => setModalVisible(!modalVisible)}
                  style={[
                    styles.actionButton,
                    // cancelButtonInModalHovered && styles.deleteButtonHovered,
                  ]}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      // cancelButtonInModalHovered && styles.deleteTextHovered,
                    ]}
                  >
                    Cancel
                  </Text>
                </Pressable>
                <Pressable
                  // ref={deleteButtonInModalRef}
                  onPress={() => {
                    removeFile();
                    setModalVisible(!modalVisible);
                  }}
                  style={[
                    styles.actionButton,
                    styles.editButton,
                    // deleteButtonInModalHovered && styles.editButtonHovered,
                  ]}
                >
                  <Text style={styles.editText}>Yes, Delete</Text>
                </Pressable>
              </View>
            </View>
          </View>
        </View>
      </Modal>
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

  editButton: {
    backgroundColor: colors.ritThemeColor,
  },
  editText: {
    color: "white",
    fontWeight: "600",
  },

  centeredView: {
    flex: 1,
    justifyContent: "center",
    marginTop: 16,
    alignSelf: "center",
  },
  modalView: {
    width: Dimensions.get("window").width / 3,
    maxWidth: 525,
    minHeight: 440,
    borderWidth: 3,
    borderColor: "black",
    margin: 20,
    backgroundColor: "white",
    flexDirection: "column",
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 4,
    elevation: 5,
  },
  modalHeader: {
    backgroundColor: "black",
    color: "white",
    paddingHorizontal: 20,
    paddingStart: 28,
    paddingVertical: 30,
    fontSize: 28,
  },
  modalBody: {
    margin: 20,
    flex: 1,
  },
  blackMediumBoldText: {
    fontWeight: "bold",
    fontSize: 19,
    marginTop: 24,
    marginBottom: 16,
  },
  blackMediumText: {
    fontSize: 19,
    marginBottom: 8,
  },
  orangeLargeBoldText: {
    flex: 1,
    fontSize: 25,
    fontWeight: "bold",
    color: colors.ritThemeColor,
    marginBottom: 50,
  },
  modalActionButtonContainer: {
    flexDirection: "row",
    justifyContent: "space-between",
  },
});
