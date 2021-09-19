import React from "react";
import { View, StyleSheet, ImageBackground, Text, Dimensions, Image } from 'react-native';

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
                <View style={styles.ritHeader}>
                    <Image style={styles.ritHeaderImage} source={require('../assets/RIT.jpg')}  >
                    </Image>
                </View>
                <View style={styles.appointmentSection} />
                <View style={styles.availabilitySection} />
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
    ritHeader: {
        flex: 1,
        width: 2160,
        height: 100,
        backgroundColor: "red",
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
        flexGrow: 2,
        backgroundColor: "gold",
    },
    availabilitySection: {
        flex: 1,
        width: 2160,
        height: 100,
        flexGrow: 3,
        backgroundColor: "green",
    },

});
