# Deployment guide

How to put this repo live on the CENTAM WordPress.com Business site, switch centam.be over to it, and switch back to the GitHub Pages site if something goes wrong.

Written for Ivan. Checked against the WordPress.com, Polylang and GitHub docs on 2026-10-22; menu names on WordPress.com move around, so if a label differs slightly, look for the nearest match.

## What gets deployed

| Repo folder | Goes to | What it is |
|---|---|---|
| `themes/centam/` | `wp-content/themes/centam/` | The CENTAM block theme |
| `plugins/centam-projects/` | `wp-content/plugins/centam-projects/` | The Projects post type (`centam_project`, URLs under `/projects/`) and Project Categories |

The folder names must stay `centam` and `centam-projects` on the server. Everything else in the repo (`README.md`, `docs/`) is not deployed; `.deployignore` keeps it out.

Content (pages, news, projects, images) is **not** in the repo. It is created once in WordPress (step 6) and from then on lives only in the editor.

## Overview

1. Prepare the site and create a staging copy.
2. Deploy the theme and plugin to staging (GitHub Deployments, or zip upload as a fallback).
3. Install and configure the other plugins (Polylang, forms, SEO).
4. Set up Polylang (languages, URLs, Projects).
5. Create the EN and NL home pages from the patterns.
6. Add the news post and project, menus and translations.
7. Test on staging, then push staging to production.
8. Point centam.be at WordPress.com without breaking Microsoft 365 email.
9. After go-live: Search Console and redirects.
10. Fallback: point centam.be back at GitHub Pages.
11. Deploying future theme and plugin changes.

---

## 1. Prepare the site and create a staging copy

