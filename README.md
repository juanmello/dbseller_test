# calendario-melhorias

## Instalação
```shell
docker-compose up
```

## Carregando dados na base
```shell
docker exec -it <container-name> bash
cd /home
psql -U postgres -f database.sql
psql -U postgres -f seeds/seeds.sql
```

## Instalando dependências
```shell
docker exec -it <container-name> bash
chmod +x composer
php composer install
```

#### Correções de bugs e melhorias
~~*Você deve criar um merge request com sua correção.*~~
Crie um fork do projeto com as suas correções

### ATENÇÃO
O projeto não se trata de um projeto real, trata-se apenas de um teste, por isso solicito que não faça interações neste projeto. 
Fork o projeto e para qualquer dúvida sore as tarefas recrie-as no seu projeto e comente lá.