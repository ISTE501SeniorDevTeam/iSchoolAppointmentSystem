import React from "react";
import {Button, View } from 'react-native';

export default class Welcome extends React.Component {
    constructor(props) {
        super(props);
        this.state = {

        }
    }

    onSwiped = () => {
        this.props.navigation.navigate("swiped_screen")
    }

    render() {
        return(
            <View>
                <Button onPress={this.onSwiped} title="Swipe card" />
            </View>
        )
    }
}