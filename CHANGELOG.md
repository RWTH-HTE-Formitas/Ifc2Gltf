# Changelog

## [unreleased]

- Add: Added CORS rule for the conversion endpoint to be callable by the browser
- Fix: Removed another timeout (nginx fastcgi_read_timeout) aborting the conversion after five minutes
- Fix: Implicit timelimits on conversion processes caused conversion to fail for large models 
