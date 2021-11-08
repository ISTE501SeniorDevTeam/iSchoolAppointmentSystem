import React, { useState } from "react";
import {
  Dimensions,
  Image,
  Pressable,
  StyleSheet,
  Text,
  View,
} from "react-native";
import { util } from "../assets/Utility";
import { colors } from "../styles/Main";

/**
 * This is the functional component representing the orange sidebar
 * that is part of the user screen, that holds the buttons and the welcome text
 * Author: Raghul Krishnan
 */
export const OrangeSideBar = (props) => {
  let [infoPressed, setInfoPressed] = useState(false);
  let [studentsPressed, setStudentsPressed] = useState(true);
  return (
    <View style={styles.topView}>
      <View>
        <Text style={styles.welcomeText}>Welcome</Text>
        <Text style={styles.userName}>{props.userName}</Text>
        <Pressable
          style={
            studentsPressed
              ? [
                  styles.sideBarButton,
                  { backgroundColor: colors.themeBlackColor },
                ]
              : styles.sideBarButton
          }
          onPress={() => {
            setStudentsPressed(true);
            setInfoPressed(false);
            props.studentsClicked();
          }}
        >
          <Text style={styles.sideBarText}>Students</Text>
        </Pressable>
        {props.userRole == "Office Manager" && (
          <Pressable
            style={
              infoPressed
                ? [
                    styles.sideBarButton,
                    { marginTop: 15, backgroundColor: colors.themeBlackColor },
                  ]
                : [styles.sideBarButton, { marginTop: 15 }]
            }
            onPress={() => {
              setInfoPressed(true);
              setStudentsPressed(false);
              props.infoUploadClicked();
            }}
          >
            <Text style={styles.sideBarText}>Info Upload</Text>
          </Pressable>
        )}
      </View>
      <View>
        <Pressable onPress={technicalSupportClicked}>
          <Text style={styles.technicalSupportText}>Technical Support</Text>
        </Pressable>
        <Pressable style={styles.signOutButton} onPress={signOut}>
          <Text style={styles.signOutText}>Sign out</Text>
        </Pressable>
        <Image
          source={require("../assets/RIT white logo.png")}
          style={styles.ritImage}
        />
      </View>
    </View>
  );
};

const technicalSupportClicked = () => {
  window.open(util.technicalSuppportLink, "_blank");
};

const signOut = () => {
  // sign out logic here
};

const dimensions = {
  width: Dimensions.get("window").width / 6,
};

const styles = StyleSheet.create({
  topView: {
    backgroundColor: colors.ritThemeColor,
    width: dimensions.width,
    paddingLeft: 12,
    paddingTop: 16,
    justifyContent: "space-between",
  },
  welcomeText: {
    color: "white",
    fontSize: 16,
    paddingRight: 15,
    fontWeight: "700",
  },
  userName: {
    fontSize: 24,
    fontWeight: "300",
    marginTop: 12,
    paddingRight: 15,
    color: "white",
  },
  sideBarButton: {
    marginTop: 40,
    paddingVertical: 20,
    paddingLeft: 4,
    color: "white",
  },
  sideBarText: {
    fontSize: 16,
    fontWeight: "700",
    color: "white",
  },
  technicalSupportText: {
    color: "white",
    fontSize: 16,
  },
  signOutButton: {
    marginTop: 16,
    marginBottom: 36,
  },
  signOutText: {
    color: "white",
    fontSize: 16,
  },
  ritImage: {
    height: dimensions.width / 7.8,
    marginBottom: 15,
    marginRight: 15,
  },
});

export default OrangeSideBar;
