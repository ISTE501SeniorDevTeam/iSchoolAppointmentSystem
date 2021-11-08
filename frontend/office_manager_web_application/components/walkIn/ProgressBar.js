import React from 'react'
import { View, Text, StyleSheet } from 'react-native'
import { colors } from '../../styles/Main'

export default function ProgressBar({ width, progress }) {
    return (
        <View style={styles.container} >
            <View style={[styles.prog, { width: width }]}>
                <Text style={styles.txt}>{progress??0}%</Text>
            </View>
        </View>
    )
}

const styles = StyleSheet.create({
    container: {
        width: "100%",
        // marginVertical: 66,
        alignSelf: "center",
        backgroundColor: "#D0D3D4"
    },
    prog: {
        backgroundColor: colors.ritThemeColor,
        height: 40,
        paddingHorizontal: 13,
        justifyContent: 'center',
        alignItems: 'flex-start',
    },
    txt: {
        fontFamily: "Helvetica",
        fontSize: 24,
        fontStyle: 'normal',
        lineHeight: 28,
        textAlign: 'left',
        fontWeight: 700,
        color: colors.white,
    }
})
