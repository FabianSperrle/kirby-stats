# kirby-stats

## What is kirby-stats

kirby-stats is a minimalistic visitor statistics tool: It logs either *each hit* or *one hit per session and page* and shows a little widget in the panel. Per default every hit is logged, see settings for how you can change that.

![Screenshot](http://i.imgur.com/CT2PhWe.jpg)

## Installation
### Download
[Download the files](https://github.com/FabianSperrle/kirby-stats/archive/master.zip) and put them in the respective subfolders of `site` and `assets`. If any of the folders don't exist, create them.

## Usage

**Warning**: This plugin will store its information in a page called `kirbystats`. If this page exists, it will be corrupted with other data! If it doesn't exist, do not worry, the plugin will create the page itself.

### Panel

Currently kirby-stats stores the logs on a per-language basis, if you're using a multi language setup. Depending on your panel language the corresponding logs will be loaded. A combined view is in the works... 

### Settings

Some details can be specified in the config file. Use `c::set('option', 'parameters')` in your `config.php` to use any of them.

Option | Values
-------|--------
stats.roles.ignore | A single role (e.g. `'admin'`) or an array of roles (`array('admin', 'editor')`) for which no data will be recorded. Default is "".
stats.days | kirby-stats keeps a log of the total page views per day for the last `$day` days. Default is 5.
stats.links | Whether to link to link to the respective page from the list of most frequently visited pages or not. Default is `true`.
stats.session | Whether to store each hit (`false`) or one hit per session and page (`true`). Default is `false`.
stats.date.format | Any valid PHP date format string. Will be used in the panel widget to display the recorded per-day values. Default is `d.m.y`.
stats.format | Output format for the list in the widget. Options are `percentage`, `absolute` and `both`. Default is `percentage`.

## Authors

Author: Fabian Sperrle
