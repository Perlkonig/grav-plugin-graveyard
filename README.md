# Graveyard Plugin

The **Graveyard** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Grav offers powerful routing options to help you when you have to move content, but what it (and most other CMSs) can't do is know when you intentionally deleted something. This plugin lets you record a list of intentionally deleted routes. When those routes are requested, it emits a proper `410 GONE` code instead of the more vague `404 NOT FOUND`.

For a demo, [visit my blog](https://perlkonig.com/demos/graveyard).

## Installation

Installing the Graveyard plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install graveyard

This will install the Graveyard plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/graveyard`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `graveyard`. You can find these files on [GitHub](https://github.com/Perlkonig/grav-plugin-graveyard) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/graveyard
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) plugins to operate.

## Usage

The plugin works automatically once enabled. All you have to do is maintain the list of intentionally deleted routes. 

To render the the error page, it first checks to see if you have the [Error](https://github.com/getgrav/grav-plugin-error) plugin configured for 410s. If so, it will render what you have there. Otherwise it will use the built-in page and text. To customize, follow the instructions for the the [Error](https://github.com/getgrav/grav-plugin-error) plugin to create your custom page. You can use this plugin's `pages/graveyard.md` as a base.

## Configuration

Here's the default configuration. To override, first copy `graveyard.yaml` from the `user/plugins/graveyard` folder to your `user/config/plugins` folder.

```
enabled: true
graveyard:
  - /nonexistent/post
```

The `enabled` field turns the plugin off and on. 

The `graveyard` field is a simple list of routes. You can use basic shell wildcards. [Refer to the PHP function `fnmatch` for details.](https://secure.php.net/manual/en/function.fnmatch.php) When Grav can't find a given page, it first checks to see if that page's route is on this list. If it is, it emits a `410`. Otherwise it emits a `404`.


