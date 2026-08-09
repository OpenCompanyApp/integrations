# Google Drive

Google Drive tools are exposed under `app.integrations.google_drive`. This package is generated from Google's official Drive API v3 Discovery document and exposes 64 REST methods.

## Coverage

- Source: `https://www.googleapis.com/discovery/v1/apis/drive/v3/rest`
- Read tools: 28
- Write tools: 36
- Media upload tools: 2
- Media download-capable tools: 3
- Base URL: `https://www.googleapis.com`

## Usage Notes

Pass IDs such as `fileId`, `driveId`, `commentId`, `replyId`, `permissionId`, `revisionId`, or `approvalId` as top-level arguments. Query parameters can be passed as top-level shortcuts or inside `query`. Request bodies go inside `body`. Upload endpoints accept `file_path`, optional `mime_type`, and optional Drive metadata in `body`; the integration sends multipart upload requests with `uploadType=multipart`.

For media downloads, pass `alt = "media" where Google documents media download support. Raw binary responses are returned as `{ body = ..., status = ... }` if they are not JSON.

## Tools

- `google_drive_approvals_list` - GET /drive/v3/files/{fileId}/approvals
- `google_drive_approvals_decline` - POST /drive/v3/files/{fileId}/approvals/{approvalId}:decline
- `google_drive_approvals_get` - GET /drive/v3/files/{fileId}/approvals/{approvalId}
- `google_drive_approvals_start` - POST /drive/v3/files/{fileId}/approvals:start
- `google_drive_approvals_cancel` - POST /drive/v3/files/{fileId}/approvals/{approvalId}:cancel
- `google_drive_approvals_approve` - POST /drive/v3/files/{fileId}/approvals/{approvalId}:approve
- `google_drive_approvals_comment` - POST /drive/v3/files/{fileId}/approvals/{approvalId}:comment
- `google_drive_approvals_reassign` - POST /drive/v3/files/{fileId}/approvals/{approvalId}:reassign
- `google_drive_comments_list` - GET /drive/v3/files/{fileId}/comments
- `google_drive_comments_update` - PATCH /drive/v3/files/{fileId}/comments/{commentId}
- `google_drive_comments_delete` - DELETE /drive/v3/files/{fileId}/comments/{commentId}
- `google_drive_comments_create` - POST /drive/v3/files/{fileId}/comments
- `google_drive_comments_get` - GET /drive/v3/files/{fileId}/comments/{commentId}
- `google_drive_files_modify_labels` - POST /drive/v3/files/{fileId}/modifyLabels
- `google_drive_files_delete` - DELETE /drive/v3/files/{fileId}
- `google_drive_files_create` - POST /drive/v3/files (media upload)
- `google_drive_files_generate_cse_token` - GET /drive/v3/files/generateCseToken
- `google_drive_files_watch` - POST /drive/v3/files/{fileId}/watch
- `google_drive_files_list` - GET /drive/v3/files
- `google_drive_files_list_labels` - GET /drive/v3/files/{fileId}/listLabels
- `google_drive_files_update` - PATCH /drive/v3/files/{fileId} (media upload)
- `google_drive_files_download` - POST /drive/v3/files/{fileId}/download
- `google_drive_files_generate_ids` - GET /drive/v3/files/generateIds
- `google_drive_files_export` - GET /drive/v3/files/{fileId}/export (media download)
- `google_drive_files_get` - GET /drive/v3/files/{fileId} (media download)
- `google_drive_files_copy` - POST /drive/v3/files/{fileId}/copy
- `google_drive_files_empty_trash` - DELETE /drive/v3/files/trash
- `google_drive_about_get` - GET /drive/v3/about
- `google_drive_channels_stop` - POST /drive/v3/channels/stop
- `google_drive_permissions_delete` - DELETE /drive/v3/files/{fileId}/permissions/{permissionId}
- `google_drive_permissions_list` - GET /drive/v3/files/{fileId}/permissions
- `google_drive_permissions_update` - PATCH /drive/v3/files/{fileId}/permissions/{permissionId}
- `google_drive_permissions_create` - POST /drive/v3/files/{fileId}/permissions
- `google_drive_permissions_get` - GET /drive/v3/files/{fileId}/permissions/{permissionId}
- `google_drive_apps_list` - GET /drive/v3/apps
- `google_drive_apps_get` - GET /drive/v3/apps/{appId}
- `google_drive_accessproposals_resolve` - POST /drive/v3/files/{fileId}/accessproposals/{proposalId}:resolve
- `google_drive_accessproposals_list` - GET /drive/v3/files/{fileId}/accessproposals
- `google_drive_accessproposals_get` - GET /drive/v3/files/{fileId}/accessproposals/{proposalId}
- `google_drive_operations_get` - GET /drive/v3/operations/{name}
- `google_drive_revisions_get` - GET /drive/v3/files/{fileId}/revisions/{revisionId} (media download)
- `google_drive_revisions_delete` - DELETE /drive/v3/files/{fileId}/revisions/{revisionId}
- `google_drive_revisions_list` - GET /drive/v3/files/{fileId}/revisions
- `google_drive_revisions_update` - PATCH /drive/v3/files/{fileId}/revisions/{revisionId}
- `google_drive_teamdrives_delete` - DELETE /drive/v3/teamdrives/{teamDriveId}
- `google_drive_teamdrives_list` - GET /drive/v3/teamdrives
- `google_drive_teamdrives_update` - PATCH /drive/v3/teamdrives/{teamDriveId}
- `google_drive_teamdrives_create` - POST /drive/v3/teamdrives
- `google_drive_teamdrives_get` - GET /drive/v3/teamdrives/{teamDriveId}
- `google_drive_changes_list` - GET /drive/v3/changes
- `google_drive_changes_get_start_page_token` - GET /drive/v3/changes/startPageToken
- `google_drive_changes_watch` - POST /drive/v3/changes/watch
- `google_drive_replies_create` - POST /drive/v3/files/{fileId}/comments/{commentId}/replies
- `google_drive_replies_get` - GET /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}
- `google_drive_replies_list` - GET /drive/v3/files/{fileId}/comments/{commentId}/replies
- `google_drive_replies_update` - PATCH /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}
- `google_drive_replies_delete` - DELETE /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}
- `google_drive_drives_create` - POST /drive/v3/drives
- `google_drive_drives_get` - GET /drive/v3/drives/{driveId}
- `google_drive_drives_hide` - POST /drive/v3/drives/{driveId}/hide
- `google_drive_drives_delete` - DELETE /drive/v3/drives/{driveId}
- `google_drive_drives_unhide` - POST /drive/v3/drives/{driveId}/unhide
- `google_drive_drives_list` - GET /drive/v3/drives
- `google_drive_drives_update` - PATCH /drive/v3/drives/{driveId}

## Examples

```js
var files = app.integrations.google_drive.google_drive_files_list({ pageSize: 10, q: "trashed = false" })

var uploaded = app.integrations.google_drive.google_drive_files_create({
  file_path: "/tmp/report.pdf",
  mime_type: "application/pdf",
  body: { name: "report.pdf" },
})
```
Responses are decoded Google Drive JSON responses, or `{ success = true, status = ... }` for successful empty responses.
