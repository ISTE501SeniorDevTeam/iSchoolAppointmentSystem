import React from "react";
import { View, StyleSheet, ImageBackground, Text, Dimensions } from 'react-native';

export default class SwipedScreen extends React.Component {
    constructor(props) {
        super(props);
        this.state = {

        }
    }

    componentDidMount() {
        this.startTimer();
    }

    startTimer = () => {
        setTimeout(() => {
            this.props.navigation.navigate("availability")
        }, 4000)
    }

    render() {
        return (
            <View style={styles.container}>
                <ImageBackground style={styles.image} source={require('../assets/Group85.png')}  >
                    <Text style={styles.headerText}>Hello</Text>
                    <Text style={styles.bodyText}>John Doe</Text>
                </ImageBackground>
            </View>
        )
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#fff',
    },
    image: {
        flex: 1,
        resizeMode: 'cover',
        justifyContent: 'center',
        width: Dimensions.get('window').width

    },
    headerText: {

        color: '#F76902',
        position: 'absolute',
        width: 329,
        height: 86,
        left: 95,
        top: 151,
        fontFamily: 'Helvetica',
        fontStyle: 'normal',
        fontWeight: 'bold',
        fontSize: 75,
        lineHeight: 86,
    },
    bodyText: {
        position: 'absolute',
        width: 349,
        height: 126,
        left: 95,
        top: 271,

        fontFamily: 'Helvetica',
        fontStyle: 'normal',
        fontWeight: 'normal',
        fontSize: 55,
        lineHeight: 63,

        /* Text/Default */
        color: '#212519',
    },

});