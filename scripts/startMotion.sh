#!/bin/bash
# Script to start the motion detection
# Robin Bürkli <robinbuerkli at bluewin dot ch>
# sudo modprobe bcm2835-v4l2
sudo su pi | motion -n -c /var/www/picam/scripts/motion.conf > /dev/null 2>&1  &