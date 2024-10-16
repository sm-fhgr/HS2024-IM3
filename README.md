# HS2024 IM3
 Repo for IM3 HS2024


THE IDEA:

The core idea of the project was to visualize data related to Bitcoin. The concept was to help the visitor identify and analyse the relationship between the market sentiment (news) and the price of Bitcoin. Akin to Stock Trading, sentiment also plays a role in determining the price of Bitcoin (https://www.sciencedirect.com/science/article/abs/pii/S0264999323002092)



WHAT WAS PLANNED:

The plan was to have multiple reference currencies like the Euro, Swiss Franc etc. but since the coinranking API only provides the price in 1 reference currency and allows 5000 free calls per month, the USD was chosen as the only reference currency.

With news, it was planned that there would be a functionality to click on a news item and have the ability to see the same timestamp on the Price Chart. This idea was also dropped because the AlphaVantage API has a delay of 3-4 hours with the news. Additionally, giving this functionality could also make visitors believe that there is an implicit causation relationship when there may or may not be one. In order to not bias the info, this idea was dropped too.



WHAT ACTUALLY HAPPENED:

The website provides the visitor a way to read curated News about Bitcoin and look at the price graph of Bitcoin for the last 36 hours.

The news items contain a sentiment label, and also contains the link to goto the actual article. This approach helps us to avoid giving any judgement explicitly (other than the sentiment, which is also from the API) and trust the visitor's capabilities in deducing and anlysing the effect for themselves.

The website is not for dummies, it is for people who actually have an interst in finding things out for themselves rather than imbibing predigested opinions from others.



THE CHALLENGES:

The biggest challenge I had to overcome was selecting the relevant data from the API response through PHP arrays. Once I understood how arrays work in PHP and how to address them with indexes, it was okay. The other challenge was to understand how to use PHP to write data into the database. Once that was understood, the project was mostly done.

Otherwise, the project was relatively easy to follow through with the inputs and spotaneous coachings.



RESOURCES UTILIZED:

Class inputs, youtube videos, Copilot.