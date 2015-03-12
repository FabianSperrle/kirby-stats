# kirby-stats

This is work in progress! 

## What is kirby-stats

kirby-stats is a minimalistic visitor statistics tool: It logs *each hit* to the website and shows a little widget in the panel.

![Screenshot](http://i.imgur.com/CT2PhWe.jpg)

## Installation
### Step 1
#### Download
[Download the files](https://github.com/FabianSperrle/kirby-stats/archive/master.zip) and put them in the respective subfolders of `site`. If any of the folders don't exist, create them.
    
### Adjustments

Merge your current routing information with the one present in `site/config/config.php`. This route is by no means exhasutive and will be subject to change...


## Usage

**Warning**: This plugin will store its information in a page called `stats`. If this page exists, it will be corrupted with other data! If it doesn't exist, do not worry, it will create the page itself.

## Authors

Author: Fabian Sperrle
