import Fetcher from "./Fetcher.js"


class TopStoriesFetcher extends Fetcher
{
    counter = 0

    showOrNoShow(index)
    {
        if(index === 0) return 'show'
        return 'noshow'
    }

    slide()
    {
        const stories = Array.from(document.querySelectorAll(".top-story"))

        this.reset(stories);

        
        stories[this.counter].style.display = 'flex'

        setInterval(() => {
            this.counter++

            if(this.counter > stories.length - 1){
                this.counter = 0
            }

            if(this.counter < 0){
                this.counter = stories.length - 1
            }


            this.reset(stories)
            stories[this.counter].style.display = 'flex'
        }, 3000);

    }

    reset(stories = [])
    {
        stories.forEach(story => {
            story.style.display = 'none'
        });
    }
}


const element = document.querySelector(".stories-slider")

const topStoriesFetcher = new TopStoriesFetcher('/json/topstories.json', element)

topStoriesFetcher.slide()
