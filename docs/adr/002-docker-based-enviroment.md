# 2. Docker based environment

Date: 2021-10-30

## Status

Accepted

## Context

- Environment should be replicable
- Environment should be easy to run

## Decision

Use Docker base environment with precompile image.  

## Consequences

The environment will be easy to run up on dev machines.  
   
**Risk**:  
- The machine where the project is run needs to have preinstalled Docker Engine and docker-compose.
- User must be logged into dockerhub account.
