import React, { useState, useEffect } from 'react';
import { View, StyleSheet, ImageBackground, Text, Dimensions } from 'react-native';


export default class Welcome extends React.Component {
    constructor(props) {
        super(props);
        this.state = {

        }
    }

    // onSwiped = () => {
    //     this.props.navigation.navigate("swiped_screen")
    // }

    componentDidMount() {
        this.startTimer();
    }

    startTimer = () => {
        setTimeout(() => {
            this.props.navigation.navigate("swiped_screen")
        }, 4000)
    }

    render() {
        return (
            <View style={styles.container}>
                <ImageBackground style={styles.image} source={require('../assets/Group85.png')}  >
                    <Text style={styles.headerText}>Welcome</Text>
                    <Text style={styles.bodyText}>Please Swipe Your ID</Text>
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
        // bottom: 100,
        // paddingLeft: 100,
        color: '#F76902',
        // fontSize: 80,
        // fontWeight: 'bold',
        // textAlign: 'left',
        // backgroundColor: '#000000a0',
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
        // bottom: 100,
        // paddingLeft: 100,
        // color: 'black',
        // fontSize: 70,
        // textAlign: 'left',
        // backgroundColor: '#000000a0',
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