# Usage: `sh deploy-tesimwebsite.sh` or `sh deploy-tesimwebsite.sh no-git`
# run ❯ sh deploy-tesimwebsite.sh no-git
# and if you have this project in the /public root folder of WP,
# it will update the subfolder in the theme
# check /helpers/utils.js to ensure the base url is ok with the wp project.

if [ "$1" = "no-git" ]; then
  echo "just Building..."
  yarn build
else
  echo "Building the react app with GIT..."
  yarn build:tesimsite
fi

rm -rf ../wp-content/themes/understrap-child-master/inc/react-map
cp -R build ../wp-content/themes/understrap-child-master/inc/react-map

# rm -rf built-git
# mkdir built-git
# cd built-git
# git clone git@bitbucket.org:cobianzoltddreamteam/tesim-map-react-built.git .
# rm -rf *
# mv -f ../build/* ./
# git add --all
# git commit -m "built in a new folder"
# git push origin master


