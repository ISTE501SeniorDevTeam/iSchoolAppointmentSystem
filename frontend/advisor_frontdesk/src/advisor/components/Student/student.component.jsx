import "./student.styles.css"

export const Student = (props) => {
    
    return (
        <button
            onClick={() => props.onClick(props.student)}
            className={`StudentNameButtonContainer ${props.isActive ? "active" : ""}`}

        >
                {props.student.studentName}
        </button>
    )

}
