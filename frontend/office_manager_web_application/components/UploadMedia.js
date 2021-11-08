import React, { useEffect, useState } from "react";
import { Dimensions, StyleSheet, Text, View } from "react-native";
import { FilePond } from "react-filepond";
import "filepond/dist/filepond.min.css";
// import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
// import FilePondPluginImagePreview from "filepond-plugin-image-preview";
// import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";

// Register the plugins
// registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview);

export const UploadMedia = (props) => {
  const [files, setFiles] = useState([]);
  const [reload, setReload] = useState(false);
  useEffect(() => {
    document.getElementsByClassName("filepond--credits")[0].style.display =
      "none";
    setTimeout(() => {
      document.getElementsByClassName("filepond--drop-label")[0].style.height =
        "300px";
      document.getElementsByClassName("filepond--root")[0].style.height =
        "300px";
      setReload(true);
    }, 250);
  }, []);
  return (
    <View style={styles.topView}>
      <View style={styles.filePondContainer}>
        <FilePond
          files={files}
          onupdatefiles={setFiles}
          allowMultiple={true}
          maxFiles={2}
          server="https://cors-proxy.htmldriven.com/?url=https://filebin.net/tmmdx44aoc5ggv7l/newFile"
          name="files"
          labelIdle='Drag & Drop files or <span class="filepond--label-action">Browse</span>'
        />
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  topView: {
    flex: 1,
    marginTop: 150,
  },
  filePondContainer: {
    width: Dimensions.get("window").width / 2,
    alignSelf: "center",
  },
});
