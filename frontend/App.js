import { StatusBar } from 'expo-status-bar';
import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Welcome from './Welcome';
import SwipedScreen from './SwipedScreen';
import Reasons from './reasons';

const Stack = createNativeStackNavigator();

export default function App() {
  return (
    <NavigationContainer>
        <StatusBar style="auto" />
        <Stack.Navigator initialRouteName="welcome" screenOptions={{headerShown: false}}>
          <Stack.Screen name="welcome" component={Welcome} options={{animation: "none"}}></Stack.Screen>
          <Stack.Screen name="swiped_screen" component={SwipedScreen} options={{animation: "none"}}></Stack.Screen>
          <Stack.Screen name="reasons" component={Reasons} options={{animation: "none"}}></Stack.Screen>
        </Stack.Navigator> 
    </NavigationContainer>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
