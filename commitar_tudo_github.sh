#!/bin/bash
/Library/PostgreSQL/9.5/bin/pg_dump -h localhost -U postgres -C  customworkflow > BD/dump.sql;
git add . ;
git commit -m "$1";
git push;
