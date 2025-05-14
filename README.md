[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/cima-alfa/docker-web-development)

# Docker Web Dev Preset

## Commands

| Command                               | Description                 |
|---------------------------------------|-----------------------------|
| `app up [<container>] [-d] [--build]` | Start / Build container(s). |
| `app stop [<container>]`              | Stop container(s).          |
| `app restart [<container>]`           | Restart container(s).       |
| `app down [<container>] [-v]`         | Remove container(s).        |
| `app sh <container>`                  | Access container shell.     |

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

