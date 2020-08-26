## About Leaderboard
### Requirements
Based on the following requirements - 
- Must have 5 users showing in the leaderboard
- All users must start with 0 points
- As you click +/-, the leaderboard updates and users are re-ordered based on score
- Names sorted alphabetically if they are tied

### Database
To run database migrations, run the following command
> php artisan migrate

### Populate data
We need to run the following command to seed the database
> php artisan db:seed --class=PlayerSeeder