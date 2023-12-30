
class ThemeToggler
{
    #DEFAULT_THEME = "white";

    constructor(input)
    {
        this.input = input
    }

    getTheme(change=false)
    {

        const request = new XMLHttpRequest()

        request.open("get", "/User/Theme/Get", true);

        request.onerror = () =>{
            alert("An error occurred getting your theme, try again later");
        }

        request.onload = () =>{
            let user_theme = request.response


            user_theme = [... user_theme].reverse().slice(0, 5).reverse().join("")
            
            if (change === false){
                if (user_theme === "white"){
                    theme.setLightTheme()
                    theme.saveThemeOption("white")
                } else {
                    theme.setDarkTheme()
                    theme.saveThemeOption("black")
                }
            } else{

                if (user_theme === "white"){
                    theme.setDarkTheme()
                    theme.saveThemeOption("black")
                } else {
                    theme.setLightTheme()
                    theme.saveThemeOption("white")
                }
            }
        }

        request.send()
    }
    

    setDarkTheme()
    {
        document.documentElement.style.setProperty('--nav-bg-color', 'black')
        document.documentElement.style.setProperty('--nav-text-color', 'white')
    }

    setLightTheme()
    {

        document.documentElement.style.setProperty('--nav-bg-color', 'white')
        document.documentElement.style.setProperty('--nav-text-color', 'black')
    }


    saveThemeOption(theme)
    {
        const request = new XMLHttpRequest()

        request.open("post", "/User/Theme", true);
        const param = `theme=${theme}`

        request.onerror = () =>{
            alert("An error occurred saving your theme, try again later");
        }

        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")

        request.onload = () =>{
            if(request.status === 200){
                // resolve
            }

            if (request.status === 404){
                alert("An error occurred saving your theme, try again later");
            }
        }

        request.send(param)
    }


    createUser()
    {
        const request = new XMLHttpRequest()

        request.open("post", "/User/Create", true);

        request.onerror = () =>{
            alert("An error occurred saving your theme, try again later");
        }

        request.onload = () =>{
            if(request.status === 200){
                // resolve
            }
            if (request.status === 404){
                alert("An error occurred saving your theme, try again later");
            }
        }

        request.send()
    }
}


const inputCheckbox = document.querySelector("input[type='checkbox']")


const theme = new ThemeToggler(inputCheckbox)


inputCheckbox.addEventListener("change", () =>{
    theme.getTheme(true)
})


addEventListener('DOMContentLoaded', () =>{
    theme.createUser()
    theme.getTheme()
})

