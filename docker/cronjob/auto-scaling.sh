#!/bin/bash

MAX_REPLICAS=10
MIN_REPLICAS=2
SERVICE_NAME="laravel"
CPU_THRESHOLD=75
MEMORY_THRESHOLD=80

while true; do
  CPU_LOAD=$(docker stats --no-stream --format "{{.CPUPerc}}" | sed 's/%//g' | awk '{s+=$1} END {print s}')
  MEMORY_LOAD=$(docker stats --no-stream --format "{{.MemPerc}}" | sed 's/%//g' | awk '{s+=$1} END {print s}')

  if [ "$CPU_LOAD" -gt "$CPU_THRESHOLD" ] || [ "$MEMORY_LOAD" -gt "$MEMORY_THRESHOLD" ]; then
    CURRENT_REPLICAS=$(docker service inspect --format '{{.Spec.Mode.Replicated.Replicas}}' $SERVICE_NAME)
    if [ "$CURRENT_REPLICAS" -lt "$MAX_REPLICAS" ]; then
      NEW_REPLICAS=$((CURRENT_REPLICAS + 1))
      docker service scale ${SERVICE_NAME}=${NEW_REPLICAS}
      echo "Increased replicas to $NEW_REPLICAS"
    fi
  elif [ "$CPU_LOAD" -lt "$CPU_THRESHOLD" ] && [ "$MEMORY_LOAD" -lt "$MEMORY_THRESHOLD" ]; then
    CURRENT_REPLICAS=$(docker service inspect --format '{{.Spec.Mode.Replicated.Replicas}}' $SERVICE_NAME)
    if [ "$CURRENT_REPLICAS" -gt "$MIN_REPLICAS" ]; then
      NEW_REPLICAS=$((CURRENT_REPLICAS - 1))
      docker service scale ${SERVICE_NAME}=${NEW_REPLICAS}
      echo "Decreased replicas to $NEW_REPLICAS"
    fi
  fi

  sleep 30
done
