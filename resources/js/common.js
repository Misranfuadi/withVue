import Axios from "axios"

export default {
    data() {
        return {

        }
    },
    methods: {
        async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj
                })

            } catch (error) {
                return error.response
            }
        },

        info(desc) {
            this.$Notice.info({
                title: 'Hey',
                desc: desc ? desc : 'Here is the notification description.'
            });
        },
        success(desc) {
            this.$Notice.success({
                title: 'Great!',
                desc: desc ? desc : 'Here is the notification description.'
            });
        },
        warning(desc) {
            this.$Notice.warning({
                title: 'Oops!',
                desc: desc ? desc : 'Here is the notification description.'
            });
        },
        error(desc) {
            this.$Notice.error({
                title: 'Oops!',
                desc: desc ? desc : 'Here is the notification description.'
            });
        },
        wrong(desc) {
            this.$Notice.error({
                title: 'Oops!',
                desc: desc ? desc : 'Somthing went wrong! Please try again.'
            });
        }

    },
}
