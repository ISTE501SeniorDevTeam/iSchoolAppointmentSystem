import React from "react";
import {View} from 'react-native';

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
        return(
            <View>
            </View>
        )
    }
}