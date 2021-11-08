import React from 'react'
import { View, Text, ActivityIndicator, StyleSheet, Pressable } from 'react-native'
import { colors } from '../../styles/Main'
import ProgressBar from './ProgressBar';

export default function Loading(props) {
    return (
        <View style={styles.container}>
            <ProgressBar width={"7%"} />
            <ActivityIndicator color={colors.ritThemeColor} size={100} style={styles.loading} />
            <View style={styles.actionButtonContainer}>
                <Pressable
                    style={({ pressed }) => [
                        {
                            backgroundColor: pressed ? "#C75300" + 50 : colors.white,
                            borderColor: pressed ? "#C75300" : "black",
                        },
                        styles.actionButton,
                    ]}
                >
                    <Text style={[
                        styles.actionButtonText,
                        {
                            color: "#C75300"
                        }
                    ]}
                    >
                        Start Over
                    </Text>
                </Pressable>
                <Pressable
                    onPress={() => props.onPress()}
                    style={({ pressed }) => [
                        styles.actionButton,
                        {
                            backgroundColor: pressed ? colors.ritThemeColor + 80 : colors.ritThemeColor,
                        },
                    ]}
                >
                    <Text style={[
                        {
                            color: colors.white
                        },
                        styles.actionButtonText,
                    ]}
                    >
                        Next
                    </Text>
                </Pressable>
            </View>
        </View>

    )
}


const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: colors.white,
    },
    loading: {
        marginTop: 200
    },
    actionButtonContainer: {
        position: "absolute",
        flexDirection: "row",
        justifyContent: "space-between",
        left: 0,
        right: 0,
        bottom: 60,
    },
    actionButton: {
        borderWidth: 1,
        paddingVertical: 7,
        paddingHorizontal: 20,
        elevation: 3,
        borderColor: colors.ritThemeColor,
    },
    actionButtonText: {
        fontWeight: "bold",
    },
});
