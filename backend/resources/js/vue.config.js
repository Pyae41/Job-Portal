import constants from "./constants"

module.exports = {
    devServer: {
        proxy: constants.BASE_URL,
    }
}
