# CENTAM Projects plugin

Registers the **Projects** post type (`centam_project`, URLs under `/projects/`) and **Project Categories** (`centam_project_category`). It lives outside the theme so projects keep working if the theme changes.

## Install on WordPress.com

1. Zip the `centam-projects` folder.
2. In WP Admin go to Plugins → Add New → Upload Plugin, upload the zip and activate it.
3. In Languages → Settings → Custom post types and Taxonomies, tick **Projects** and **Project Categories** and save, so Polylang can translate them.
4. If `/projects/` returns a 404, open Settings → Permalinks and click Save once.
