# Dub.co Integration

## Available Tools

### dub_list_links
List short links with pagination, search, and filtering by domain or tag.

**Parameters:**
- `page` (integer, optional) — Page number for pagination (default: 1).
- `pageSize` (integer, optional) — Number of results per page (default: 50).
- `search` (string, optional) — Search query to filter links by URL, key, or title.
- `domain` (string, optional) — Filter links by domain (e.g., "lnkd.in", "dub.sh").
- `tagId` (string, optional) — Filter links by tag ID.

### dub_get_link
Get details of a specific short link by its ID.

**Parameters:**
- `id` (string, required) — The link ID.

### dub_create_link
Create a new short link.

**Parameters:**
- `url` (string, required) — The destination URL to shorten.
- `domain` (string, optional) — The domain for the short link.
- `key` (string, optional) — The custom key (back-half) for the short link.
- `title` (string, optional) — Optional title for the link.
- `description` (string, optional) — Optional description for the link.
- `tags` (array, optional) — Array of tag names to assign.

### dub_list_domains
List all domains configured in the workspace.

**Parameters:**
- `page` (integer, optional) — Page number for pagination (default: 1).
- `pageSize` (integer, optional) — Number of results per page (default: 50).

### dub_get_domain
Get details of a specific domain by ID or slug.

**Parameters:**
- `id` (string, required) — The domain ID or slug.

### dub_list_tags
List link tags with pagination and search.

**Parameters:**
- `page` (integer, optional) — Page number for pagination (default: 1).
- `pageSize` (integer, optional) — Number of results per page (default: 50).
- `search` (string, optional) — Search query to filter tags by name.

### dub_get_current_user
Get the profile of the currently authenticated user.

**Parameters:** None.
