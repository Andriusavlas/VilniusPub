# VilniusPub

The project is a web application used for rating pubs in Vilnius. However, with a few modifications it can be easily transformed to a rating application for any kind of venue.

The web application is built with Laravel 5.6 and Bootstrap 4. It also uses the Google Maps API. All of the information used in the website is stored in a MySQL database.

The index page shows Pubs in Vilnius with their location and upvote count. Only registered users can vote for the pubs and add comments.
Upon clicking the pub name in the index page the user is redirected to the "about" page of the selected pub with the following information:
1. Location of the pub on the map (Google Maps API);
2. Pub title;
3. A picture from the pub;
4. A short description;
5. User comments;
6. Comment field where users can leave their comments.

Any user can leave numerous comments about the specific pub, however only one upvote can be done per pub.

There are two types of users: Admin and ordinary users.
From the dashboard that is accessible by clicking on the username when logged in on the top right corner ordinary users can edit or delete their comments, while the Admin can do that and update the information of any Pub or completely delete it. 
Pubs can only be added by the Admin.
