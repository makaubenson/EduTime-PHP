#!/bin/bash

while [[ $# -gt 0 ]]
do
    key="$1"

    case $key in
        -m|--message)
        message="$2"
        shift # past argument
        shift # past value
        ;;
        -d|--description)
        description="$2"
        shift # past argument
        shift # past value
        ;;
        *)    # unknown option
        echo "Unknown option: $key"
        exit 1
        ;;
    esac
done

if [ -z "$message" ]; then
    echo "Commit message not provided"
    exit 1
fi

if [ -z "$description" ]; then
    echo "Commit description not provided"
    exit 1
fi

commit_message="$message"$'\n\n'"$description"
git add . &&
git commit -m "$commit_message"
