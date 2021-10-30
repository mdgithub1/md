# 0. Scribe for API documentation

Date: 2021-10-30

## Status

Accepted

## Context

We need to documented API requests/responses

## Decision

Use [Scribe](https://github.com/knuckleswtf/scribe) to document API becouse the package is known for developer.

## Consequences

- API documentation will be generated from PHPDocs annotations.
- API documentation will be available via web route
- Documentation might be imported to OpenApi or Postman from generated files
  
**Risk**:  
- Files for OpenApi or Postman are not tested
