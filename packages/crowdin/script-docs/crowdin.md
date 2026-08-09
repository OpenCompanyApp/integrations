# Crowdin Integration

## Tools

### crowdin_list_projects
List Crowdin projects.

**Parameters:**
- `group_id` (integer, optional) — Filter projects by group ID.
- `limit` (integer, optional) — Maximum number of projects to return (max 500, default 25).
- `offset` (integer, optional) — Pagination offset (default 0).

### crowdin_get_project
Get details of a specific project.

**Parameters:**
- `project_id` (integer, required) — The project ID.

### crowdin_list_strings
List source strings in a project.

**Parameters:**
- `project_id` (integer, required) — The project ID.
- `file_id` (integer, optional) — Filter by file ID.
- `branch_id` (integer, optional) — Filter by branch ID.
- `limit` (integer, optional) — Maximum number of strings to return (default 25).
- `offset` (integer, optional) — Pagination offset (default 0).

### crowdin_get_string
Get details of a specific source string.

**Parameters:**
- `project_id` (integer, required) — The project ID.
- `string_id` (integer, required) — The string ID.

### crowdin_list_translations
List translations in a project.

**Parameters:**
- `project_id` (integer, required) — The project ID.
- `string_id` (integer, optional) — Filter by source string ID.
- `language_id` (integer, optional) — Filter by language ID.
- `limit` (integer, optional) — Maximum number of translations to return (default 25).
- `offset` (integer, optional) — Pagination offset (default 0).

### crowdin_list_languages
List supported languages.

**Parameters:**
- `limit` (integer, optional) — Maximum number of languages to return (default 25).
- `offset` (integer, optional) — Pagination offset (default 0).

### crowdin_get_current_user
Get the currently authenticated user.

**Parameters:** None.
