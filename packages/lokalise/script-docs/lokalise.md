# Lokalise Integration

## Tools

### lokalise_list_projects
List Lokalise projects.

**Parameters:**
- `limit` (integer, optional) — Maximum number of projects to return (default 25).
- `page` (integer, optional) — Page number for pagination (default 1).

### lokalise_get_project
Get details of a specific Lokalise project.

**Parameters:**
- `project_id` (string, required) — The project ID.

### lokalise_list_keys
List translation keys in a Lokalise project.

**Parameters:**
- `project_id` (string, required) — The project ID.
- `limit` (integer, optional) — Maximum number of keys to return (default 25).
- `page` (integer, optional) — Page number for pagination (default 1).

### lokalise_get_key
Get details of a specific translation key.

**Parameters:**
- `project_id` (string, required) — The project ID.
- `key_id` (integer, required) — The key ID.

### lokalise_create_key
Create a new translation key in a Lokalise project.

**Parameters:**
- `project_id` (string, required) — The project ID.
- `key_name` (string, required) — The key name (e.g. "app.welcome").
- `platforms` (array, optional) — List of platforms (e.g. ["web", "ios", "android"]).
- `translations` (object, optional) — Key-value map of language ISO codes to translation values (e.g. {"en": "Welcome", "fr": "Bienvenue"}).
- `description` (string, optional) — Description for the key.
- `tags` (array, optional) — List of tags to assign to the key.

### lokalise_list_translations
List translations in a Lokalise project.

**Parameters:**
- `project_id` (string, required) — The project ID.
- `limit` (integer, optional) — Maximum number of translations to return (default 25).
- `page` (integer, optional) — Page number for pagination (default 1).

### lokalise_get_current_user
Get the currently authenticated Lokalise user.

**Parameters:** None.
