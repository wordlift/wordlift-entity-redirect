const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require("path");

module.exports = {
	...defaultConfig,
	entry: {
		public: path.resolve(process.cwd(), "src/public/", "index.js"),
		admin: path.resolve(process.cwd(), "src/admin/", "index.js"),
	},
};
