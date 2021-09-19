import React from "react";
import {FlatList, View} from 'react-native';

let reasons = [
    "Next Semester Planning",
    "Update Worksheet",
    "Problems with Registration",
    "Leave Of Absence/Institute Withdrawal",
    "Change Of Program – out",
    "Course Withdrawal",
    "Waitlist",
    " Faculty/Grade Concern",
    "Received an Early Alert",
    "Transfer Credit/AP",
    "Request for Resource Info",
    "Minor/Concentration Selection",
    "Graduation Questions",
    "Personal Issue",
    "Other"
]
export default class Reasons extends React.Component {
    constructor(props) {
        super(props);
        this.state = {

        }
        this.getData();
    }

    getData = () => {
    axios
      .get(util.api_url + "/user/wp/" + this.props.user.id, {
        headers: {
          api_key: util.api_key,
        },
      })
      .then((res) => {
        this.setState({
          workPackages: res.data,
        });
        this.goToURL();
      })
      .catch((res) => {
        this.goToURL();
      });
    }

    render() {
        return(
            <View>
                <FlatList
                    data={reasons}
                    renderItem={({item}) => {
                        
                    }}
                />
            </View>
        )
    }
}