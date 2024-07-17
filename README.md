# Data Aggregator

### table of content 
- usage
- test cases

## Usage

- Collect data from file add file to storage directory then run:
`sail artisan provider:collect-data`

- For list and filter users http://localhost:81/api/users

## test 
- Test html reports => `~/reports` 
- Run test cases run => `sail pest`




### Note : 
 - tThe project depends on retrieving data from files first, then putting it in the database, and then dealing with it. I thought about using laravel `LazyCollection` to read files without relying on the database but I didn't have enough time to implement or integrate other solutions


