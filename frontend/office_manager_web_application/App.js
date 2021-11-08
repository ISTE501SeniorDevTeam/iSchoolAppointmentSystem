import { StatusBar } from "expo-status-bar";
import React from "react";
import SafeAreaView, { SafeAreaProvider } from "react-native-safe-area-view";
import { NavigationContainer } from "@react-navigation/native";
import { createNativeStackNavigator } from "@react-navigation/native-stack";
import Home from "./screens/Home";
import SelectAdvisor from "./screens/SelectAdvisor";

const Stack = createNativeStackNavigator();

/**
 * This is main entry point for the office manager app
 * Author: Raghul Krishnan
 */
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
            initialRouteName="Home"
            screenOptions={{ headerShown: false }}
          >
            <Stack.Screen
              name="Home"
              component={Home}
              options={{ animation: "none" }}
            />
            <Stack.Screen
              name="SelectAdvisor"
              component={SelectAdvisor}
              options={{ animation: "none" }}
            />
          </Stack.Navigator>
        </NavigationContainer>
      </SafeAreaView>
    </SafeAreaProvider>
  );
}
