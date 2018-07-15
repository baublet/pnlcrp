const config = require("./configuration.json"),
    nunjucks = require("nunjucks"),
    fs = require("fs"),
    path = require("path"),
    ncp = require("ncp");

for (let i = 0; i < config.directories.length; i++) {
    const baseDir = config.directories[i],
        projectConfig = require(path.resolve(
            baseDir,
            "configuration.json"
        )),
        combinedConfig = Object.assign({}, config, projectConfig),
        buildDir = path.resolve(baseDir, "build"),
        dataDir = path.resolve(baseDir, "data");

    // Build the HTML files
    fs.readdirSync(dataDir).forEach(file => {
        if (file.indexOf(".html") == -1 && file.indexOf(".htm") == -1) {
            return;
        }
        const filePath = path.resolve(dataDir, file);
        console.log(filePath)
        nunjucks.render(filePath, combinedConfig, function() {
            if(arguments[0]) {
                console.log(arguments[0])
                process.exit();
            }
            const filePath = path.resolve(buildDir, file)
            ensureDirectoryExistence(filePath)
            fs.writeFileSync(filePath, arguments[1])
        });
    });

    // Copy all of the assets to the build directory
    ncp(path.resolve(baseDir, "css"), path.resolve(buildDir, "css"));
}

function ensureDirectoryExistence(filePath) {
  const dirname = path.dirname(filePath);
  if (fs.existsSync(dirname)) {
    return true;
  }
  ensureDirectoryExistence(dirname);
  fs.mkdirSync(dirname);
}