
export default class Fetcher
{
    items = []
    result = ''

    constructor(url, element, method = 'get', param = '')
    {
        this.url = url
        this.element = element
        this.method = method
        this.param = param
    }

    render()
    {
        const xhr = new XMLHttpRequest()
        xhr.open(this.method, this.url, true)

        xhr.responseType = 'json'

        xhr.onerror = () =>{
            alert('There was an error loading documents from the server. Try again later.')
        }

        xhr.onload = () => {
            if(xhr.status === 200){

                let response = xhr.response

                if(response === null){
                    this.items = []
                    return
                }

                this.items = response
                this.resolve()
            }
        }

        if(this.method == 'post'){
            const param = this.param
            xhr.send(param)
        } else{
            xhr.send()
        }
    }


    resolve()
    {
        // implemented dependently in child classes
    }
}
