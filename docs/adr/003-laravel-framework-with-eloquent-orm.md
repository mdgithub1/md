# 3. Laravel PHP framework with Eloquent ORM

Date: 2021-10-30

## Status

Accepted

## Context

- Laravel\Eloquent seems to be more suitable for fast growing API as it lets to create the project faster because of little volume initial set up.

## Decision
  
Use Laravel PHP framewrok with Eloquent ORM. 
  
## Consequences

We wil have a framework/ORM to rapidly build the API.  
The discipline how to create entities/models will not be exact as would be expected.  
  
**Risk**   
- Using Laravel\Eloquent brings a risk that technical assessment might point of using wrong practice:
  - Laravel\Eloquent does not force to describe entities with details
  - Laravel\Eloquent provides ready to go solution which often are recognised as anti-patterns
  - Using magic methods brings the impression that authors have a limited knowledge how to work with known patterns
