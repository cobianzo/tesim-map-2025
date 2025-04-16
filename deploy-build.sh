# the repo git@bitbucket.org:cobianzoltddreamteam/tesim-map-react-built.git
# Is different than the real one: git@bitbucket.org:cobianzoltddreamteam/tesim-map-react.git (branch `main`)
# Here we build and save the new build files into the repo tesim-map-react-built.git,
# branch `master`

This scripts builds the project and move it to a
# folder to make push into the `master` branch of
#
rm -rf built-git
yarn build
mkdir built-git
cd built-git
git clone git@bitbucket.org:cobianzoltddreamteam/tesim-map-react-built.git .
git checkout master
# Now we delete all content that we cloned from the repo and replaced by the new one
rm -rf *
mv -f ../build/* ./
git add --all
git commit -m "built in a new folder"
git push origin master
cd ..