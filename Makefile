up:
	docker run -d -i -t  --name="behat"  --add-host=workcopy.personare.com.br:0.0.0.0 -v `pwd`:/home/behat   --link nef:nef delermando/php5.4-behat3 /bin/bash;

down:
	docker rm  behat;

kill:
	docker kill behat ;

restart:
	docker restart behat;

status:
	docker ps -a;

connectBehat:
	docker exec -it behat bash;
vendor/bin/behat features/user/LoginUser2.feature --suite=user