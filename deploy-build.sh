# This scripts build the project and move it to a
# folder to make push into the `master` branch of
# git@bitbucket.org:cobianzoltddreamteam/tesim-map-react-built.git
rm -rf built-git
yarn build
mkdir built-git
cd built-git
git clone git@bitbucket.org:cobianzoltddreamteam/tesim-map-react-built.git .
git checkout master
rm -rf *
mv -f ../build/* ./
git add --all
git commit -m "built in a new folder"
git push origin master
cd ..