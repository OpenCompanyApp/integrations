# Canva Integration

Namespace: `app.integrations.canva`.

This integration follows the official Canva Connect API operation names and response shapes. Use `payload` for JSON or form request bodies, `body` for binary upload endpoints, and top-level snake_case arguments for path, query, and required header parameters.

Default API base URL: `https://api.canva.com/rest`.

## Tools

### canva_get_app_jwks
Returns the Json Web Key Set (public keys) of an app.

- Method/path: `GET /v1/apps/{appId}/jwks`
- Auth: `none`
- Scopes: `none listed`
- Parameters: `app_id` required

### canva_delete_asset
You can delete an asset by specifying its assetId.

- Method/path: `DELETE /v1/assets/{assetId}`
- Auth: `bearer`
- Scopes: `asset:write`
- Parameters: `asset_id` required

### canva_get_asset
You can retrieve the metadata of an asset by specifying its assetId.

- Method/path: `GET /v1/assets/{assetId}`
- Auth: `bearer`
- Scopes: `asset:read`
- Parameters: `asset_id` required

### canva_update_asset
You can update the name and tags of an asset by specifying its assetId.

- Method/path: `PATCH /v1/assets/{assetId}`
- Auth: `bearer`
- Scopes: `asset:write`
- Parameters: `asset_id` required
- Body: `application/json` via `payload`

### canva_create_asset_upload_job
Starts a new to upload an asset to the user's content library.

- Method/path: `POST /v1/asset-uploads`
- Auth: `bearer`
- Scopes: `asset:write`
- Parameters: `asset_upload_metadata` required
- Body: `application/octet-stream` via `body` (required)

### canva_get_asset_upload_job
Get the result of an asset upload job that was created using the .

- Method/path: `GET /v1/asset-uploads/{jobId}`
- Auth: `bearer`
- Scopes: `asset:read`
- Parameters: `job_id` required

### canva_create_url_asset_upload_job
Execute the Canva create url asset upload job operation.

- Method/path: `POST /v1/url-asset-uploads`
- Auth: `bearer`
- Scopes: `asset:write`
- Parameters: none
- Body: `application/json` via `payload` (required)

### canva_get_url_asset_upload_job
Execute the Canva get url asset upload job operation.

- Method/path: `GET /v1/url-asset-uploads/{jobId}`
- Auth: `bearer`
- Scopes: `asset:read`
- Parameters: `job_id` required

### canva_create_design_autofill_job
Execute the Canva create design autofill job operation.

- Method/path: `POST /v1/autofills`
- Auth: `bearer`
- Scopes: `design:content:write`
- Parameters: none
- Body: `application/json` via `payload`

### canva_get_design_autofill_job
Execute the Canva get design autofill job operation.

- Method/path: `GET /v1/autofills/{jobId}`
- Auth: `bearer`
- Scopes: `design:meta:read`
- Parameters: `job_id` required

### canva_list_brand_templates
Execute the Canva list brand templates operation.

- Method/path: `GET /v1/brand-templates`
- Auth: `bearer`
- Scopes: `brandtemplate:meta:read`
- Parameters: `query`, `continuation`, `limit`, `ownership`, `sort_by`, `dataset`

### canva_get_brand_template
Execute the Canva get brand template operation.

- Method/path: `GET /v1/brand-templates/{brandTemplateId}`
- Auth: `bearer`
- Scopes: `brandtemplate:meta:read`
- Parameters: `brand_template_id` required

### canva_get_brand_template_dataset
Execute the Canva get brand template dataset operation.

- Method/path: `GET /v1/brand-templates/{brandTemplateId}/dataset`
- Auth: `bearer`
- Scopes: `brandtemplate:content:read`
- Parameters: `brand_template_id` required

### canva_create_comment
This API is deprecated, so you should use the API instead.

- Method/path: `POST /v1/comments`
- Auth: `bearer`
- Scopes: `comment:write`
- Parameters: none
- Body: `application/json` via `payload` (required)

### canva_create_reply_deprecated
This API is deprecated, so you should use the API instead.

- Method/path: `POST /v1/comments/{commentId}/replies`
- Auth: `bearer`
- Scopes: `comment:write`
- Parameters: `comment_id` required
- Body: `application/json` via `payload` (required)

### canva_list_replies
Execute the Canva list replies operation.

