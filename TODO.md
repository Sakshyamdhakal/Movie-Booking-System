# TODO: Add "Your Ticket" Button to Welcome Page Navigation

## Steps Completed:
- [x] Add "Your Ticket" button in navigation bar of `resources/views/welcome.blade.php`
- [x] Create migration to add user_id to movie_bookings table
- [x] Update MovieController to store user_id when creating booking
- [x] Update query to fetch latest booking using user_id
- [x] Implement dropdown for button to display ticket info (Movie, Name, Email, Seats)
- [x] Handle case where no booking exists (show "No bookings yet")
- [x] Fix modal visibility issues by adding Alpine.js and x-cloak

## Remaining Steps:
- [x] Run the migration: php artisan migrate
- [x] Style the blade files inside movies view (book.blade.php, confirmation.blade.php, movies.blade.php)
- [ ] Test welcome page navigation to ensure "Your Ticket" button and ticket info display correctly
- [ ] Verify behavior for users with and without bookings
