

export default class Controller
{
    constructor(route) {
        this.route = route
    }

    delete(element, method)
    {

        let id = null

        addEventListener("click", (e) => {
            const tar = e.target.closest(element)

            if (! tar) return

            id = tar.dataset.id

            const password = window.prompt("Enter your password to proceed")

            const xhr = new XMLHttpRequest();

            xhr.open(method, this.route, true)
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
            // xhr.responseType = 'json'

            xhr.onerror = () =>{
                alert('An error occurred try again later.')
            }

            xhr.onload = () => {
                if (xhr.status === 200){
                    this.resolve(xhr.response)
                } else{
                    alert('Not done!')
                }
            }

            const param = `id=${id}&password=${password}`

            xhr.send(param)

            return true
        })




    }

    resolve(response) {

        switch (response){
            case 'Passed':
                alert('Operation success.')
                location.reload()
                break
            case "Failed":
                alert('An error occurred deleting, try again later.')
                location.reload()
                break
            case "Password":
                alert('The password you entered is incorrect.')
                location.reload()
                break
            case "Profile":
                alert('The profile image was not deleted.')
                location.reload()
                break
            default:
                alert('An error occurred deleting, try again later.')
                break
        }
    }
}