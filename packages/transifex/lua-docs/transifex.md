# Transifex Integration

## Tools

### transifex_list_projects
List all Transifex projects.

**Parameters:** None.

### transifex_get_project
Get details of a specific Transifex project.

**Parameters:**
- `project_id` (string, required) — The project slug or ID.

### transifex_list_resources
List all resources (source files) in a Transifex project.

**Parameters:**
- `project_id` (string, required) — The project slug or ID.

### transifex_get_resource
Get details of a specific Transifex resource.

**Parameters:**
- `project_id` (string, required) — The project slug or ID.
- `resource_id` (string, required) — The resource slug or ID.

### transifex_list_translations
List translations for a specific resource in a Transifex project.

**Parameters:**
- `project_id` (string, required) — The project slug or ID.
- `resource_id` (string, required) — The resource slug or ID.
- `lang_code` (string, optional) — Language code to filter translations (e.g., "fr", "de", "ja").

### transifex_list_languages
List all languages configured for a Transifex project.

**Parameters:**
- `project_id` (string, required) — The project slug or ID.

### transifex_get_current_user
Get information about the currently authenticated Transifex user.

**Parameters:** None.
