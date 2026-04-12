[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/jeremy-step/helm-web-dev)

# Helm - Docker Web Dev Preset

## Create a new project repository from this template via the GitHub CLI

```shell
gh repo create my-new-project --template jeremy-step/helm-web-dev --clone [--private]
```

```shell
cd my-new-project
```

> Copy the `.helm/.env.example` file and rename it to `.helm/.env`.
> ```shell
> cp "./.helm/.env.example" "./.helm/.env"
> ```

### Or just <a href="https://raw.githubusercontent.com/jeremy-step/get-helm-web-dev/main/download.sh" target="_blank" title="See the download script">download</a> the preset

```shell
curl -s https://raw.githubusercontent.com/jeremy-step/get-helm-web-dev/main/download.sh | bash -s my-new-project
```

```shell
cd my-new-project
```

> This automatically creates the `.helm/.env` file for you.

## Commands

`helm` is a simple shell script located in the `.helm/bin` directory to make executing basic Docker CLI commands easier:

| Command                                       | Description                                                                                                                                        |
| --------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------- |
| `helm up [<container>] [-d] [--build]`        | Start / Build container(s).                                                                                                                        |
| `helm stop [<container>]`                     | Stop container(s).                                                                                                                                 |
| `helm restart [<container>]`                  | Restart container(s).                                                                                                                              |
| `helm down [<container>] [-v]`                | Remove container(s).                                                                                                                               |
| `helm sh [--user root] [options] <container>` | Access container shell. <ul><li>The default user is: "root".</li><li>The default user for the "application" container is: "application".</li></ul> |
| `helm composer [args]`                        | Use composer.                                                                                                                                      |
| `helm c [args]`                               | Alias for: "helm composer [args]"                                                                                                                  |
| `helm pnpm [args]`                            | Use pnpm (if installed).                                                                                                                           |
| `helm pm [args]`                              | Alias for: "helm pnpm [args]"                                                                                                                      |

For example:

-   `helm up ...` executes `docker compose --env-file=./.helm/.env up ...`
-   `helm sh <container>` executes `docker exec -it <container> sh`

### TIP: Executing the `helm` shell script

Instead of writing `./.helm/bin/app ...` or `../.helm/bin/app ...`, you can create a global alias / function that executes the script for the current project.

Export the following function in your `~/.bashrc` or `~/.bash_aliases` file:

```shell
function helm()
{
    dir="$PWD"

    while [ "$dir" != "/" ]; do
        if [ -f "$dir/.helm/bin/helm" ]; then
            bin="$dir/.helm/bin/helm"
            marker=$(sed -n '3p' "$bin")

            if [ "$marker" != "# [[ Docker shell helper script for the https://github.com/jeremy-step/helm-web-dev template ]]" ]; then
                printf "Incompatible helm binary found at %s.\n" "$bin"

                return
            fi

            eval "$bin ${@}"

            return
        fi

        dir=$(dirname "$dir")
    done

    printf "No project found - could not locate .helm/bin/helm in the current or any parent directory.\n"
}

export -f helm
```

Now, if you execute the `helm ...` command, it will automatically find the correct `.helm/bin/helm` shell script for the current project.

### Containers

-   `web-server` (Apache 2.4 Alpine)
-   `application` (PHP 8.5 FPM Alpine, Node.js 24.14 - Optional)
-   `mail` (Mailpit v1.29)
-   `database` (MariaDB 12.2)
-   `cache` (Redis 8.6 Alpine)
-   `adminer` (Adminer 5.4)
