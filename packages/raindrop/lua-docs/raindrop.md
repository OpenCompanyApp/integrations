# Raindrop.io Integration

Namespace: `app.integrations.raindrop`.

This integration follows the official Raindrop.io REST API documentation. Use top-level snake_case arguments for path parameters, `query` for query-string filters, and `payload` for JSON or multipart request bodies.

### raindrop_backups_download_file
Download file.

- Method/path: `GET /backup/{ID}.{format}`
- Parameters: `id`, `format`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_backups_generate_new
Generate new.

- Method/path: `GET /backup`
- Parameters: none
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_backups_get_all
Get all.

- Method/path: `GET /backups`
- Parameters: none
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_collections_create_collection
Create collection.

- Method/path: `POST /collection`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_empty_trash
Empty Trash.

- Method/path: `DELETE /collection/-99`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_expand_collapse_all
Expand/collapse all collections.

- Method/path: `PUT /collections`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_get_child_collections
Get child collections.

- Method/path: `GET /collections/childrens`
- Parameters: none
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_collections_get_collection
Get collection.

- Method/path: `GET /collection/{id}`
- Parameters: `id`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_collections_get_root_collections
Get root collections.

- Method/path: `GET /collections`
- Parameters: none
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_collections_get_system_collections_count
Get system collections count.

- Method/path: `GET /user/stats`
- Parameters: none
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_collections_merge_collections
Merge collections.

- Method/path: `PUT /collections/merge`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_remove_all_empty_collections
Remove all empty collections.

- Method/path: `PUT /collections/clean`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_remove_collection
Remove collection.

- Method/path: `DELETE /collection/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_remove_multiple_collections
Remove multiple collections.

- Method/path: `DELETE /collections`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_reorder_all
Reorder all collections.

- Method/path: `PUT /collections`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_update_collection
Update collection.

- Method/path: `PUT /collection/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_collections_upload_cover
Upload cover.

- Method/path: `PUT /collection/{id}/cover`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `multipart/form-data`

### raindrop_export_export_in_format
Export in format.

- Method/path: `GET /raindrops/{collectionId}/export.{format}`
- Parameters: `collection_id`, `format`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_filters_get_filters
Get filters.

- Method/path: `GET /filters/{collectionId}`
- Parameters: `collection_id`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_highlights_add
Add highlight.

- Method/path: `PUT /raindrop/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_highlights_get_all_highlights
Get all highlights.

- Method/path: `GET /highlights`
- Parameters: none
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_highlights_get_all_highlights_in_a_collection
Get all highlights in a collection.

- Method/path: `GET /highlights/{collectionId}`
- Parameters: `collection_id`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_highlights_get_raindrop_highlights
Get highlights of raindrop.

- Method/path: `GET /raindrop/{id}`
- Parameters: `id`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_highlights_remove
Remove highlight.

- Method/path: `PUT /raindrop/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_highlights_update
Update highlight.

- Method/path: `PUT /raindrop/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_import_check_url_s_existence
Check URL(s) existence.

- Method/path: `POST /import/url/exists`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_import_parse_html_import_file
Parse HTML import file.

- Method/path: `POST /import/file`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `multipart/form-data`

### raindrop_import_parse_url
Parse URL.

- Method/path: `GET /import/url/parse`
- Parameters: none
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_raindrops_multiple_create_many_raindrops
Create many raindrops.

- Method/path: `POST /raindrops`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_raindrops_multiple_get_raindrops
Get raindrops.

- Method/path: `GET /raindrops/{collectionId}`
- Parameters: `collection_id`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_raindrops_multiple_remove_many_raindrops
Remove many raindrops.

- Method/path: `DELETE /raindrops/{collectionId}`
- Parameters: `collection_id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_raindrops_multiple_update_many_raindrops
Update many raindrops.

- Method/path: `PUT /raindrops/{collectionId}`
- Parameters: `collection_id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_raindrops_single_create_raindrop
Create raindrop.

- Method/path: `POST /raindrop`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_raindrops_single_get_permanent_copy
Get permanent copy.

- Method/path: `GET /raindrop/{id}/cache`
- Parameters: `id`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_raindrops_single_get_raindrop
Get raindrop.

- Method/path: `GET /raindrop/{id}`
- Parameters: `id`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_raindrops_single_remove_raindrop
Remove raindrop.

- Method/path: `DELETE /raindrop/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_raindrops_single_suggest_collection_and_tags_for_existing_bookmark
Suggest collection and tags for existing bookmark.

- Method/path: `GET /raindrop/{id}/suggest`
- Parameters: `id`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_raindrops_single_suggest_collection_and_tags_for_new_bookmark
Suggest collection and tags for new bookmark.

- Method/path: `POST /raindrop/suggest`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_raindrops_single_update_raindrop
Update raindrop.

- Method/path: `PUT /raindrop/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_raindrops_single_upload_cover
Upload cover.

- Method/path: `PUT /raindrop/{id}/cover`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object
- Content type: `multipart/form-data`

### raindrop_raindrops_single_upload_file
Upload file.

- Method/path: `PUT /raindrop/file`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `multipart/form-data`

### raindrop_tags_get_tags
Get tags.

- Method/path: `GET /tags/{collectionId}`
- Parameters: `collection_id` (optional)
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_tags_merge
Merge tags.

- Method/path: `PUT /tags/{collectionId}`
- Parameters: `collection_id` (optional)
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_tags_remove
Remove tag(s).

- Method/path: `DELETE /tags/{collectionId}`
- Parameters: `collection_id` (optional)
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_tags_rename
Rename tag.

- Method/path: `PUT /tags/{collectionId}`
- Parameters: `collection_id` (optional)
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

### raindrop_user_authenticated_connect_social_network_account
Connect social network account.

- Method/path: `GET /user/connect/{provider}`
- Parameters: `provider`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_user_authenticated_disconnect_social_network_account
Disconnect social network account.

- Method/path: `GET /user/connect/{provider}/revoke`
- Parameters: `provider`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_user_authenticated_get_user
Get user.

- Method/path: `GET /user`
- Parameters: none
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_user_authenticated_get_user_by_name
Get user by name.

- Method/path: `GET /user/{name}`
- Parameters: `name`
- Query: `query` object
- Body: none
- Content type: `application/json response only`

### raindrop_user_authenticated_update_user
Update user.

- Method/path: `PUT /user`
- Parameters: none
- Query: `query` object
- Body: `payload` object
- Content type: `application/json`

## Examples

```lua
local bookmarks = app.integrations.raindrop.raindrops_multiple_get_raindrops({ collection_id = 0, query = { perpage = 25 } })
local created = app.integrations.raindrop.raindrops_single_create_raindrop({ payload = { link = 'https://example.test', title = 'Example' } })
```