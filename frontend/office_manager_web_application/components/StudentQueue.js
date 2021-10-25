import React, { useRef } from "react";
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

export const StudentQueue = (props) => {
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
                        onMagicTap
                      >
                        <Text style={styles.editText}>Edit</Text>
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
          </View>
        );
      })}
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
});
