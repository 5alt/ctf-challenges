#!/bin/bash
start_game(){
	cmd=$(which tmux)
	session="data$1"
	let "rpcport=8000+$1"
	let "p2pport=3000+$1"
	run_session="run_$session"
	mine_session="mine_$session"

	$cmd has-session -t $run_session > /dev/null

	if [ $? != 0 ]; then
	    $cmd new-session -s $run_session -d
	    $cmd send-keys -t $run_session "HOME=team_data/$session geth --datadir team_data/$session --networkid 1337 --rpc --rpcaddr 127.0.0.1 --rpcport $rpcport --rpcapi='eth,personal' --nodiscover --port $p2pport" C-m      
	    $cmd new-session -s $mine_session -d
	    $cmd send-keys -t $mine_session "sleep 5; HOME=team_data/$session geth --preload ./automine.js attach $(pwd)/team_data/$session/geth.ipc console" C-m           
	fi
}
                       
for ((i=1; i<=12; i++)); do
   start_game $i
done

for ((i=21; i<=35; i++)); do
   start_game $i
done
