---
layout: post
title: Making a Kali dropbox with an RPi4 (Part 1)
tags: rpi4 kali pentest pivpn
description: Setting up Kali on the Raspberry Pi 4.
---
## A - Getting the Kali image and putting it on your Raspberry Pi

1. Download from: https://www.offensive-security.com/kali-linux-arm-images/
![download page]

2. Extract with 7zip
Image - Extracting with 7zip

3. Write image to MicroSD card (include details about said MicroSD card)
Image - writing to microsd card with balena etcher

4. Connect Pi to power, monitor, mouse/keyboard, and boot 'er up.
Image - picture of everything connected

** Note:** I'm fairly certain you have to connect the box to a monitor and a USB keyboard and mouse in order to complete the setup. Every time I've tried SSHing to the device without going through the GUI-based setup, it never works.


## B - More admin steps before we can really get to playing

*After going through this initial setup we can SSH into the box (SSH was enabled by default) and complete a couple other administrative tasks:*

1. ssh into the box (note: my hostname is just 'kali' but yours could be anything):
```console
ssh root@kali
```

2. Change default password from *toor* to something else
```console
root@kali:~# passwd
```

3. Install some updates!
```console
root@kali:~# sudo apt-get upgrade && sudo apt-get update
```

4. Install OpenVPN
```console
root@kali:~# sudo apt-get install openvpn
```

5. From the VPN server, create a new certificate. Your method might be different but I use pivpn on another Raspberry Pi. Creating a certificate is as easy as typing in:
```console
pi@mediaPi:~ $ pivpn -a
```

*Here's the help output from pivpn. It really is a nice and easy to use tool. My favorite thing to do with it: tunnel through public wifi at work, hotels, and really anywhere else.*
```console
pi@mediaPi:~ $ pivpn
::: Control all PiVPN specific functions!
:::
::: Usage: pivpn <command> [option]
:::
::: Commands:
:::  -a, add [nopass]     Create a client ovpn profile, optional nopass
:::  -c, clients          List any connected clients to the server
:::  -d, debug            Start a debugging session if having trouble
:::  -l, list             List all valid and revoked certificates
:::  -r, revoke           Revoke a client ovpn profile
:::  -h, help             Show this help dialog
:::  -u, uninstall        Uninstall PiVPN from your system!
```

**Note:** How you choose to get the OpenVPN certificate from your VPN server where it was created to your Kali box is up to you. I simply used *scp*.

6. I like to reboot the device again, especially after running updates and installing OpenVPN.
```console
root@kali:~# shutdown -r now
```

7. After the reboot, make sure you can still SSH into the Kali Pi.
```console
ssh root@kali
```

8. Finally, lets setup OpenVPN so that it runs at boot and connects to our VPN server:
* Make OpenVPN autostart (run at boot) - remove the # in front of 'AUTOSTART="all"'
```console
root@kali:~# nano /etc/default/openvpn
```

* Copy the .ovpn file from step 5 to the /etc/openvpn directory, and name it 'client.conf.' In this example, the ovpn file I created is called kali.ovpn.
```console
root@kali:~# cp kali.ovpn /etc/openvpn/client.conf
```
** Note:** Make sure this client.conf is in /etc/openvpn/ and not /etc/openvpn/server/ or /etc/openvpn/client/

* Finally, enable OpenVPN to start on boot:
```console
root@kali:~# update-rc.d openvpn enable
```

* Moment of truth: reboot the device and make sure you see a connection on your VPN server:
```console
root@kali:~# shutdown -r now
```

```console
pi@mediaPi:~ $ pivpn -c

: NOTE : The output below is NOT real-time!
:      : It may be off by a few minutes.

::: Client Status List :::
                                                                Bytes           Bytes
Name                    Remote IP               Virtual IP      Received        Sent            Connected Since
Kali            73.---.---.123:55122    10.8.0.3        2.6KiB          2.3KiB          Aug 31 2019 - 21:24:16
```

## C - Dropping the box and hacking the target network.

*COMING SOON*