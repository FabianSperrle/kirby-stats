# kirby-stats

This is currently only tested on single language pages.

## What is kirby-stats

kirby-stats is a minimalistic visitor statistics tool: It logs *each hit* to the website and shows a little widget in the panel.

![Screenshot](http://i.imgur.com/CT2PhWe.jpg)

## Installation
### Download
[Download the files](https://github.com/FabianSperrle/kirby-stats/archive/master.zip) and put them in the respective subfolders of `site` and `assets`. If any of the folders don't exist, create them.

## Usage

**Warning**: This plugin will store its information in a page called `kirbystats`. If this page exists, it will be corrupted with other data! If it doesn't exist, do not worry, the plugin will create the page itself.

### Settings

Some details can be specified in the config file. Use `c::set('option', 'parameters')` in your `config.php` to use any of them.

Option | Values
-------|--------
stats.roles.ignore | A single role (e.g. `'admin'`) or an array of roles (`array('admin', 'editor')`) for which no data will be recorded. Default: ""
stats.days | kirby-stats keeps a log of the total page views per day for the last `$day` days. Default: 5
stats.date.format | Any valid PHP date format string. Will be used in the panel widget to display the recorded per-day values. Default: `d.m.y`
stats.links | Whether to link to link to the respective page from the list of most frequently visited pages or not. Default `true`

## Authors

Author: Fabian Sperrle
