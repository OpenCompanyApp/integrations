# Shortcut Integration

Namespace: `shortcut`

This integration exposes Shortcut REST API v3 operations as endpoint-specific tools. It was generated from the official Swagger file at `https://developer.shortcut.com/api/rest/v3/shortcut.swagger.json` and uses the documented `Shortcut-Token` header authentication against `https://api.app.shortcut.com`.

Use list/search endpoints first to discover public IDs, then pass those IDs to get, update, delete, or link operations. Path placeholders from the API such as `story-public-id` are exposed as snake_case tool parameters such as `story_public_id`. JSON request bodies are passed through the `body` object. The file upload endpoint uses multipart fields and expects local file paths for `file0`, `file1`, `file2`, and `file3`.

## Coverage

- Official paths: 86
- Official operations: 144
- Read operations: 71
- Write operations: 73

## Examples

```js
var stories = shortcut.shortcut_search_stories({
  body: { query: "state:unstarted owner:me" },
})

var story = shortcut.shortcut_get_story({ story_public_id: 123 })

var created = shortcut.shortcut_create_story({
  body: { name: "Draft integration docs", workflow_state_id: 500000001 },
})
```
## Common Tools

- `shortcut_list_categories` - GET /api/v3/categories
- `shortcut_create_category` - POST /api/v3/categories
- `shortcut_get_category` - GET /api/v3/categories/{category-public-id}
- `shortcut_update_category` - PUT /api/v3/categories/{category-public-id}
- `shortcut_delete_category` - DELETE /api/v3/categories/{category-public-id}
- `shortcut_list_category_milestones` - GET /api/v3/categories/{category-public-id}/milestones
- `shortcut_list_category_objectives` - GET /api/v3/categories/{category-public-id}/objectives
- `shortcut_list_custom_fields` - GET /api/v3/custom-fields
- `shortcut_get_custom_field` - GET /api/v3/custom-fields/{custom-field-public-id}
- `shortcut_update_custom_field` - PUT /api/v3/custom-fields/{custom-field-public-id}
- `shortcut_delete_custom_field` - DELETE /api/v3/custom-fields/{custom-field-public-id}
- `shortcut_list_docs` - GET /api/v3/documents
- `shortcut_create_doc` - POST /api/v3/documents
- `shortcut_get_doc` - GET /api/v3/documents/{doc-public-id}
- `shortcut_update_doc` - PUT /api/v3/documents/{doc-public-id}
- `shortcut_delete_doc` - DELETE /api/v3/documents/{doc-public-id}
- `shortcut_list_document_epics` - GET /api/v3/documents/{doc-public-id}/epics
- `shortcut_link_document_to_epic` - PUT /api/v3/documents/{doc-public-id}/epics/{epic-public-id}
- `shortcut_unlink_document_from_epic` - DELETE /api/v3/documents/{doc-public-id}/epics/{epic-public-id}
- `shortcut_load_tiptap_document_json` - GET /api/v3/documents/{doc-public-id}/tiptap-load
- `shortcut_list_entity_templates` - GET /api/v3/entity-templates
- `shortcut_create_entity_template` - POST /api/v3/entity-templates
- `shortcut_disable_story_templates` - PUT /api/v3/entity-templates/disable
- `shortcut_enable_story_templates` - PUT /api/v3/entity-templates/enable
- `shortcut_get_entity_template` - GET /api/v3/entity-templates/{entity-template-public-id}
- `shortcut_update_entity_template` - PUT /api/v3/entity-templates/{entity-template-public-id}
- `shortcut_delete_entity_template` - DELETE /api/v3/entity-templates/{entity-template-public-id}
- `shortcut_get_epic_workflow` - GET /api/v3/epic-workflow
- `shortcut_list_epics` - GET /api/v3/epics
- `shortcut_create_epic` - POST /api/v3/epics

All examples use fake IDs and safe placeholder values. Real API tokens should be configured through the host credential resolver, not hard-coded in JavaScript.
