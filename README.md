# centam-wordpress

WordPress.com theme and plugin for centam.be.

| Folder | Deploys to |
|---|---|
| `themes/centam/` | `wp-content/themes/centam/` (block theme, see its README) |
| `plugins/centam-projects/` | `wp-content/plugins/centam-projects/` (Projects post type) |

The repo mirrors `wp-content`, so WordPress.com GitHub Deployments can deploy it with the destination `/wp-content`; `.deployignore` keeps the rest of the repo out. Step-by-step setup, domain switch and fallback: [docs/DEPLOYMENT-GUIDE.md](docs/DEPLOYMENT-GUIDE.md).
