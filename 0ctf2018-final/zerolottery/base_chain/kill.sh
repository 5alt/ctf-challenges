#!/bin/bash
kill_session(){
	cmd=$(which tmux)
	session="data$1"

	run_session="run_$session"
	mine_session="mine_$session"

	$cmd kill-session -t $run_session
	$cmd kill-session -t $mine_session
}


for ((i=1; i<=12; i++)); do
   kill_session $i
done

for ((i=21; i<=35; i++)); do
   kill_session $i
done