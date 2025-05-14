[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/cima-alfa/docker-web-development)

# Docker Web Dev Preset

## Commands

- `docker compose --env-file=./.docker/.env up -d [--build]` (Start up containers - build as needed)
- `docker compose --env-file=./.docker/.env stop` (Stop all containers)
- `docker compose --env-file=./.docker/.env down` (Remove all containers)
- `docker exec -it <container> sh` (Access container shell)

## Containers

- `web-server` (Apache 2 Alpine)
- `application` (PHP 8.4 FPM Alpine, Node.js Latest - Optional)
- `mail` (Mailpint Latest)
- `database` (MySQL 8.4)
- `cache` (Redis 7.4 Alpine)
- `adminer` (Adminer Latest)

## Create a new project from this template repository

```shell
gh repo create my-new-project --template cima-alfa/docker-web-development --clone [--private]
```

or just clone it without creating a new repository...

```shell
gh repo clone cima-alfa/docker-web-development my-new-project
```

or

```shell
git clone https://github.com/cima-alfa/docker-web-development.git my-new-project
```

