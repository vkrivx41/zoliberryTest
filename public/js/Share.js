
const facebookButton = document.querySelector(".facebook_button")
const whatsappButton = document.querySelector(".whatsapp_button")
const twitterButton = document.querySelector(".twitter_button")

const init = () =>{
    const postUrl = encodeURI(document.location.href)
    const title = encodeURI("Hy check this post out: ")
    const image = encodeURI("/images/logo/logo.png")


    facebookButton.setAttribute(
        "href",
        `https://www.facebook.com/sharer.php?u=${postUrl}`
    )

    twitterButton.setAttribute(
        "href",
        `https://www.twitter.com/share?url=${postUrl}&text=${title}`
    )
}

init()


// 

const url = encodeURI(document.location.href)
const title = encodeURI("Hy check this post out: ")
const image = encodeURI("/images/logo/logo.png")

whatsappButton.addEventListener("click", async (e) =>{

    if (!navigator.canShare) {
        output = `Your browser doesn't support the Web Share API.`;
      }


    if (navigator.canShare) {
        try {
            await navigator.share({
                url: url,
                title: title,
                text: title,
            });

            output = "Shared!";
            
        } catch (error) {
            output.textContent = `Error: ${error.message}`;
        }
    } else {
        output = `Your system doesn't support sharing these files.`;
    }


    window.alert(output);
})