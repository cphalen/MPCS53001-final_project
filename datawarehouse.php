<?php

include "navigation.php";

?>

<div class="container">
    <br>
    <div class="jumbotron">
        <h2> Data Warehousing for Star Trek DB Site </h2>
        <br>
        <p>
            The site has two main functional components: The set of all show data that relates to the show (this would be character, episodes, seasons, and series information), and the set of all data that describes the production of any given episode (this is the writers, directors, and actors information). Hence, we have the two overarching categories of show data and production data.
        </p>
        <p>
            To analyze the change in show data over an elongated period of time yields information about which sections of the show users are interested in at any given point in time. For example, to see spike in data about The Animated Series on the database means that some group users must have become newly interested in The Animated Series. Thus, examining how new data is inserted as well as how old data is updated demonstrates something about populate interest in certain subsections of the show. The data warehouse itself that would encapsulate this idea might combine all four schemas into a set of single tuples in which every episode as all of its season, series, and character data is matched in a single tuple (This tuple would be equivalent to those selected with the SQL statement `SELECT * FROM Episode INNER JOIN AppearsIn USING (EpisodeID INNER JOIN Role USING (RoleID) INNER JOIN Season USING (SeasonID) INNER JOIN Series USING (SeriesTitle)`). Along with this information we would save a timestamp so that we can analyze the data over time. From this data we can extrapolate behavior of the our users and their specific interest in the show at any given time.
        </p>
        <p>
            For the set of production data we shift focus from the show itself and we can instead examine the actual film industry teams. This information is slightly more applicable in the film industry to make extrapolations about the production associates. For example, if we can save information about certain directors who are being tracked by users in the database, we gain insight about which directors are more apparent in the public eye. Although there are quite a few Star Trek directors who have left the industry, for newer series of Star Trek (and perhaps series that have yet to be released!) we would be able to examine how knowledgable the user base is about certain directors. This sentiments holds across the three fields, so being able to track all of the production roles would be applicable. In the data warehouse we would save and timestamp all of the changes to every production role and their relations to corresponding episodes (this query we be equivalent to the SQL statement `SELECT * FROM Actor INNER JOIN ActsIn USING (ActorID INNER JOIN Episode USING (EpisodeID)` where we would be able to interchange  `Actor` with either `Writer` or `Director`). From this data we could look at trends in any production role over time and examine the focus of users on specific members of the film industry members.
        </p>
        <p>
            Both of these examples of data warehousing yield information about the users, this is because the idea here is that the database is maintained by the users. If the data modeled exactly all information about the Star Trek show, then analysis could lead to other predictions. Nonetheless, in this scenario it seems almost more interesting to examine user behavior, as the shift in information about Star Trek might not follow too many discernible patterns.
        </p>
    </div>
</div>
