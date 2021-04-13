rm -rf built-git
npm run build
mkdir built-git
cd built-git
git clone git@bitbucket.org:cobianzoltddreamteam/tesim-map-react.git .
rm -rf *
mv -f ../build/* ./
git add --all
git commit -m "built in a new folder"
git push origin master
cd ..