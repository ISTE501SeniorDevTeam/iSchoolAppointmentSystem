import React, { useEffect, useRef, useState } from 'react'
import { View, Text, StyleSheet, Pressable, FlatList, TouchableOpacity, ScrollView } from 'react-native'
import { useHover } from 'react-native-web-hooks';
import { colors } from '../../styles/Main';
import ProgressBar from './ProgressBar'

const list = [
    {
        id: "1",
        name: "Online",
    },
    {
        id: "2",
        name: "In Person",
    },
]
export default function SelectModality(props) {
    const { modality } = props;
    const [selected, setSelected] = useState(null);
    useEffect(() => {
        if (modality) setSelected(modality)
    }, [modality]);

    return (
        <View style={styles.container}>
            {!modality && <ProgressBar width={"50%"} progress={50} />}
            <View style={styles.StudentInfoNameContainer}>
                <Text style={styles.StudentNameText}>
                    Sam Student
                </Text>
            </View>
            <Text style={styles.StudentMajorText}>
                Human Centered Computing
            </Text>
            <Text style={styles.StudentEmailText}>
                {"sys8392@g.rit.edu >"}
            </Text>
            <Text style={styles.StudentUIDText}>
                {"987654321 >"}
            </Text>
            <View style={styles.advisorContainer}>
                <View style={styles.advisorHead}>
                    <Text style={styles.advisorTxt}>Select A Modality</Text>
                </View>
                <ScrollView>
                    {list.map(item => {
                        const containerRef = useRef(null);
                        const containerIsHovered = useHover(containerRef);
                        return (
                            <TouchableOpacity
                                ref={containerRef}
                                style={[styles.list, { backgroundColor: containerIsHovered || selected?.id == item.id ? '#F76902' + 20 : 'white' }]}
                                key={item.id}
                                onPress={() => { setSelected(item); console.log(selected, item) }}
                            >
                                <View style={[styles.checkBox, { borderColor: selected?.id == item.id ? colors.ritThemeColor : 'black' }]}>
                                    {selected?.id == item.id && <View style={[styles.check]} />}
                                </View>
                                <Text style={styles.listName}>
                                    {item.name}
                                </Text>
                            </TouchableOpacity>
                        )
                    })}
                </ScrollView>
            </View>
            {modality ?
                <Pressable
                    onPress={() => props.onConfirm(selected)}
                    disabled={!selected}

                    style={({ pressed }) => [
                        styles.actionButton,
                        {
                            backgroundColor: pressed ? colors.ritThemeColor + 80 : !selected ? 'white' : colors.ritThemeColor,
                            borderColor: !selected ? 'black' : colors.ritThemeColor,
                            alignSelf: "flex-end"
                        },
                    ]}
                >
                    <Text style={[
                        {
                            color: !selected ? 'black' : colors.white
                        },
                        styles.actionButtonText,
                    ]}
                    >
                        Confirm
                    </Text>
                </Pressable>
                :
                <View style={styles.actionButtonContainer}>
                    <Pressable
                        onPress={() => props.onStartOver()}
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
                        onPress={() => props.onPress(selected)}
                        disabled={!selected}

                        style={({ pressed }) => [
                            styles.actionButton,
                            {
                                backgroundColor: pressed ? colors.ritThemeColor + 80 : !selected ? 'white' : colors.ritThemeColor,
                                borderColor: !selected ? 'black' : colors.ritThemeColor
                            },
                        ]}
                    >
                        <Text style={[
                            {
                                color: !selected ? 'black' : colors.white
                            },
                            styles.actionButtonText,
                        ]}
                        >
                            Next
                        </Text>
                    </Pressable>
                </View>}
        </View >
    )
}

const styles = StyleSheet.create({
    container: {
        flex: 1
    },
    list: {
        flexDirection: "row",
        alignItems: "center",
        height: 20,
        padding: 20,
        margin: 5
        // backgroundColor: 'grey'
    },
    listTime: {
        color: 'grey',
        fontSize: 12
    },
    listMint: {
        fontWeight: '700',
        color: 'black'
    },
    listName: {
        fontFamily: "Helvetica",
        fontStyle: "normal",
        fontSize: 14,
        fontWeight: "700",
        marginBottom: 5
    },
    check: {
        backgroundColor: colors.ritThemeColor,
        height: 14,
        width: 14,
        borderRadius: 7
    },
    checkBox: {
        height: 20,
        width: 20,
        justifyContent: 'center',
        alignItems: 'center',
        borderWidth: 1,
        borderRadius: 10,
        marginRight: 20
    },
    advisorContainer: {
        marginVertical: 30,
        borderWidth: 5,
        minHeight: 50,
        maxHeight: 250,
        paddingBottom: 20,
    },
    advisorTxt: {
        color: colors.white,
        fontFamily: "Helvetica",
        // marginVertical: 20,
        marginLeft: 20,
        paddingVertical: 10,
        fontStyle: "normal",
        fontWeight: 600,
        fontSize: 16
    },
    advisorHead: {
        backgroundColor: 'black',
        marginBottom: 20
    },
    StudentInfoContainer: {
        width: 1280,
        height: 100,
        // position: "absolute"
    },
    StudentInfoNameContainer: {
        marginTop: 50,
        backgroundColor: colors.ritThemeColor,
        width: 330,
        height: 50,
        paddingLeft: 80,
        justifyContent: 'center'
    },
    StudentNameText: {
        fontFamily: "Helvetica",
        fontStyle: "normal",
        fontWeight: 400,
        color: colors.white,
        fontSize: 36,
    },
    StudentMajorText: {
        fontFamily: "Helvetica",
        marginTop: 25,
        marginLeft: 80,
        fontStyle: "normal",
        fontWeight: 400,
        color: "#121212",
        fontSize: 16
    },
    StudentEmailText: {
        fontFamily: "Helvetica",
        marginVertical: 20,
        marginLeft: 80,
        fontStyle: "normal",
        fontWeight: 400,
        color: "rgba(247, 105, 2, 1)",
        fontSize: 16
    },
    StudentUIDText: {
        fontFamily: "Helvetica",
        marginLeft: 80,
        fontStyle: "normal",
        fontWeight: 400,
        color: "rgba(247, 105, 2, 1)",
        fontSize: 16
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
