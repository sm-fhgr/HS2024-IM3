//Javascript file for the project

// Fetching and displaying data from the database as JSON for Bitcoin Price Chart

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
                    backgroundColor: '#F2541B', // Background color with --PageElements color
                    borderColor: '#1E1A44', // Line color with --Background color
          pointBackgroundColor: '#F2541B', // --Pageelements color for point background color
          pointRadius: 2.5, // Set point radius for visibility
          pointBorderWidth: 0.5, // Optional: Add a border around the point
          pointBorderColor: '#1E1A44', // Optional: Color for the point border
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'hour'
                        },
                        title: {
                            display: true,
                            text: 'Last 36 hours'
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


// Fetching data from the API


//Fetching news data from the database as JSON and displaying it in the news-feed section

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

// Fetching news data from the API and displaying it in the news-feed section