- Method/path: `GET /v1/designs/{designId}/comments/{threadId}/replies`
- Auth: `bearer`
- Scopes: `comment:read`
- Parameters: `design_id` required, `thread_id` required, `limit`, `continuation`

### canva_create_reply
Execute the Canva create reply operation.

- Method/path: `POST /v1/designs/{designId}/comments/{threadId}/replies`
- Auth: `bearer`
- Scopes: `comment:write`
- Parameters: `design_id` required, `thread_id` required
- Body: `application/json` via `payload` (required)

### canva_get_thread
Execute the Canva get thread operation.

- Method/path: `GET /v1/designs/{designId}/comments/{threadId}`
- Auth: `bearer`
- Scopes: `comment:read`
- Parameters: `design_id` required, `thread_id` required

### canva_get_reply
Execute the Canva get reply operation.

- Method/path: `GET /v1/designs/{designId}/comments/{threadId}/replies/{replyId}`
- Auth: `bearer`
- Scopes: `comment:read`
- Parameters: `design_id` required, `thread_id` required, `reply_id` required

### canva_create_thread
Execute the Canva create thread operation.

- Method/path: `POST /v1/designs/{designId}/comments`
- Auth: `bearer`
- Scopes: `comment:write`
- Parameters: `design_id` required
- Body: `application/json` via `payload` (required)

### canva_get_signing_public_keys
Execute the Canva get signing public keys operation.

- Method/path: `GET /v1/connect/keys`
- Auth: `none`
- Scopes: `none listed`
- Parameters: none

### canva_list_designs
Lists metadata for all the designs in a Canva user's .

- Method/path: `GET /v1/designs`
- Auth: `bearer`
- Scopes: `design:meta:read`
- Parameters: `query`, `continuation`, `ownership`, `sort_by`, `limit`

### canva_create_design
Creates a new Canva design.

- Method/path: `POST /v1/designs`
- Auth: `bearer`
- Scopes: `design:content:write`
- Parameters: none
- Body: `application/json` via `payload`

### canva_get_design
Gets the metadata for a design.

- Method/path: `GET /v1/designs/{designId}`
- Auth: `bearer`
- Scopes: `design:meta:read`
- Parameters: `design_id` required

### canva_get_design_pages
Execute the Canva get design pages operation.

- Method/path: `GET /v1/designs/{designId}/pages`
- Auth: `bearer`
- Scopes: `design:content:read`
- Parameters: `design_id` required, `offset`, `limit`

### canva_get_design_export_formats
Lists the available file formats for .

- Method/path: `GET /v1/designs/{designId}/export-formats`
- Auth: `bearer`
- Scopes: `design:content:read`
- Parameters: `design_id` required

### canva_create_design_import_job
Starts a new to import an external file as a new design in Canva.

- Method/path: `POST /v1/imports`
- Auth: `bearer`
- Scopes: `design:content:write`
- Parameters: `import_metadata` required
- Body: `application/octet-stream` via `body` (required)

### canva_get_design_import_job
Gets the result of a design import job created using the .

- Method/path: `GET /v1/imports/{jobId}`
- Auth: `bearer`
- Scopes: `design:content:write`
- Parameters: `job_id` required

### canva_create_url_import_job
Starts a new to import an external file from a URL as a new design in Canva.

- Method/path: `POST /v1/url-imports`
- Auth: `bearer`
- Scopes: `design:content:write`
- Parameters: none
- Body: `application/json` via `payload` (required)

### canva_get_url_import_job
Gets the result of a URL import job created using the .

- Method/path: `GET /v1/url-imports/{jobId}`
- Auth: `bearer`
- Scopes: `design:content:write`
- Parameters: `job_id` required

### canva_create_design_export_job
Starts a new to export a file from Canva.

- Method/path: `POST /v1/exports`
- Auth: `bearer`
- Scopes: `design:content:read`
- Parameters: none
- Body: `application/json` via `payload`

### canva_get_design_export_job
Gets the result of a design export job that was created using the .

- Method/path: `GET /v1/exports/{exportId}`
- Auth: `bearer`
- Scopes: `design:content:read`
- Parameters: `export_id` required

### canva_delete_folder
Deletes a folder with the specified folderID.

- Method/path: `DELETE /v1/folders/{folderId}`
- Auth: `bearer`
- Scopes: `folder:write`
- Parameters: `folder_id` required

