---
layout: post
title: Customize Cockpit
tags: Cockpit, RPi
description: How to add custom links to Cockpit web-based server management tool.
---


# What is Cockpit?
According to their [website](https://cockpit-project.org/) Cockpit is "the easy-to-use, integrated, glanceable, and open web-based interface for your servers." Instead of having to always use SSH to manage your servers via CLI, or using RDP or VNC to get a desktop on the server, you can use Cockpit to manage your servers using a web browser. I won't go over all the awesome-ness that Cockpit offers (that's what their website is for), but I will show you how to customize the tool.


# Some Background
I have cockpit running on 3 Raspberry Pi devices, with one acting as the 'central manager.' That means I can login to one device (piNext in this case) and from there I can access a web-based terminal for my other devices, see their operating performance and different metrics, update them, restart applications and services, etc. A really, really useful tool! As you can see in the following image, I have one pi as my printer server for my 3D Printer, I have one that's a satellite ground station and does SETI@Home processing, and another that runs my Plex Media Server and PiHole instance. While Cockpit by it's self is super useful, you can also customize it to run custom tools and scripts, or even to open a webpage that's related to the device. I'm mainly focusing on opening webpages right now.

![alt text](https://cyb3rsinn3r.github.io/images/Cockpit/1.png "1")


# My Use Case
My 'satnogs' device is running a [SatNOGS](https://satnogs.org/) satellite ground station as well as computing for [SETI@Home](https://setiathome.berkeley.edu/). Instead of relying on bookmarks in my browser to visit these pages, I figured it would be nice to have a direct link to these pages from the cockpit dashboard. I've found some tutorials on how to write custom tools for Cockpit but, for some reason, I couldn't find anything on how to make just a html redirect. So here ya go; maybe someone else can find this useful. Below is a screenshot of the dashboard for device 'satnogs' showing the custom 'tools' on the left side (called "SatNOGS" and "SETI@Home").
![alt text](https://cyb3rsinn3r.github.io/images/Cockpit/2.png "2")


# Cockpit folders
Cockpit can be installed just about anywhere on your device and the folders we're interested are in `/usr/share/cockpit`.
```
pi@satnogs:/usr/share/cockpit $ ls -al
total 76
.
..
apps
base1
branding
dashboard
motd
networkmanager
packagekit
realmd
satnogs
seti
shell
ssh
static
storaged
systemd
tuned
Users
```

# Creating the custom link
Creating the custom link is as easy as:
1. Create a directory located in `/usr/share/cockpit`:
```sudo mkdir /usr/share/cockpit/example```
2. Create `manifest.json` inside our new `Example` directory with these contents:
```{
	        "version":0,
	        "tools":{
	                "satnogs":{
	                        "label": "Example",
	                        "path": "show.html"
	                }
	        },
	        "content-security-policy": "default-src 'self' 'unsafe-inline' 'unsafe-eval';frame-src 'self' * "
	}
```
	
3. Create `show.html` in the same directory:
	
```<html>
	<head>
	    <title>Go To Google</title>
	    <meta charset="utf-8">
	    <link href="../base1/cockpit.css" type="text/css" rel="stylesheet">
	    <script src="../base1/jquery.js"></script>
	    <script src="../base1/cockpit.js"></script>
	</head>
	<body>
	        <div class="container-fluid" style='max-width: 850px'>
	                <h4> Redirecting to Google </h4>
	        </div>
	<script>
	        var redirect_link = "https://www.google.com";
	        window.top.location.replace(redirect_link);
	</script>
	</body>
	</html>
```
	
4. Login to the device's cockpit on port 9090. And there we have it, Example on the left side:
5. ![alt text](https://cyb3rsinn3r.github.io/images/Cockpit/3.png "3")
	
6. Click on it and you're taken to Google.com. 
7. Removing this "add-on" just requires you to delete the example directory and refresh the dashboard (F5):
```sudo rm -rf /usr/share/cockpit/example/```
	
# Fin!

That's really all there is to it! Enjoy!
