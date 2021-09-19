import React from "react";
import {Button, View} from 'react-native';

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
        return(
            <View>
                <Button title="Select" onPress={this.onSelect} />
            </View>
        )
    }
}