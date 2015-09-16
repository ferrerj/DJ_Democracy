# DJ_Democracy
Music Voting App that allows voting for music from a local database from a computer or phone native or web app to be played through a device connected to speakers.

I worked on this as a side project for a bit over a year. It started as something I wanted to make for myself but never brought it to fruition (at any level) until I took my first Databasing class (which was slower and required pages to load everytime). After that class, I continued work on it to make it a single page webapp and more optimized towards mobile using JS, CSS3 animations (for iPhone at least Android webkit did not produce optimal effects), Images generated by canvas drawn to the screen size and stored for performance, AJAX, and JSON run by a revamped PHP backend. I also used it in my Software Methodology class as the basis for an Android app (to be included in a seperate repo).

Main idea is to provide party guests the ability to try to get music to play at a party, prioritizing songs people want to hear most. After logging into the app (to prevent people upvoting songs without limit), users are presented with the options to Veiw music by Artist, Search for songs by either song title or artist name, or View the Chart (which also allows upvoting from this view) as well as a menu button on the top which presents songs recently voted for by other users. 

Its use is pretty simple - throughout the app, by clicking on an Element with an artist's name the user is presented with the songs by the user and by clicking on a song the user will vote for that song (even in the menu).

FOR SET UP:

REQUIRES LAMP (XAMPP also works)

Requires some set up, database structure not yet included.
Music should be stored in ./music by artist (you can use something like Winamp or Itunes to do this easily)
Music needs to be scanned using the admin console to be added to the database.

FUTURE PLANS:

I recently took a class on Data Science, I plan to add things such as internal rating systems to allow the machine to view voting records of users and randomly play songs based on the internal rating by the users currently logged in similar to pandora, but flexible and based on the collective group of people logged in.

I am working on a desktop client based on the Go-Lang based Thrust browser, however I am still learning the language and API's behind it.

Lastly with regards to an iPhone app, I do not yet own a Mac so I cannot produce an iPhone app yet.