1. Log in at [wordpress.com](https://wordpress.com) and open the **Hosting Dashboard** (my.wordpress.com). Make sure the Business plan is **activated** on the site (plugins, staging and GitHub Deployments all need it).
2. Under **Settings → General**, set the site title to `CENTAM`, the language to English, and the timezone to Brussels.
3. Under **Settings → Reading**, keep "Discourage search engines" on until go-live (or keep the site in "Coming soon" mode under the hosting site settings).
4. Add any other editors as users on the **production** site now. Syncing staging back to production replaces the user list, so users must exist on production before staging is created.
5. Create the staging site: in the Hosting Dashboard click the site name, open the **Production** drop-down under the title, and choose **+ Add staging site**. It takes a few minutes. If the button is greyed out, the Jetpack connection usually needs fixing first.

Notes about staging from the WordPress.com docs: there is only one staging site per production site, its URL has a random prefix, it is hidden from search engines, and it shares the plan's storage with production.

Do steps 2 to 7 on **staging**.

## 2. Deploy the theme and plugin

### Recommended: WordPress.com GitHub Deployments

One connection deploys both folders, because the repo mirrors the `wp-content` layout.

1. In the Hosting Dashboard, open the **staging** site and choose **Deployments** in the left sidebar.
2. Click **Connect repository**. The first time, click **Install the WordPress.com app**, sign in to GitHub, click **Authorize WordPress.com for Developers**, choose the `ivankovac00` account, pick **Only select repositories** → `centam-wordpress`, and click **Install**.
3. Click **Select** next to `centam-wordpress` and fill in:
   - **Deployment branch:** `main`
   - **Destination directory:** `/wp-content`
   - **Automatic deployments:** on for staging (every merge to `main` goes live on staging)
   - **Deployment mode:** **Simple** (there is no build step)
4. Click **Connect**, then trigger the first deployment from the ⋮ menu → **Trigger manual deployment**. The status goes from "Queued" to "Deployed". The ⋮ menu → **See deployment runs** shows the log.
5. In WP Admin go to **Plugins** and activate **CENTAM Projects**, then **Appearance → Themes** and activate **CENTAM**.

Why `/wp-content` and not two connections: Simple mode copies the whole repo into the destination, so pointing the root at `/wp-content` lands `themes/centam` in `wp-content/themes/centam` and `plugins/centam-projects` in `wp-content/plugins/centam-projects`. The `.deployignore` file in the repo root stops `README.md`, `docs/` and other repo files from being copied into `wp-content`. WordPress.com merges files into the destination; it does not wipe `wp-content`, so other plugins and uploads are safe. (Their docs don't say whether a file deleted from the repo is also deleted on the server, so if you ever delete a file from the theme, check on staging.)

Later, connect the same repo to **production** with **Automatic deployments off** (manual), as WordPress.com recommends. See step 11.

### Fallback: upload zips

Use this if GitHub Deployments is unavailable.

1. On GitHub, open the repo, click **Code → Download ZIP**, and unzip it.
2. Make two zips whose top-level folder is the theme or plugin folder itself (not `centam-wordpress-main`):
   - `centam.zip` containing the `centam/` folder from `themes/`
   - `centam-projects.zip` containing the `centam-projects/` folder from `plugins/`

   On a Mac: right-click the `centam` folder → **Compress**, and rename the result. From a terminal in the repo: `cd themes && zip -r ../centam.zip centam && cd ../plugins && zip -r ../centam-projects.zip centam-projects`.
3. WP Admin → **Plugins → Add New → Upload Plugin**, upload `centam-projects.zip`, **Activate**.
4. WP Admin → **Appearance → Themes → Add New → Upload Theme**, upload `centam.zip`, **Activate**.
5. To update later, upload the new zip the same way and choose **Replace current with uploaded**.

If `/projects/` returns a 404 after activating the plugin, open **Settings → Permalinks** and click **Save** once.

## 3. Install and configure the other plugins

Keep the plugin list short. Everything below is either required or replaces something the old site did.

| Plugin | Why | Cost |
|---|---|---|
| **CENTAM Projects** (this repo) | Projects post type | free |
| **Polylang** | EN/NL | free |
| **Polylang Pro** (recommended) | Translating the header, footer and template text per language in the Site Editor, translated slugs, DeepL machine translation | paid licence |
| **Jetpack Forms** + **Akismet** | Contact form and spam filtering. Both come with WordPress.com, nothing to install | included |
| SEO | Use the **built-in WordPress.com/Jetpack SEO tools** (titles, meta descriptions) instead of adding Yoast | included |
| **Redirection** (optional) | Only needed for the old `news-article.html?id=…` links (see step 9) | free |

### Polylang free or Pro?

The theme keeps all translatable header, footer and template text (menu labels, "Back to News", 404 text, listing intros) in **template parts**. Polylang Pro translates template parts and the Site Editor navigation per language (**Appearance → Editor → Patterns → Template Parts**, then the Polylang language box). Polylang free does not, so with free only the English header and footer text would show on Dutch pages.

Recommendation: buy **Polylang Pro**. It also gives DeepL machine translation (with your own DeepL API key, whose free tier is enough for this site) and lets EN and NL posts share the same slug. Install it by uploading the zip from polylang.pro under **Plugins → Add New → Upload Plugin**, activate, and enter the licence key under **Languages → Settings → Licenses**. Polylang Pro replaces free; deactivate free if both are listed.

The EN | NL switcher in the header is built by the theme and works with either version.

### Turn off what isn't needed

No analytics or cookie banner for now. Under **Jetpack → Settings** (or the hosting site settings), turn off Jetpack **Stats** and any marketing or sharing tools. With those off, nothing on the site sets non-essential cookies, so no cookie banner is needed. If you ever turn analytics on, add a consent plugin at the same time.

## 4. Set up Polylang

1. **Languages → Languages**: add **English** (`en`, set as default) and **Nederlands** (`nl`).
2. When Polylang asks whether to assign existing content to the default language, say yes (English).
3. **Languages → Settings → URL modifications**:
   - "The language is set from the directory name in pretty permalinks"
   - tick **Hide URL language information for default language**

   Result: English at `/`, Dutch at `/nl/`, matching the current site.
4. **Languages → Settings → Custom post types and Taxonomies**: tick **Projects** and **Project Categories**, then save. Without this, projects show in both languages at once.
5. **Settings → Permalinks**: choose **Post name** (`/%postname%/`) and save.

## 5. Create the EN and NL home pages

The home page is a normal page built from the theme's patterns. Team, services and partners are edited directly on it afterwards.

1. **Pages → Add New**. Title: `Home`. Make sure the Polylang language box (sidebar) says **English**.
2. In the pattern chooser that opens (or the block inserter → **Patterns → Featured**), pick **Home page (English)**. Publish.
3. Back in **Pages**, click the **+** in the Dutch (NL flag) column next to Home. This creates the linked Dutch translation. Title it `Home`, pick **Home page (Nederlands)**, publish.
4. **Settings → Reading**: "Your homepage displays" → **A static page**, Homepage = **Home** (English). Polylang uses the linked Dutch page at `/nl/` automatically.
5. News listing: create a page **News** (EN) and its NL translation **Nieuws**, leave both empty, and set **Posts page** = News in **Settings → Reading**. The theme's news template renders the listing.
6. Visit `/` and `/nl/` and check all nine sections show.

The patterns are used once. Later changes to section patterns in the theme do not change pages that already exist; edit the page instead.

### Contact form

The Contact section already contains a Jetpack form that sends to **info@centam.be**. To check: open the Home page, select the form, and in the sidebar confirm the email under **Form notifications** (or **Responses**). Every submission is also stored in WP Admin under **Feedback** (Jetpack → Forms on newer screens). Akismet filters spam automatically.

Also add:
- A **Privacy Policy** page (EN and NL) under **Settings → Privacy**, and link it from the footer.
- In the form on each Home page, a **Consent** field (Jetpack form field type) with a short line and a link to the privacy page.

## 6. Content, menus and translations

There are only one news post and one project on the current site, so create them by hand instead of importing:

| Type | EN slug | NL |
|---|---|---|
| News post | `centam-first-quarter-completion` | translation of the same post |
| Project | `graded-gyroid-heat-sink` | translation of the same project |

Copy text and images from `centam-site` (`news.js`, `news.nl.js`, `projects.js`, `projects.nl.js`, `assets/`). Resize big images before upload (for example `Centam_board.png` is 6.5 MB; aim for under 300 KB and 2000 px wide). For each English item, create the Dutch version with the **+** in the NL column so the two are linked. With Polylang free, the Dutch slug must differ (for example `graded-gyroid-heat-sink-nl`); with Pro it can be the same.

News posts and projects: a team member reviews the Dutch version before publishing it.

**Header, footer and template text in Dutch** (Polylang Pro): **Appearance → Editor → Patterns → Template Parts**, open Header, Footer and each content part, create the NL translation in the language box, and translate the text. The Dutch header menu links should point to `/nl/#about`, `/nl/#services` and so on.

Check the logo: **Appearance → Editor → Header → Site Logo**. Until a logo is chosen, the theme shows its bundled logo.

## 7. Test on staging, then go to production

Check on staging, in English and Dutch, on a phone and a desktop:

- [ ] Home page sections, header (sticky, transparent over the hero), mobile menu, footer
- [ ] EN | NL switcher on the home page, news listing, a news post and a project
- [ ] News listing and post, project page, project category page, 404 page, search
- [ ] Contact form: send a test from each language and confirm the email arrives at info@centam.be and appears under Feedback
- [ ] No Jetpack Stats or other tracking scripts (browser dev tools → Network)

Then push staging to production: in the Hosting Dashboard open the **staging** site, use **Sync** (or the staging drop-down) and choose to sync **to production**, files and database. Take a backup of production first (**Backups** / Activity log). After syncing, check that the theme, plugins and pages are on production.

Then connect GitHub Deployments to **production** too (same settings as step 2, but **Automatic deployments off**).

## 8. Connect centam.be (GoDaddy) without breaking email

**Read this whole section before changing anything. The wrong change can stop Microsoft 365 email for @centam.be.**

### Before you start

1. In GoDaddy, open **My Products → centam.be → DNS** and export or screenshot **every** record. You will need these for the fallback (step 10) and to check email.
2. Note these Microsoft 365 records. They must not be deleted or changed:
   - **MX** `@` → `centam-be.mail.protection.outlook.com` (or similar)
   - **TXT** `@` → `v=spf1 include:spf.protection.outlook.com -all` (and the `MS=…` verification TXT)
   - **CNAME** `autodiscover` → `autodiscover.outlook.com`
   - **CNAME** `selector1._domainkey` and `selector2._domainkey` → `…onmicrosoft.com` (DKIM)
   - Any `_dmarc` TXT, `enterpriseregistration`/`enterpriseenrollment` CNAMEs or `_sip`/`_sipfederationtls` SRV records
3. Lower the TTL of the `A @` and `CNAME www` records to 600 seconds (10 minutes) a day before the switch, so both the go-live and any fallback spread fast.

### Use DNS records, not nameservers

WordPress.com offers two ways to connect a domain. **Do not change the nameservers** to `ns1/ns2/ns3.wordpress.com`: that moves all of centam.be's DNS to WordPress.com, and any email record not copied over correctly stops mail. WordPress.com itself recommends the DNS-records method when the domain has email you need to keep.

1. In the Hosting Dashboard (production site): **Domains → Add domain name → Use a domain I own**, enter `centam.be`, and choose **Connect** (not Transfer).
2. Choose the option to **update DNS records** (A records / CNAME), not nameservers. Skip GoDaddy's automatic "Domain Connect" option unless it clearly says it only changes the website records; doing it by hand is safer for email.
3. WordPress.com shows the exact values. In GoDaddy DNS:
   - Delete the four GitHub Pages **A** records for `@` (`185.199.108.153` … `185.199.111.153`) and any **AAAA** records for `@` (`2606:50c0:…`).
   - Add the **A** records for `@` that WordPress.com shows.
   - Change **CNAME** `www` from `ivankovac00.github.io` to the target WordPress.com shows.
   - Touch nothing else.
4. Back in WordPress.com, click **Verify Connection**. The status reads "Verifying" and then **Active**.
5. Make centam.be the **primary** domain of the site (Domains → centam.be → Make primary).

**Timing.** With the lowered TTL most visitors see the new site within an hour; WordPress.com allows up to 72 hours. SSL is issued automatically once the domain is Active, usually within minutes, at most 24 hours (visitors may see a warning in between). The `*.wordpress.com` address keeps working throughout.

**Check email right after:** send a message to and from info@centam.be, and confirm with a DNS checker (for example whatsmydns.net, type MX) that the MX record still points to Outlook.

### What happens to the GitHub Pages site

Leave the `centam-site` repo and its Pages setup alone, including the `CNAME` file. Once DNS points to WordPress.com:

- GitHub Pages keeps building, but centam.be no longer reaches it.
- Because the custom domain is still set in **Settings → Pages**, `ivankovac00.github.io/centam-site/` redirects to centam.be (now WordPress). So the static site is "parked", not browsable. That is fine for a fallback: switching DNS back makes it live again instantly, with no repo changes.
- If you want the static site browsable at its github.io address in the meantime, remove the custom domain in **Settings → Pages** (this deletes the `CNAME` file in a commit). You then have to add it back during a fallback, and HTTPS for centam.be on Pages can take up to 24 hours to come back. The recommendation is to **keep** the custom domain and `CNAME` file as they are.
- Security: with the custom domain set and the A records gone, nobody else can claim centam.be on GitHub Pages as long as the Pages site stays enabled. Do **not** disable Pages while the custom domain is still configured, and verify the domain under your GitHub account (**Settings → Pages → Verified domains**) to rule out takeovers.

## 9. After go-live

1. Turn search engines back on (**Settings → Reading**, or switch the site from "Coming soon" to public).
2. **Google Search Console**: verify `centam.be` (a DNS TXT record in GoDaddy; adding a TXT record does not affect email). Submit `https://centam.be/sitemap.xml` (WordPress.com generates it). Use URL Inspection on `/`, `/nl/`, a news post and a project.
3. **Redirects** from the old static URLs:

   | Old | New |
   |---|---|
   | `/index.html`, `/nl/index.html` | `/`, `/nl/` |
   | `/news.html`, `/nl/news.html` | the News / Nieuws page |
   | `/news-article.html?id=centam-first-quarter-completion` (+ `/nl/…`) | the post |
   | `/project.html?id=graded-gyroid-heat-sink` (+ `/nl/…`) | the project |

   The old site was only indexed with four URLs and has one article and one project, so this is low stakes. Simple redirects can be added with the **Redirection** plugin (it supports query-string matching for the `?id=` URLs). If you prefer no extra plugin, skip it and let those few old URLs 404.
4. Watch Search Console's **Pages** report for a couple of weeks for 404s.

## 10. Fallback: switch back to GitHub Pages

If WordPress.com has a problem, point the domain back. Email is unaffected as long as you only touch these records.

1. In GoDaddy DNS:
   - Remove the WordPress.com **A** records for `@`.
   - Add the four GitHub Pages **A** records for `@`: `185.199.108.153`, `185.199.109.153`, `185.199.110.153`, `185.199.111.153` (optionally the AAAA records `2606:50c0:8000::153`, `…8001::153`, `…8002::153`, `…8003::153`).
   - Set **CNAME** `www` back to `ivankovac00.github.io`.
2. In `centam-site` → **Settings → Pages**, confirm the custom domain is `centam.be` (re-add it if you removed it) and tick **Enforce HTTPS** once it is offered.
3. Optionally, in WordPress.com, leave the domain connected (it will show as misconfigured) so switching forward again is just the reverse DNS change.

**How long:** with a 600-second TTL, most visitors are back on the static site within 10 to 60 minutes; allow up to 24 hours everywhere. If the custom domain was removed and re-added on GitHub, HTTPS can take up to 24 hours to be issued.

**What the static site would be missing:** anything created or edited in WordPress after go-live (new news posts, projects, team or text changes), and the working contact form (the static form only opens the visitor's email app). Copy any important new content into `centam-site` by hand if the fallback lasts more than a few days.

## 11. Deploying future theme and plugin changes

**Recommended: GitHub Deployments**, set up in step 2 and 7.

- Staging: automatic. Every merge to `main` deploys to staging.
- Production: manual. When staging looks right, open the **production** site → **Deployments** → ⋮ → **Trigger manual deployment**.
- Bump `Version:` in `themes/centam/style.css` or `plugins/centam-projects/centam-projects.php` on each release, so browsers fetch fresh CSS and it is clear what is live.

Fallback: zip upload as in step 2 (**Replace current with uploaded**). SFTP also works on the Business plan but is not needed.

**Installer plugin (`centam-deploy.php`).** The repo root is also a small plugin, *CENTAM Deploy*, so the GitHub branch zip (`https://codeload.github.com/ivankovac00/centam-wordpress/zip/refs/heads/<branch>`) can be uploaded as a plugin, by hand or by Claude through the WordPress.com connector. Activating it replaces `wp-content/themes/centam` and `wp-content/plugins/centam-projects` with the copies in the zip, and the first time it also creates the EN/NL Home and News pages from the patterns and sets them as the front page and posts page. Once Polylang has English and Nederlands, activating it again links those pages as translations. It never touches a page it created before, so editors' changes are safe. Deactivate it afterwards. This is how the first deploy to berfugoksel-uvabf.wpcomstaging.com was done on 2026-10-23; `.deployignore` keeps the file out of GitHub Deployments.

Content changes (text, images, posts, projects, team, translations) are made only in the WordPress editor, never in this repo.

**One caveat on Site Editor edits.** When someone edits the header, footer or a template in **Appearance → Editor**, WordPress saves that copy in the database, and it wins over the theme files. A later deploy that changes the same part will not show until that customisation is reset (**Appearance → Editor → Patterns → Template Parts** → the part → ⋮ → **Reset**). Resetting throws away the editor's changes, including its Polylang translations, so redo them afterwards.

## Sources

- WordPress.com: [GitHub Deployments](https://wordpress.com/support/github-deployments/), [staging sites](https://wordpress.com/support/how-to-create-a-staging-site/), [connect an existing domain](https://wordpress.com/support/domains/connect-existing-domain/)
- Polylang: [Site Editor support (Pro)](https://polylang.pro/doc/site-editor/), [multilingual navigation in the Site Editor](https://polylang.pro/documentation/support/guides/multilingual-navigation-site-editor/)
- GitHub: [managing a custom domain for GitHub Pages](https://docs.github.com/en/pages/configuring-a-custom-domain-for-your-github-pages-site/managing-a-custom-domain-for-your-github-pages-site)
