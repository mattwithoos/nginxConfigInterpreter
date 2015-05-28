README: nginxConfigInterpreter
======

** Please submit feature requests to the issue queue, I am open to active development.**

The nginxConfigInterpreter takes a standards-compliant nginx server
configuration file and parses it into a multi-dimensional array.

The format of your server config file needs to be:

    server {
      key value # inline comment only
      location {
        key value
      }
      location @rewrite {
        key value
        key value
      }
    }

Of relevance are:
- comments should be inline only
- key-value should be separated by a single space
- indentations should be double-spaced
- open curly brace should be inline with one space from the previous character

This conveniently works well with an unrelated project, Nginx Config Processor:
https://github.com/romanpitak/Nginx-Config-Processor
--------------------------------

- **Used with:** nginx
- **For:** Parsing server block .conf files
- **Author:** Matt Withoos
- **Author URI:** http://mattwithoos.com
- **Description:** The nginxConfigInterpreter takes a standards-compliant nginx server configuration file and parses it into a multi-dimensional array.
- **Version:** 1.0.0
- **License:** GNU General Public License v3 or later
- **License URI:** http://www.gnu.org/licenses/gpl-3.0.html
- **Tags:** nginx, config, parser, interpreter, nginxconfiginterpreter, nginx config interpreter, nginx config parser, configuration, nginx configuration parser, nginx configuration interpreter, nginx config, nginx configuration
