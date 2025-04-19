#!/bin/bash

# Navigate to the script's directory
cd "$(dirname "$0")"

# Exit immediately if a command exits with a non-zero status
set -e

npm run build

# Define a variable with the directory one folder below and inside wp-content
WP_CONTENT_DIR="../wp-content/themes/understrap-child-master/inc/react-map/"

echo "DESTINATION WP DIR is set to: $PWD ... Deleting current content and recreating empty folder"
rm -rf $WP_CONTENT_DIR
mkdir $WP_CONTENT_DIR

echo "Copying /build folder into $WP_CONTENT_DIR"
mv -f ./build/* $WP_CONTENT_DIR
