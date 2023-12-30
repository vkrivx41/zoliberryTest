import Fetcher from "./Fetcher.js"


class HomeStoriesFetcher extends Fetcher
{
    resolve()
    {

        this.items.forEach(element => {
            this.result += `
            <div class="story" href="/link">
                <a href="/Views/link">
                    <div class="wrapper"></div>
                </a>
                <div class="image">
                    <a class="image-link">
                        <img src="${element.image}" alt="No image available.">
                    </a>
                </div>
                <div class="title">
                    <a class="title-link" href="/Views/link">${element.title}</a>
                </div>
              <div class='description'>
                    <div class="tag">
                        <a href="/News">${element.tag}</a>
                    </div>
                    <div class="author">
                        <a href="authors?name=${element.author}">${element.author}</a>
                    </div>
              </div>
                <div class="date">
                    <span class="fa fa-date">O</span>
                    <span class="date-element">${element.date ?? "18/8/2023"}</span>
                </div>
            </div>`

            this.element.innerHTML = this.result
        })

    }
}


const element = document.querySelector(".stories-grid")

const homeStoriesFetcher = new HomeStoriesFetcher('/json/four_stories.json', element)

homeStoriesFetcher.render()
