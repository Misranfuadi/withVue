import Axios from "axios"
import { mapGetters } from "vuex"
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
        },
        checkUserPermission(key) {
            if (!this.userPermission) return true
            let isPermitted = false
            for (let d of this.userPermission) {
                if (this.$route.name == d.name) {
                    if (d[key]) {
                        isPermitted = true
                        break;
                    } else {
                        break;
                    }
                }
            }
            return isPermitted
        }

    },
    computed: {
        ...mapGetters({
            'userPermission': 'getUserPermission'
        }),
        isRead() {
            return this.checkUserPermission('read')
        },
        isWrite() {
            return this.checkUserPermission('write')
        },
        isUpdate() {
            return this.checkUserPermission('update')
        },
        isDelete() {
            return this.checkUserPermission('delete')
        }

    },
}
