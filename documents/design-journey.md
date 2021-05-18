# Project 2: Design Journey

Be clear and concise in your writing. Bullets points are encouraged.

**Everything, including images, must be visible in Markdown Preview.** If it's not visible in Markdown Preview, then we won't grade it. We won't give you partial credit either. This is your warning.

## Design Plan

### Describe your Catalog (Milestone 1)
> What will your collection be about?
> What types of attributes will you keep track of for the *things* in your catalog? 1-2 sentences.

My collection will store NFL Combine data for each player. The site will include background information such as Name and College, physical data, such as height and weight, and test data, such as 40 yard dash time, board jump, etc. A good reference would be something like the [Baseball Savant Leaderboards](https://baseballsavant.mlb.com/leaderboard/custom?year=2020&type=batter&filter=&sort=4&sortDir=desc&min=50&selections=xba,xslg,xwoba,xobp,xiso,exit_velocity_avg,launch_angle_avg,barrel_batted_rate,&chart=false&x=xba&y=xba&r=no&chartType=beeswarm)


### Audiences (Milestone 1)
> Briefly explain your site's audiences. Be specific and justify why each audience is appropriate for your site.
> You are required to have **two** audiences. One to view the catalog. The other inserts records into the catalog.

Viewer: Football fan/researcher. The content of this site is fairly niche, and its primary function to help interested viewers navigate to relevant data.

Inserts New Records: Either paid or volunteer database managers. The managers of this site are given special permissions to write data, and need to be able to edit existing fields to ensure accuracy and create new fields to update/populate records.


### Personas (Milestone 1)
> Your personas must have a name and a "depiction". This can be a photo of a face or a drawing, etc.
> There is no required format for the persona.
> You may type out the persona below with bullet points or include an image of the persona. Just make sure it's easy to read the persona when previewing markdown.
> Your personas should focus on the goals, obstacles, and factors that influence behavior of each audience.

> Persona for your "viewer" audience

Kyle is a 24 year old football fan. He played some football in high school, but wasn't good enough to play past that. Regardless, he's still an avid fan and is curious about historical combine data to see how his favorite players tested. He's actively seeking out data about his favorite team, and can be considered a more hardcore fan. As a 24 year old male, Kyle possesses a reasonable level of technological capability, but is not an avid coder.

Motivations/Wants
Efficient access to the data he is interested in. Clean, non-distracting design. Something a little more user-friendly than typical database sites of this sort, such as [Baseball Reference](https://www.baseball-reference.com/teams/NYY/new-york-yankees-organization-batting.shtml)

Limitations/Obstacles
On consumer internet plans and devices, searches and requests over large databases need to load quickly. Kyle normally uses a desktop, but would use the site on his phone if possible.

> Persona for your "inserts new records" audience:

Dave is a 54 year old retired lawyer who volunteers for the site, keeping records accurate and adding new information. He didn't grow up with technology, but loves to follow his favorite college players as they turn pro. He watches each year's draft like a hawk.

Motivations/Wants
Easily input new records and alter existing. Clean, intuitive design that doesn't confuse him. Allows him to volunteer his time efficiently and yields a sense of satisfaction/reward.

Limitations/Obstacles
No coding knowledge or computer science background. Large text boxes and buttons help his hands, as accurate clicking can be annoying to him.

### Site Design (Milestone 1)
> Document your _entire_ design process. **We want to see iteration!**
> Show us the evolution of your design from your first idea (sketch) to the final design you plan to implement (sketch).
> Show us the process you used to organize content and plan the navigation, if applicable (card sorting).
> Plan your URLs for the site.
> Provide a brief explanation _underneath_ each design artifact. Explain what the artifact is, how it meets the goals of your personas (**refer to your personas by name**).
> Clearly label the final design.

#### Initial Sketch

![initial sketch](/public/images/initial-design.png)

#### Final Sketch

![Final sketch](/public/images/home-final-design.png)
#### Sidebar Changes
![Sidebar Update](/public/images/sidebar-update.png)
#### CSS Layout
![CSS Flexbox Layout](/public/images/flexbox-layout.png)

URLS
- /index: '/', '/index', '/home', /'statistics','/stats'
- /about: '/about'
- /robots.txt: '/robots.txt','/robots','/scraping'
- /help'/how-to','/help'

Need to work out database editing UX. Large buttons benefit Dave. Clean design benefits both. Help page benefits new users. Column highlighting adds visibility, team labels visual spunk.
### Design Patterns (Milestone 1)
> Write a one paragraph reflection explaining how you used the design patterns for online catalogs in your site's design.

In creating the design of this catalog, I used design patterns to generate visual clarity, ease of use, and visual excitement. I attempted to maximize whitespace, create clear visual hierarchy, and employ universal column alignment. I also took inspiration from sources such as the Pokemon Dex, which utilizes color-coded blocks to display information. Given the no images requirement, I think using team 'labels' adds visual excitement to the table. I lifted the column highlighting from Baseball Savant. These patterns provide value to all personas, easing strain on the eyes and yielding visual clarity.

## Implementation Plan

### Database Schema (Milestone 1)
> Describe the structure of your database. You may use words or a picture. A bulleted list is probably the simplest way to do this. Make sure you include constraints for each field.


Table: performances
- id: INT {NN, U},
- year: INT {NN},
- first_name: TEXT {},
- last_name: TEXT {},
- college: TEXT {NN},
- position: TEXT {NN},
- forty_yard_time: REAL {},
- wonderlic: INT {},
- bench_reps: INT {},
- vertical_jump: REAL {},
- broad_jump: REAL {},
- shuttle_time: REAL {},
- three_cone_time: REAL {},
- draft_position: INT {NN}, (0 if undrafted)
- draft_team: TEXT {NN}, (none if undrafted)


can add more tables, for instance a teams table to use foreign key team_id. Same can be done for colleges.
### Database Query Plan (Milestone 1)
> Plan your database queries. You may use natural language, pseudocode, or SQL.

1. All records

    ```
    SELECT * FROM performances
    ```

2. Insert record

    ```
    INSERT INTO performances VALUES (...)
    ```

3. Search records

    ```
    SELECT * FROM performances WHERE (first_name = $first_name AND last_name = $last_name)
    ```
    need to add security measures

4. Sorting records

    ```
    SELECT * FROM performances ORDER BY forty_yard_time
    ```

5. Filtering records

    ```
    SELECT * FROM performances WHERE (bench_reps > 10)
    ```

### Code Planning (Milestone 2)
> Plan any PHP code you'll need here using pseudocode.
> Use this space to plan out your form validation and assembling the SQL queries, etc.

```
// open connection to database
include_once("includes/db.php");
$db = open_sqlite_db("db/combine-database.sqlite");
?>

<?php
// query the database for records
$records = exec_sql_query(
$db,
"SELECT * FROM results;"
)->fetchAll();

tr
foreach ($records as $record) { ?>
td
`<td class="text-align-right"><?php echo htmlspecialchars($record["vertical_jump"]); ?></td>
```


## Submission

### Audience (Final Submission)
> Tell us how your final site meets the needs of the audiences. Be specific here. Tell us how you tailored your design, content, etc. to make your website usable for your personas. Refer to the personas by name.

Kyle will enjoy the clean design and sorting/filtering features. The rank feature in the table will also be useful for quickly checking where his favorite player's stand.

Dave can quickly insert a new player into the database, and have the site staff confirm and fill in the rest of the details, allowing him to quickly make sure his favorite site is up to date.

### Additional Design Justifications (Final Submission)
> If you feel like you haven’t fully explained your design choices in the final submission, or you want to explain some functions in your site (e.g., if you feel like you make a special design choice which might not meet the final requirement), you can use the additional design justifications to justify your design choices. Remember, this is place for you to justify your design choices which you haven’t covered in the design journey. You don’t need to fill out this section if you think all design choices have been well explained in the design journey.

### Self-Reflection (Final Submission)
> Reflect on what you learned during this assignment. How have you improved from Project 1? What things did you have trouble with?

Still having difficulty working linearly on these assignments. get sidetracked with unimportant details (spent 2hrs researching and making sort arrows only to decide against using them) and

Didn't get to make it as fancy as I wanted on part of other time constraints. Site is somewhat hard-coded  (filtering is Ivy-Exclusive atm). Trying to get employed and survive 23 credits takes a fair bit of time, but definitely getting better at managing these rather lengthy projects. Getting much faster at building up CSS/HTML, having to relearn for p1 took way too much time.

Overall feel like I am learning a lot. Projects are a great way to get to know this material, and they are enjoyable to complete. Looking forward to future improvement and getting to use these skills.

### Grading: Mobile or Desktop (Final Submission)
> When we grade your final site, should we grade this with a mobile screen size or a desktop screen size?

Desktop

### Grading: Partials (Final Submission)
> We will only grade the pages with the catalog.
> Please specify all URLs for the catalog (search, insert, view, etc.)

- Home (search/insert/view/filter/sort all there).
