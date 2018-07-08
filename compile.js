const config = require("./configuration.json"),
    nunjucks = require("nunjucks"),
    fs = require("fs"),
    path = require("path");

for (let i = 0; i < config.directories.length; i++) {
    const projectConfig = require(path.resolve(
            config.directories[i],
            "configuration.json"
        )),
        combinedConfig = Object.assign({}, config, projectConfig);

    fs.readdirSync(config.directories[i]).forEach(file => {
        if (file.indexOf(".html") == -1) {
            return;
        }
        const filePath = path.resolve(config.directories[i], file);
        console.log(filePath);
        console.log(combinedConfig);
        nunjucks.render(filePath, combinedConfig, function() {
            console.log(arguments);
        });
    });
}
