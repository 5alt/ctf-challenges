#!/bin/bash
rm -rf ./team_data/*
for ((i=1; i<=12; i++)); do
   cp -r data ./team_data/data$i
done

for ((i=21; i<=35; i++)); do
   cp -r data ./team_data/data$i
done