### canva_get_folder
Gets the name and other details of a folder using a folder's folderID.

- Method/path: `GET /v1/folders/{folderId}`
- Auth: `bearer`
- Scopes: `folder:read`
- Parameters: `folder_id` required

### canva_update_folder
Updates a folder's details using its folderID.

- Method/path: `PATCH /v1/folders/{folderId}`
- Auth: `bearer`
- Scopes: `folder:write`
- Parameters: `folder_id` required
- Body: `application/json` via `payload` (required)

### canva_list_folder_items
Lists the items in a folder, including each item's type.

- Method/path: `GET /v1/folders/{folderId}/items`
- Auth: `bearer`
- Scopes: `folder:read`
- Parameters: `folder_id` required, `continuation`, `limit`, `item_types`, `sort_by`, `pin_status`

### canva_move_folder_item
Moves an item to another folder.

- Method/path: `POST /v1/folders/move`
- Auth: `bearer`
- Scopes: `folder:write`
- Parameters: none
- Body: `application/json` via `payload`

### canva_create_folder
Creates a folder in one of the following locations: - The top level of a Canva user's (using the ID root), - The user's Uploads folder (using the ID uploads), - Another folder (using the parent folder's ID).

- Method/path: `POST /v1/folders`
- Auth: `bearer`
- Scopes: `folder:write`
- Parameters: none
- Body: `application/json` via `payload` (required)

### canva_exchange_access_token
This endpoint implements the OAuth 2.0 token endpoint, as part of the Authorization Code flow with Proof Key for Code Exchange (PKCE).

- Method/path: `POST /v1/oauth/token`
- Auth: `basic_or_body`
- Scopes: `none listed`
- Parameters: none
- Body: `application/x-www-form-urlencoded` via `payload` (required)

### canva_introspect_token
Introspect an access token to see whether it is valid and active.

- Method/path: `POST /v1/oauth/introspect`
- Auth: `basic_or_body`
- Scopes: `none listed`
- Parameters: none
- Body: `application/x-www-form-urlencoded` via `payload` (required)

### canva_revoke_tokens
Revoke an access token or a refresh token.

- Method/path: `POST /v1/oauth/revoke`
- Auth: `basic_or_body`
- Scopes: `none listed`
- Parameters: none
- Body: `application/x-www-form-urlencoded` via `payload` (required)

### canva_get_oidc_jwks
Gets the JSON Web Key Set (public keys) for OIDC.

- Method/path: `GET /v1/oidc/jwks`
- Auth: `none`
- Scopes: `none listed`
- Parameters: none

### canva_get_oidc_user_info
Fetches the current UserInfo claims for the authorized user.

- Method/path: `GET /v1/oidc/userinfo`
- Auth: `bearer`
- Scopes: `openid, profile, email`
- Parameters: none

### canva_create_design_resize_job
Execute the Canva create design resize job operation.

- Method/path: `POST /v1/resizes`
- Auth: `bearer`
- Scopes: `design:content:read, design:content:write`
- Parameters: none
- Body: `application/json` via `payload`

### canva_get_design_resize_job
Execute the Canva get design resize job operation.

- Method/path: `GET /v1/resizes/{jobId}`
- Auth: `bearer`
- Scopes: `design:content:read, design:content:write`
- Parameters: `job_id` required

### canva_get_current_user
Returns the User ID and Team ID of the user account associated with the provided access token.

- Method/path: `GET /v1/users/me`
- Auth: `bearer`
- Scopes: `none listed`
- Parameters: none

### canva_get_user_capabilities
Lists the API capabilities for the user account associated with the provided access token.

- Method/path: `GET /v1/users/me/capabilities`
- Auth: `bearer`
- Scopes: `profile:read`
- Parameters: none

### canva_get_user_profile
Currently, this returns the display name of the user account associated with the provided access token.

- Method/path: `GET /v1/users/me/profile`
- Auth: `bearer`
- Scopes: `profile:read`
- Parameters: none

## Example

```lua
local designs = app.integrations.canva.list_designs({
  limit = 10,
  query = "quarterly report"
})

local export = app.integrations.canva.create_design_export_job({
  payload = {
    design_id = "DAFexample",
    format = { type = "pdf" }
  }
})
```