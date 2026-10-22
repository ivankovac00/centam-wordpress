# CENTAM block theme

Block theme for centam.be on WordPress.com, ported from the static site in `ivankovac00/centam-site`.

## Layout

| Path | What it holds |
|---|---|
| `theme.json` | The 7 brand colours, Barlow Condensed + Roboto (self-hosted, no Google Fonts requests), font sizes, spacing presets, button and heading styles. Custom colours, font sizes and other free-form styling are switched off so editors stay on brand. |
| `style.css` | Looks theme.json cannot express: block styles, fixed header, footer, cards, hero mesh, hexagon photos, 404. |
| `functions.php` | Loads assets, registers block styles, adds the EN \| NL switcher to the header menu, falls back to the bundled logo until a Site Logo is set. |
| `parts/` | Header, footer, and the language-dependent content of each template (news listing, article, project, archive, search, 404). Polylang Pro translates template parts per language, which is why the text lives in parts and not in templates. |
| `templates/` | `front-page` (renders the Home page content), `page`, `page-full-width`, `home`/`index` (news listing), `single`, `single-centam_project`, `archive-centam_project`, `taxonomy-centam_project_category`, `archive`, `search`, `404`. |
| `patterns/` | `part-header` and `part-footer` (used by the parts, hidden from the inserter). Home section patterns are added separately. |
| `assets/` | Fonts (OFL licences included), logos, `js/centam.js` (whole news card clickable). |

## Block styles

| Block | Style name | Label in the editor |
|---|---|---|
| Cover | `centam-hero` | Hero (hex mesh) |
| Group | `centam-section-dark`, `centam-section-darker`, `centam-section-light` | Section: dark / dark green + mesh / light (sets background, text colour, 120/60px padding) |
| Group, Column | `centam-card` | Card |
| Paragraph | `centam-eyebrow`, `centam-meta` | Eyebrow, Meta (small) |
| Separator | `centam-accent-bar` | Maroon bar |
| Image | `centam-hexagon`, `centam-partner-logo` | Hexagon photo, Partner logo |
| Post Template | `centam-card-grid` | Card grid (3 columns) |
| Button | core `outline` | styled as the ghost button |

Spacing presets include `gutter` (48px, 20px on phones) and `section` (120px, 60px on phones).

## Requirements

WordPress 6.6 or later (checked locally on 7.1.3), the `centam-projects` plugin for the Projects post type, and Polylang. Translating the header, footer and template text per language needs **Polylang Pro 3.8+** (template part translation in the Site Editor). The EN \| NL switcher works with Polylang free or Pro.
