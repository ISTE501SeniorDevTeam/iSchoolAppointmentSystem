import { StatusBar } from "expo-status-bar";
import React from "react";
import SafeAreaView, { SafeAreaProvider } from "react-native-safe-area-view";
import { NavigationContainer } from "@react-navigation/native";
import { createNativeStackNavigator } from "@react-navigation/native-stack";
import Welcome from "./screens/Welcome";
import SwipedScreen from "./screens/SwipedScreen";
import Reasons from "./screens/Reasons";
import Availability from "./screens/Availability";
import DegreeLevel from "./screens/DegreeLevel";
import MajorSelection from "./screens/MajorSelection";
import { ThankYou } from "./screens/ThankYou";

const Stack = createNativeStackNavigator();

export default function App() {
  return (
    <SafeAreaProvider>
      <StatusBar style="auto" />
      <SafeAreaView
        forceInset={{ top: "always", bottom: "never" }}
        style={{ flex: 1 }}
      >
        <NavigationContainer>
          <Stack.Navigator
            initialRouteName="welcome"
            screenOptions={{ headerShown: false }}
          >
            <Stack.Screen
              name="welcome"
              component={Welcome}
              options={{ animation: "none" }}
            ></Stack.Screen>
            <Stack.Screen
              name="swiped_screen"
              component={SwipedScreen}
              options={{ animation: "none" }}
            />
            <Stack.Screen
              name="degree_level"
              component={DegreeLevel}
              options={{ animation: "none" }}
            />
            <Stack.Screen
              name="major_selection"
              component={MajorSelection}
              options={{ animation: "none" }}
            />
            <Stack.Screen
              name="availability"
              component={Availability}
              options={{ animation: "none" }}
            ></Stack.Screen>
            <Stack.Screen
              name="reasons"
              component={Reasons}
              options={{ animation: "none" }}
            ></Stack.Screen>
            <Stack.Screen
              name="thank_you"
              component={ThankYou}
              options={{ animation: "none" }}
            ></Stack.Screen>
          </Stack.Navigator>
        </NavigationContainer>
      </SafeAreaView>
    </SafeAreaProvider>
  );
}
