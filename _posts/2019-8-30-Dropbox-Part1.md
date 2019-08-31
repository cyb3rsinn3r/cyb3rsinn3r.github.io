---
layout: post
title: Making a Kali dropbox with an RPi4 (Part 1)
tags: rpi4 kali pentest pivpn
description: Setting up Kali on the Raspberry Pi 4.
---

Download from: https://www.offensive-security.com/kali-linux-arm-images/
Image - Download page

Extract with 7zip
Image - Extracting with 7zip

Write image to MicroSD card (include details about said MicroSD card)
Image - writing to microsd card with balena etcher

Connect Pi to power, monitor, mouse/keyboard, and boot 'er up.

Change default password from toor to something else

Enable SSH access

sudo apt-get upgrade && sudo apt-get update

install openvpn

cut vpn cert

connect via vpn

