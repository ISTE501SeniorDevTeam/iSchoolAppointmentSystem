import React, { Component } from "react";
import { View, StyleSheet, ImageBackground, Text, Dimensions, Image } from 'react-native';
import CompleteAvailableAdvisorWithSelect from "../components/AvailabilityScreen/CompleteAvailableAdvisorWithSelect";


export default class Availability extends React.Component {
    constructor(props) {
        super(props);
        this.state = {

        }
    }

    onSelect = () => {
        this.props.navigation.navigate("reasons")
    }

    render() {
        return (
            <View style={styles.container}>
                <ImageBackground style={styles.backgroundImage} source={require('../assets/Group86.png')}>
                    <View style={styles.ritHeader}>
                        <Image style={styles.ritHeaderImage} source={require('../assets/RIT.jpg')}  >
                        </Image>
                    </View>
                    <View style={styles.appointmentSection}>
                        <Text style={styles.appointmentHeader}>Appointments</Text>
                        <Image style={styles.appointmentRectangle} source={require('../assets/rectangle9.png')}  >
                        </Image>
                        <Text style={styles.appointmentText}>
                            No upcoming appointments
                        </Text>
                    </View>
                    <View style={styles.availabilitySection}>
                        <Text style={styles.availabilityHeader}>Walk In Availability</Text>
                        <Image style={styles.appointmentRectangle} source={require('../assets/rectangle9.png')}  >
                        </Image>
                        <View style={styles.availabilityBody}>
                            <CompleteAvailableAdvisorWithSelect style={styles.advisorProfile}></CompleteAvailableAdvisorWithSelect>
                        </View>
                        <View style={styles.availabilityBody}>
                            <CompleteAvailableAdvisorWithSelect style={styles.advisorProfile}></CompleteAvailableAdvisorWithSelect>
                        </View>
                    </View>
                </ImageBackground>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#fff',
        width: 2160,
        height: 1620,
    },
    backgroundImage: {
        flex: 1,
        resizeMode: 'cover',
        justifyContent: 'center',
        width: Dimensions.get('window').width

    },
    ritHeader: {
        flex: 1,
        width: 2160,
        height: 100,
        // backgroundColor: "red",
    },
    ritHeaderImage: {
        position: "absolute",
        width: 278,
        height: 49.37,
        left: 37,
        top: 34,
    },
    appointmentSection: {
        flex: 1,
        width: 2160,
        height: 100,
        flexGrow: 1,
        // backgroundColor: "gold",
    },
    appointmentHeader: {
        position: "absolute",
        width: 236,
        height: 44,
        left: 42,

        fontFamily: "Helvetica",
        fontStyle: "normal",
        fontWeight: "300",
        fontSize: 38,
        lineHeight: 44,
        /* identical to box height */


        /* Text/Default */

        color: "#212519",

    },

    appointmentRectangle: {
        position: "absolute",
        width: 70,
        height: 3,
        left: 42,
        top: 50,

        /* Text/Default */

        backgroundColor: "#212519",
    },

    appointmentText: {
        position: "absolute",
        width: 195,
        height: 18,
        left: 42,
        top: 70,

        fontFamily: "Helvetica",
        fontStyle: "normal",
        fontWeight: "normal",
        fontSize: 16,
        lineHeight: 18,

        color: "#000000",
    },

    availabilitySection: {
        flex: 1,
        width: 2160,
        height: 100,
        flexGrow: 3,
        // backgroundColor: "green",
    },

    availabilityHeader: {
        position: "absolute",
        width: 313,
        height: 44,
        left: 42,

        fontFamily: "Helvetica",
        fontStyle: "normal",
        fontWeight: "300",
        fontSize: 38,
        lineHeight: 44,
        /* identical to box height */


        /* Text/Default */

        color: "#212519",

    },

    availabilityBody: {
        position: "relative",
        width: 940,
        height: 150,
        left: 42,
        top: 70,
        marginBottom: 50,


    }

});
