# Graveyard Plugin

The **Graveyard** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Grav offers powerful routing options to help you when you have to move content, but what it (and most other CMSs) can't do is know when you intentionally deleted something. This plugin lets you record a list of intentionally deleted routes. When those routes are requested, it emits a proper `410 GONE` code instead of the more vague `404 NOT FOUND`.

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
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Usage

The plugin works automatically once enabled. All you have to do is maintain the list of intentionally deleted routes.

## Configuration

Here's the default configuration. To override, first copy `graveyard.yaml` from the `user/plugins/graveyard` folder to your `user/config/plugins` folder.

```
enabled: true
graveyard:
  - /nonexistent/post
```

The `enabled` field turns the plugin off an on. The `graveyard` field is a simple list of routes. When Grav can't find a given page, it first checks to see if it's on this list. If it does, it emits a `410`. Otherwise it passes control to the **Error** and emits a `404`.


