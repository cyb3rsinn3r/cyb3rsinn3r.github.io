---
layout: post
title: Making a Kali dropbox with an RPi4 (Intro)
tags: rpi4 kali pentest pivpn
description: Introduction and plan for a series of how to make a pentesting dropbox with Kali Linux on a Raspberry Pi 4.
---

I've set out to make a pentesting dropbox with my Raspberry Pi 4 (2GB RAM). I'll try to include pictures, screenshots, and a live-action demo of the dropbox at work!

![Kali for RPi4](/images/kali-raspberry-pi-4.png)

There are only a couple things I need this box to do:
1. Run Kali Linux to include all the tools a pentester would need. 
2. I need it to 'phone home' via a VPN tunnel as soon as it boots up.

It's a short list! Here's why:
1. I'm not actually doing any pentesting with this device, so I won't need to hide my identity; this means I can use the existing VPN connection I have at home instead of setting up a VPS in the cloud.
2. Instead of using SSH tunneling, I can rely on my OpenVPN connection because I know my target network already allows the VPN tunnels to build.
3. I'm not worried about keeping the form factor small enough to hide in a powerstrip or something similar. That said, I'm going to use a case with a fan to help keep the board cool when running CPU-intensive tasks.
4. I really don't have to hide the box on my target network. I know exactly where I'll be putting it and an outlet is available for me to use, so I won't need to figure out how to bundle the device with a battery pack.

Basically, like almost every project I do, I am doing this for myself to see if I can actually do it. It's a simple proof of concept but it can easily be taken further for more advanced applications.

Here's the game plan:
1. Setup Kali for the RPi on a microSD card.
2. Configure Kali to obtain an IP address via DHCP.
3. Create a certificate on my existing VPN server and setup the OpenVPN connection on Kali.
4. Create a script to connect via VPN on boot. 
5. Install the box on my target network.
6. Access the box via the VPN tunnel and see if I can run different tools on the target network.
7. Recover the box.

A couple of legal notices first:
* If you do this, make sure you have approval to place the device on the target network. NEVER HACK A NETWORK YOU DON'T OWN OR ADMIN.
* If you do this and you break something on the target network or end up on the wrong side of the law, don't say I didn't warn you. I accept no responsibility for your actions. See the first bullet above.
