#!/bin/bash
# Script to start the vlc http stream
# Robin Bürkli <robinbuerkli at bluewin dot ch>
su pi | raspivid -o - -t 99999 -hf -w 480 -h 360 -fps 15|cvlc -vvv stream:///dev/stdin --sout '#standard{access=http,mux=ts,dst=:8554}' :demux=h264