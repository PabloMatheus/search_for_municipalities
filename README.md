
## 📁 Instalação

#### Para executar a aplicação sera necessário o Docker
```bash
$ sudo apt-get docker docker-compose -y
```

#### Antes de executar a aplicação é importante copiar o arquivo .env.example para o .env. para isso, acesse o diretório raiz da aplicação e execute o código abaixo
```bash
$ cp .env.example .env
```


#### Para executar a aplicação sera necessário subir o container, para isso, acesse o diretório raiz da aplicação e execute o código abaixo
```bash
$ docker-compose up --build -d
```

## 📁 Configurações disponíveis
#### Existem atualmente dois provedores de busca disponíveis, a BrasilApi e Ibge. Ibge esta sendo utilizada como padrão. Caso queira alterar, baste alterar a linha do arquivo de variavel de ambiente chamada `DEFAULT_MUNICIPALITIES_SEARCH_PROVIDER`
