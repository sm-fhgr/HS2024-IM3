// Javascript file to make a line chart using Chart.js in the canvas element with id 'priceChart'. The data for the chart is fetched from "https://im3.saurabhmishra.ch/etl/unloadPrice.php" as json data. The data is then processed to get the required data for the chart. The chart is then created using Chart.js.

// Fetching data from the API

fetch('https://im3.saurabhmishra.ch/etl/unloadPrice.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        let prices = [];
        let timestamps = [];
        
        data.forEach(element => {
            timestamps.push(element['timestamp']);
            prices.push(element['price']);
        });
        
        console.log(timestamps);
        console.log(prices);
        
        // Creating a line chart using Chart.js
        var ctx = document.getElementById('priceChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: timestamps,
                datasets: [{
                    label: 'Price of Bitcoin',
                    data: prices,
                    backgroundColor: 'rgba(255, 0, 0, 0.1)',
                    borderColor: '#007bff',
                    borderWidth: 1,
                    pointRadius: 0 // Hide individual data points
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        },
                        title: {
                            display: true,
                            text: 'Last 12 hours - Right side is latest price'
                        }
                    },
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Price (USD)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });
    });


// javascript code to create the news feed in the div with id 'news-feed'. The data for the news feed is fetched from "https://im3.saurabhmishra.ch/etl/unloadNews.php" as json data. The data is then processed to get the required data for the news feed. The news feed is fetched from "https://im3.saurabhmishra.ch/etl/unloadNews.php" as json data. The data is then processed to get the required data for the news feed. The news feed is then created using the data.

// Fetching data from the API

fetch('https://im3.saurabhmishra.ch/etl/unloadNews.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        let newsFeed = document.getElementById('news-feed');
        let i = 0;
        data.forEach(element => {
            let newsItem = document.createElement('div');
            newsItem.innerHTML = `
                <div class="news-item">
                    <h5>${element['title']}</h5>
                    <p>Published: ${element['time_published']}</p>
                    <p>Source: ${element['source']}</p>
                    <p>Sentiment:<h4>${element['overall_sentiment_label']}</h4></p>
                    <a href="${element['url']}" target="_blank">Read More</a>
                </div>
            `;
            newsFeed.appendChild(newsItem);
            i++;
            if (i == 5) {
                return;
            }
        });
    });



