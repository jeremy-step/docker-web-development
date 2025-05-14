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
