import React, { useRef, useState } from "react";
import {
  Dimensions,
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
import Modal from "react-native-modal";

export const StudentQueue = (props) => {
  const [modalVisible, setModalVisible] = useState(false);
  const [selectedStudent, setSelectedStudent] = useState(null);

  let setModalVisibility = (studentName) => {
    setSelectedStudent(studentName);
    setModalVisible(!modalVisible);
  };

  const cancelButtonInModalRef = useRef(null);
  const cancelButtonInModalHovered = useHover(cancelButtonInModalRef);
  const deleteButtonInModalRef = useRef(null);
  const deleteButtonInModalHovered = useHover(deleteButtonInModalRef);

  return (
    <ScrollView style={styles.topView} showsVerticalScrollIndicator={false}>
      {props.queueData.map((queue) => {
        return (
          <View key={queue.advisorName}>
            <View style={styles.advisorImageTextContainer}>
              <Image
                style={styles.advisorImage}
                source={images.andy_advisor_image_url}
              />
              <View
                style={{
                  flexDirection: "column",
                  justifyContent: "space-between",
                }}
              >
                <Text style={styles.advisorName}>{queue.advisorName}</Text>
              </View>
            </View>
            <View style={styles.studentListContainer}>
              {queue.studentsInTheQueue.map((student) => {
                const containerRef = useRef(null);
                const containerIsHovered = useHover(containerRef);
                const editButtonRef = useRef(null);
                const editButtonIsHovered = useHover(editButtonRef);
                const deleteButtonRef = useRef(null);
                const deleteButtonIsHovered = useHover(deleteButtonRef);
                return (
                  <View
                    style={[
                      styles.studentRow,
                      containerIsHovered && styles.studentRowHovered,
                    ]}
                    ref={containerRef}
                    key={student.emailAddress}
                  >
                    <Text style={styles.studentName}>
                      {student.studentDisplayName}
                    </Text>
                    <View style={styles.actionButtonContainer}>
                      <Pressable
                        ref={editButtonRef}
                        style={[
                          styles.actionButton,
                          styles.editButton,
                          editButtonIsHovered && styles.editButtonHovered,
                        ]}
                      >
                        <Text style={styles.editText}>Edit</Text>
                      </Pressable>
                      <Pressable
                        ref={deleteButtonRef}
                        onPress={() =>
                          setModalVisibility(student.studentDisplayName)
                        }
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
          </View>
        );
      })}
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
              <Text style={styles.orangeLargeBoldText}>{selectedStudent}</Text>
              <View style={styles.modalActionButtonContainer}>
                <Pressable
                  ref={cancelButtonInModalRef}
                  onPress={() => setModalVisible(!modalVisible)}
                  style={[
                    styles.actionButton,
                    cancelButtonInModalHovered && styles.deleteButtonHovered,
                  ]}
                >
                  <Text
                    style={[
                      styles.deleteText,
                      cancelButtonInModalHovered && styles.deleteTextHovered,
                    ]}
                  >
                    Cancel
                  </Text>
                </Pressable>
                <Pressable
                  ref={deleteButtonInModalRef}
                  style={[
                    styles.actionButton,
                    styles.editButton,
                    deleteButtonInModalHovered && styles.editButtonHovered,
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
    marginTop: 30,
  },
  advisorImageTextContainer: {
    marginTop: 30,
    flexDirection: "row",
    flexWrap: "wrap",
    marginLeft: 48,
  },
  advisorImage: {
    width: 95,
    height: 95,
    borderColor: colors.ritThemeColor,
    borderWidth: 4,
  },
  advisorName: {
    borderColor: colors.ritThemeColor,
    backgroundColor: colors.ritThemeColor,
    marginTop: 5,
    paddingBottom: 1,
    paddingLeft: 45,
    fontSize: 18,
    color: "white",
    paddingRight: 18,
  },
  studentListContainer: {
    marginTop: 16,
  },
  studentRow: {
    flexDirection: "row",
    justifyContent: "space-between",
    padding: 12,
    marginLeft: 36,
  },
  studentRowHovered: {
    backgroundColor: "rgba(247, 105, 2, 0.2)",
  },
  studentName: {
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
    fontSize: 16,
  },
  editButton: {
    backgroundColor: colors.ritThemeColor,
  },
  editButtonHovered: {
    backgroundColor: "black",
    borderColor: "black",
  },
  editText: {
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
