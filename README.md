# To update the site:  
1) update the app locally, buinding it inside the /inc folder.
    - we do so by using sh deploy-tesimwebsite.sh
2) upload the files, usign the WP file manager:
- all /inc folder 
- `page-templates/page-map-standalone.php` and `page-templates/page-virtual-tour-standalone.php`  (and created, but not made publish: `page-templates/homepage2021.php`)
- `single-project.php`


Screen del Village: 1920x1080px
When clicking on the play icon inside  1728x932px

# TEST in Tesim page Simulation  
- We downloaded the site using httrack, it is in `/Sites/httrack-3.49.2/tesim-enicbc.eu`
- /Sites/httrack-3.49.2/tesim-enicbc.eu , run apache in localhost:9000. 
    - the index.php calls the snippet-for-web.php, in this project.
    - the http://localhost is always pointing to /Sites, so the .env has to 
    - go to the folder 
    `/Sites/httrack-3.49.2/tesim-enicbc.eu/wp-content/themes/understrap-child-master/tesim-map-react-snippet/`  
    - `git pull` from the `https://bitbucket.org/cobianzoltddreamteam/tesim-map-react-built/src/master/` project
    - edit `tesim-map.php`, it has to call the right css and js from the built react.  
    - copy them from /build/index.html  

# DATA  
EXTERNAL DATA
---
- List of programmes and their projects: in a json with format at 
    - `projects-and-programmes.json`  . We get this one from 'interreg' project with a php fn called `get_all_eni_projects()`. We can also retrieve from API, but it's not tested live
    - .projects
    - .programmes
- List of nuts3 and their projects
- WE DONT USE THIS ONE BUT THE ENDPOINT WORKS: Info of a single project: given post ID, json from API interreg.eu, returning a post and acf fields Object.
- The images of poster are, at the moment, calculated by using the thumbnail that WP generates at tesim. But normally I should use an image


REPRESENTATION OF DATA IN REACT  
---  
List of Programmes: see App.js State  
List of Projects: see App.js State  
List of regions: Appjs state in 2 vars: 
                allRegionsInfo : info about the name of the region, given the code  
                regionsToProgrammes: given a region, returns programmes  associated. Calculated in run time.  
List of countries:  

# DEPLOY  
> sh deploy-build.sh  
Creates the built-git and pushes into `https://bitbucket.org/cobianzoltddreamteam/tesim-map-react-built/`. That is the definitive project which goes live.  
# The MAP IN SVG  
App.js > Map.js (all html) > SVGEurope.js , created from nuts3-eni.svg   
and `https://svg2jsx.com/`
we need to remove the <def> tag to make it parseable  
and remove the parent width=1000 height=600. It will be calculated according to the parent div size.

# Getting Started with Create React App

This project was bootstrapped with [Create React App](https://github.com/facebook/create-react-app).

## Available Scripts

In the project directory, you can run:

### `yarn start`

Runs the app in the development mode.\
Open [http://localhost:3000](http://localhost:3000) to view it in the browser.

The page will reload if you make edits.\
You will also see any lint errors in the console.

### `yarn test`

Launches the test runner in the interactive watch mode.\
See the section about [running tests](https://facebook.github.io/create-react-app/docs/running-tests) for more information.

### `yarn build`

Builds the app for production to the `build` folder.\
It correctly bundles React in production mode and optimizes the build for the best performance.

The build is minified and the filenames include the hashes.\
Your app is ready to be deployed!

See the section about [deployment](https://facebook.github.io/create-react-app/docs/deployment) for more information.

### `yarn eject`

**Note: this is a one-way operation. Once you `eject`, you can’t go back!**

If you aren’t satisfied with the build tool and configuration choices, you can `eject` at any time. This command will remove the single build dependency from your project.

Instead, it will copy all the configuration files and the transitive dependencies (webpack, Babel, ESLint, etc) right into your project so you have full control over them. All of the commands except `eject` will still work, but they will point to the copied scripts so you can tweak them. At this point you’re on your own.

You don’t have to ever use `eject`. The curated feature set is suitable for small and middle deployments, and you shouldn’t feel obligated to use this feature. However we understand that this tool wouldn’t be useful if you couldn’t customize it when you are ready for it.

## Learn More

You can learn more in the [Create React App documentation](https://facebook.github.io/create-react-app/docs/getting-started).

To learn React, check out the [React documentation](https://reactjs.org/).

### Code Splitting

This section has moved here: [https://facebook.github.io/create-react-app/docs/code-splitting](https://facebook.github.io/create-react-app/docs/code-splitting)

### Analyzing the Bundle Size

This section has moved here: [https://facebook.github.io/create-react-app/docs/analyzing-the-bundle-size](https://facebook.github.io/create-react-app/docs/analyzing-the-bundle-size)

### Making a Progressive Web App

This section has moved here: [https://facebook.github.io/create-react-app/docs/making-a-progressive-web-app](https://facebook.github.io/create-react-app/docs/making-a-progressive-web-app)

### Advanced Configuration

This section has moved here: [https://facebook.github.io/create-react-app/docs/advanced-configuration](https://facebook.github.io/create-react-app/docs/advanced-configuration)

### Deployment

This section has moved here: [https://facebook.github.io/create-react-app/docs/deployment](https://facebook.github.io/create-react-app/docs/deployment)

### `yarn build` fails to minify

This section has moved here: [https://facebook.github.io/create-react-app/docs/troubleshooting#npm-run-build-fails-to-minify](https://facebook.github.io/create-react-app/docs/troubleshooting#npm-run-build-fails-to-minify)
