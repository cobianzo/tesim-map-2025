npm run build:tesimsite
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


