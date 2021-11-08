import React, { useRef, useState } from 'react'
import { View, Text, StyleSheet, Pressable, FlatList, TouchableOpacity, ScrollView } from 'react-native'
import { useHover } from 'react-native-web-hooks';
import { colors } from '../../styles/Main';
import ProgressBar from './ProgressBar'
export default function Preview(props) {
    const [selected, setSelected] = useState(null);
    const [finish, setFinish] = useState(false)
    const { advisor, modality, reason } = props;

    const list = [
        {
            id: "1",
            name: "Usual Advisors",
            selected: advisor?.name
        },
        {
            id: "2",
            name: "Student Modality",
            selected: modality?.name
        },
        {
            id: "3",
            name: "Reason for Visit",
            selected: reason?.name
        },
    ]

    return (
        <View style={styles.container}>
            <ProgressBar width={"100%"} progress={100} />
            <View style={{ flexDirection: "row", justifyContent: "space-between", alignItems: "center" }}>
                <View>
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
                </View>
                {finish &&
                    <View style={styles.box}>
                        <View style={styles.head}>
                            <Text style={styles.advisorTxt}>Updated</Text>
                        </View>
                        <Text  style={[styles.listName, { color: 'black', fontSize: 14,fontWeight:"500", marginVertical: 15 }]}>
                            Advisor has been changed to
                        </Text>
                        <Text style={[styles.listName, { color: colors.ritThemeColor, fontSize: 14, marginVertical: 1 }]}>
                            Amy Advisor
                        </Text>
                        <Text style={[styles.listName, { color: "#C75300", fontSize: 14, marginVertical: 15, textDecorationLine:'underline' }]}>
                            Undo
                        </Text>
                    </View>
                }
            </View>
            <View style={styles.advisorContainer}>
                <ScrollView horizontal>
                    {list.map(item => {
                        return (
                            <TouchableOpacity
                                style={[styles.list]}
                                key={item.id}
                                onPress={() => { setSelected(item); console.log(selected, item) }}
                            >
                                <View style={styles.advisorHead}>
                                    <Text style={styles.listName}>
                                        {item.name}
                                    </Text>
                                    <View style={[styles.cross]} />
                                </View>
                                <Text style={[styles.listName, { color: 'black', fontSize: 16, marginVertical: 15 }]}>
                                    {item.selected}
                                </Text>
                                <Text
                                    style={styles.listTime}
                                    onPress={() => props.onChange(item)}
                                >
                                    {"Change >"}
                                </Text>
                            </TouchableOpacity>
                        )
                    })}
                </ScrollView>
            </View>

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
                    onPress={() => setFinish(true)}
                    style={({ pressed }) => [
                        styles.actionButton,
                        {
                            backgroundColor: pressed ? colors.ritThemeColor + 80 : colors.ritThemeColor,
                            borderColor: colors.ritThemeColor
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
                        Finish
                    </Text>
                </Pressable>
            </View>
        </View >
    )
}

const styles = StyleSheet.create({
    container: {
        flex: 1
    },
    box: {
        borderWidth: 3,
        width: 250,
        paddingHorizontal:20
    },
    head: {
        backgroundColor: 'black',
        marginHorizontal:-20
        // height: 50
    },
    list: {
        alignItems: "center",
        justifyContent: 'center',
        margin: 35
    },
    listTime: {
        color: colors.ritThemeColor,
        fontSize: 14
    },
    listMint: {
        fontWeight: '700',
        color: 'black'
    },
    listName: {
        fontFamily: "Helvetica",
        fontStyle: "normal",
        fontSize: 18,
        fontWeight: "700",
        color: colors.white,
        zIndex: 99
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
    },
    advisorTxt: {
        color: colors.white,
        fontFamily: "Helvetica",
        marginLeft: 20,
        paddingVertical: 10,
        fontStyle: "normal",
        fontWeight: 600,
        fontSize: 16
    },
    advisorHead: {
        backgroundColor: colors.ritThemeColor,
        height: 55,
        width: 222,
        justifyContent: 'center',
        alignItems: 'center',
        position: 'relative'
    },
    cross: {
        position: 'absolute',
        top: 40,
        left: -20,
        height: 40,
        width: 40,
        transform: [
            {
                rotate: '45deg'
            }
        ],
        backgroundColor: colors.white
    },
    StudentInfoContainer: {
        width: 1280,
        height: 100,
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
