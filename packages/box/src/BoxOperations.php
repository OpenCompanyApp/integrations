<?php

namespace OpenCompany\Integrations\Box;

/**
 * Official Box OpenAPI operation metadata.
 *
 * Source: https://raw.githubusercontent.com/box/box-openapi/main/openapi.json.
 */
class BoxOperations
{
    /**
     * Return all supported Box API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
  0 =>
  [
    'operation' => 'get_authorize',
    'slug' => 'box_get_authorize',
    'class' => 'BoxGetAuthorize',
    'method' => 'GET',
    'path' => '/authorize',
    'name' => 'Authorize user',
    'description' => 'Execute official Box API operation `get_authorize`.

Endpoint: GET /authorize.',
    'type' => 'read',
    'tag' => 'Authorization',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'response_type',
        'param' => 'response_type',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of response we\'d like to receive.',
      ],
      1 =>
      [
        'name' => 'client_id',
        'param' => 'client_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The Client ID of the application that is requesting to authenticate the user. To get the Client ID for your application, log in to your Box developer console and click the **Edi...',
      ],
      2 =>
      [
        'name' => 'redirect_uri',
        'param' => 'redirect_uri',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The URI to which Box redirects the browser after the user has granted or denied the application permission. This URI match one of the redirect URIs in the configuration of your...',
      ],
      3 =>
      [
        'name' => 'state',
        'param' => 'state',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A custom string of your choice. Box will pass the same string to the redirect URL when authentication is complete. This parameter can be used to identify a user on redirect, as...',
      ],
      4 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A space-separated list of application scopes you\'d like to authenticate the user for. This defaults to all the scopes configured for the application in its configuration page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  1 =>
  [
    'operation' => 'post_oauth2_token',
    'slug' => 'box_post_oauth2_token',
    'class' => 'BoxPostOauth2Token',
    'method' => 'POST',
    'path' => '/oauth2/token',
    'name' => 'Request access token',
    'description' => 'Execute official Box API operation `post_oauth2_token`.

Endpoint: POST /oauth2/token.',
    'type' => 'write',
    'tag' => 'Authorization',
    'base' => 'api',
    'body_content_type' => 'application/x-www-form-urlencoded',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  2 =>
  [
    'operation' => 'post_oauth2_token#refresh',
    'slug' => 'box_post_oauth2_token_refresh',
    'class' => 'BoxPostOauth2TokenRefresh',
    'method' => 'POST',
    'path' => '/oauth2/token#refresh',
    'name' => 'Refresh access token',
    'description' => 'Execute official Box API operation `post_oauth2_token#refresh`.

Endpoint: POST /oauth2/token#refresh.',
    'type' => 'write',
    'tag' => 'Authorization',
    'base' => 'api',
    'body_content_type' => 'application/x-www-form-urlencoded',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  3 =>
  [
    'operation' => 'post_oauth2_revoke',
    'slug' => 'box_post_oauth2_revoke',
    'class' => 'BoxPostOauth2Revoke',
    'method' => 'POST',
    'path' => '/oauth2/revoke',
    'name' => 'Revoke access token',
    'description' => 'Execute official Box API operation `post_oauth2_revoke`.

Endpoint: POST /oauth2/revoke.',
    'type' => 'write',
    'tag' => 'Authorization',
    'base' => 'api',
    'body_content_type' => 'application/x-www-form-urlencoded',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  4 =>
  [
    'operation' => 'get_files_id',
    'slug' => 'box_get_files_id',
    'class' => 'BoxGetFilesId',
    'method' => 'GET',
    'path' => '/files/{file_id}',
    'name' => 'Get file information',
    'description' => 'Execute official Box API operation `get_files_id`.

Endpoint: GET /files/{file_id}.',
    'type' => 'read',
    'tag' => 'Files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  5 =>
  [
    'operation' => 'post_files_id',
    'slug' => 'box_post_files_id',
    'class' => 'BoxPostFilesId',
    'method' => 'POST',
    'path' => '/files/{file_id}',
    'name' => 'Restore file',
    'description' => 'Execute official Box API operation `post_files_id`.

Endpoint: POST /files/{file_id}.',
    'type' => 'write',
    'tag' => 'Trashed files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  6 =>
  [
    'operation' => 'put_files_id',
    'slug' => 'box_put_files_id',
    'class' => 'BoxPutFilesId',
    'method' => 'PUT',
    'path' => '/files/{file_id}',
    'name' => 'Update file',
    'description' => 'Execute official Box API operation `put_files_id`.

Endpoint: PUT /files/{file_id}.',
    'type' => 'write',
    'tag' => 'Files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  7 =>
  [
    'operation' => 'delete_files_id',
    'slug' => 'box_delete_files_id',
    'class' => 'BoxDeleteFilesId',
    'method' => 'DELETE',
    'path' => '/files/{file_id}',
    'name' => 'Delete file',
    'description' => 'Execute official Box API operation `delete_files_id`.

Endpoint: DELETE /files/{file_id}.',
    'type' => 'write',
    'tag' => 'Files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  8 =>
  [
    'operation' => 'get_files_id_app_item_associations',
    'slug' => 'box_get_files_id_app_item_associations',
    'class' => 'BoxGetFilesIdAppItemAssociations',
    'method' => 'GET',
    'path' => '/files/{file_id}/app_item_associations',
    'name' => 'List file app item associations',
    'description' => 'Execute official Box API operation `get_files_id_app_item_associations`.

Endpoint: GET /files/{file_id}/app_item_associations.',
    'type' => 'read',
    'tag' => 'App item associations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      3 =>
      [
        'name' => 'application_type',
        'param' => 'application_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If given, only return app items for this application type.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  9 =>
  [
    'operation' => 'get_files_id_content',
    'slug' => 'box_get_files_id_content',
    'class' => 'BoxGetFilesIdContent',
    'method' => 'GET',
    'path' => '/files/{file_id}/content',
    'name' => 'Download file',
    'description' => 'Execute official Box API operation `get_files_id_content`.

Endpoint: GET /files/{file_id}/content.',
    'type' => 'read',
    'tag' => 'Downloads',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'version',
        'param' => 'version',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The file version to download.',
      ],
      2 =>
      [
        'name' => 'access_token',
        'param' => 'access_token',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'An optional access token that can be used to pre-authenticate this request, which means that a download link can be shared with a browser or a third party service without them n...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  10 =>
  [
    'operation' => 'post_files_id_content',
    'slug' => 'box_post_files_id_content',
    'class' => 'BoxPostFilesIdContent',
    'method' => 'POST',
    'path' => '/files/{file_id}/content',
    'name' => 'Upload file version',
    'description' => 'Execute official Box API operation `post_files_id_content`.

Endpoint: POST /files/{file_id}/content.',
    'type' => 'write',
    'tag' => 'Uploads',
    'base' => 'upload',
    'body_content_type' => 'multipart/form-data',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  11 =>
  [
    'operation' => 'post_files_content',
    'slug' => 'box_post_files_content',
    'class' => 'BoxPostFilesContent',
    'method' => 'POST',
    'path' => '/files/content',
    'name' => 'Upload file',
    'description' => 'Execute official Box API operation `post_files_content`.

Endpoint: POST /files/content.',
    'type' => 'write',
    'tag' => 'Uploads',
    'base' => 'upload',
    'body_content_type' => 'multipart/form-data',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  12 =>
  [
    'operation' => 'post_files_upload_sessions',
    'slug' => 'box_post_files_upload_sessions',
    'class' => 'BoxPostFilesUploadSessions',
    'method' => 'POST',
    'path' => '/files/upload_sessions',
    'name' => 'Create upload session',
    'description' => 'Execute official Box API operation `post_files_upload_sessions`.

Endpoint: POST /files/upload_sessions.',
    'type' => 'write',
    'tag' => 'Uploads (Chunked)',
    'base' => 'upload',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  13 =>
  [
    'operation' => 'post_files_id_upload_sessions',
    'slug' => 'box_post_files_id_upload_sessions',
    'class' => 'BoxPostFilesIdUploadSessions',
    'method' => 'POST',
    'path' => '/files/{file_id}/upload_sessions',
    'name' => 'Create upload session for existing file',
    'description' => 'Execute official Box API operation `post_files_id_upload_sessions`.

Endpoint: POST /files/{file_id}/upload_sessions.',
    'type' => 'write',
    'tag' => 'Uploads (Chunked)',
    'base' => 'upload',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  14 =>
  [
    'operation' => 'get_files_upload_sessions_id',
    'slug' => 'box_get_files_upload_sessions_id',
    'class' => 'BoxGetFilesUploadSessionsId',
    'method' => 'GET',
    'path' => '/files/upload_sessions/{upload_session_id}',
    'name' => 'Get upload session',
    'description' => 'Execute official Box API operation `get_files_upload_sessions_id`.

Endpoint: GET /files/upload_sessions/{upload_session_id}.',
    'type' => 'read',
    'tag' => 'Uploads (Chunked)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'upload_session_id',
        'param' => 'upload_session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the upload session.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  15 =>
  [
    'operation' => 'put_files_upload_sessions_id',
    'slug' => 'box_put_files_upload_sessions_id',
    'class' => 'BoxPutFilesUploadSessionsId',
    'method' => 'PUT',
    'path' => '/files/upload_sessions/{upload_session_id}',
    'name' => 'Upload part of file',
    'description' => 'Execute official Box API operation `put_files_upload_sessions_id`.

Endpoint: PUT /files/upload_sessions/{upload_session_id}.',
    'type' => 'write',
    'tag' => 'Uploads (Chunked)',
    'base' => 'api',
    'body_content_type' => 'application/octet-stream',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'upload_session_id',
        'param' => 'upload_session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the upload session.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  16 =>
  [
    'operation' => 'delete_files_upload_sessions_id',
    'slug' => 'box_delete_files_upload_sessions_id',
    'class' => 'BoxDeleteFilesUploadSessionsId',
    'method' => 'DELETE',
    'path' => '/files/upload_sessions/{upload_session_id}',
    'name' => 'Remove upload session',
    'description' => 'Execute official Box API operation `delete_files_upload_sessions_id`.

Endpoint: DELETE /files/upload_sessions/{upload_session_id}.',
    'type' => 'write',
    'tag' => 'Uploads (Chunked)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'upload_session_id',
        'param' => 'upload_session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the upload session.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  17 =>
  [
    'operation' => 'get_files_upload_sessions_id_parts',
    'slug' => 'box_get_files_upload_sessions_id_parts',
    'class' => 'BoxGetFilesUploadSessionsIdParts',
    'method' => 'GET',
    'path' => '/files/upload_sessions/{upload_session_id}/parts',
    'name' => 'List parts',
    'description' => 'Execute official Box API operation `get_files_upload_sessions_id_parts`.

Endpoint: GET /files/upload_sessions/{upload_session_id}/parts.',
    'type' => 'read',
    'tag' => 'Uploads (Chunked)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'upload_session_id',
        'param' => 'upload_session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the upload session.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  18 =>
  [
    'operation' => 'post_files_upload_sessions_id_commit',
    'slug' => 'box_post_files_upload_sessions_id_commit',
    'class' => 'BoxPostFilesUploadSessionsIdCommit',
    'method' => 'POST',
    'path' => '/files/upload_sessions/{upload_session_id}/commit',
    'name' => 'Commit upload session',
    'description' => 'Execute official Box API operation `post_files_upload_sessions_id_commit`.

Endpoint: POST /files/upload_sessions/{upload_session_id}/commit.',
    'type' => 'write',
    'tag' => 'Uploads (Chunked)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'upload_session_id',
        'param' => 'upload_session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the upload session.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  19 =>
  [
    'operation' => 'post_files_id_copy',
    'slug' => 'box_post_files_id_copy',
    'class' => 'BoxPostFilesIdCopy',
    'method' => 'POST',
    'path' => '/files/{file_id}/copy',
    'name' => 'Copy file',
    'description' => 'Execute official Box API operation `post_files_id_copy`.

Endpoint: POST /files/{file_id}/copy.',
    'type' => 'write',
    'tag' => 'Files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  20 =>
  [
    'operation' => 'get_files_id_thumbnail_id',
    'slug' => 'box_get_files_id_thumbnail_id',
    'class' => 'BoxGetFilesIdThumbnailId',
    'method' => 'GET',
    'path' => '/files/{file_id}/thumbnail.{extension}',
    'name' => 'Get file thumbnail',
    'description' => 'Execute official Box API operation `get_files_id_thumbnail_id`.

Endpoint: GET /files/{file_id}/thumbnail.{extension}.',
    'type' => 'read',
    'tag' => 'Files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'extension',
        'param' => 'extension',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The file format for the thumbnail.',
      ],
      2 =>
      [
        'name' => 'min_height',
        'param' => 'min_height',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The minimum height of the thumbnail.',
      ],
      3 =>
      [
        'name' => 'min_width',
        'param' => 'min_width',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The minimum width of the thumbnail.',
      ],
      4 =>
      [
        'name' => 'max_height',
        'param' => 'max_height',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum height of the thumbnail.',
      ],
      5 =>
      [
        'name' => 'max_width',
        'param' => 'max_width',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum width of the thumbnail.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  21 =>
  [
    'operation' => 'get_files_id_collaborations',
    'slug' => 'box_get_files_id_collaborations',
    'class' => 'BoxGetFilesIdCollaborations',
    'method' => 'GET',
    'path' => '/files/{file_id}/collaborations',
    'name' => 'List file collaborations',
    'description' => 'Execute official Box API operation `get_files_id_collaborations`.

Endpoint: GET /files/{file_id}/collaborations.',
    'type' => 'read',
    'tag' => 'Collaborations (List)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  22 =>
  [
    'operation' => 'get_files_id_comments',
    'slug' => 'box_get_files_id_comments',
    'class' => 'BoxGetFilesIdComments',
    'method' => 'GET',
    'path' => '/files/{file_id}/comments',
    'name' => 'List file comments',
    'description' => 'Execute official Box API operation `get_files_id_comments`.

Endpoint: GET /files/{file_id}/comments.',
    'type' => 'read',
    'tag' => 'Comments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  23 =>
  [
    'operation' => 'get_files_id_tasks',
    'slug' => 'box_get_files_id_tasks',
    'class' => 'BoxGetFilesIdTasks',
    'method' => 'GET',
    'path' => '/files/{file_id}/tasks',
    'name' => 'List tasks on file',
    'description' => 'Execute official Box API operation `get_files_id_tasks`.

Endpoint: GET /files/{file_id}/tasks.',
    'type' => 'read',
    'tag' => 'Tasks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  24 =>
  [
    'operation' => 'get_files_id_trash',
    'slug' => 'box_get_files_id_trash',
    'class' => 'BoxGetFilesIdTrash',
    'method' => 'GET',
    'path' => '/files/{file_id}/trash',
    'name' => 'Get trashed file',
    'description' => 'Execute official Box API operation `get_files_id_trash`.

Endpoint: GET /files/{file_id}/trash.',
    'type' => 'read',
    'tag' => 'Trashed files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  25 =>
  [
    'operation' => 'delete_files_id_trash',
    'slug' => 'box_delete_files_id_trash',
    'class' => 'BoxDeleteFilesIdTrash',
    'method' => 'DELETE',
    'path' => '/files/{file_id}/trash',
    'name' => 'Permanently remove file',
    'description' => 'Execute official Box API operation `delete_files_id_trash`.

Endpoint: DELETE /files/{file_id}/trash.',
    'type' => 'write',
    'tag' => 'Trashed files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  26 =>
  [
    'operation' => 'get_files_id_versions',
    'slug' => 'box_get_files_id_versions',
    'class' => 'BoxGetFilesIdVersions',
    'method' => 'GET',
    'path' => '/files/{file_id}/versions',
    'name' => 'List all file versions',
    'description' => 'Execute official Box API operation `get_files_id_versions`.

Endpoint: GET /files/{file_id}/versions.',
    'type' => 'read',
    'tag' => 'File versions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  27 =>
  [
    'operation' => 'get_files_id_versions_id',
    'slug' => 'box_get_files_id_versions_id',
    'class' => 'BoxGetFilesIdVersionsId',
    'method' => 'GET',
    'path' => '/files/{file_id}/versions/{file_version_id}',
    'name' => 'Get file version',
    'description' => 'Execute official Box API operation `get_files_id_versions_id`.

Endpoint: GET /files/{file_id}/versions/{file_version_id}.',
    'type' => 'read',
    'tag' => 'File versions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'file_version_id',
        'param' => 'file_version_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the file version.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  28 =>
  [
    'operation' => 'delete_files_id_versions_id',
    'slug' => 'box_delete_files_id_versions_id',
    'class' => 'BoxDeleteFilesIdVersionsId',
    'method' => 'DELETE',
    'path' => '/files/{file_id}/versions/{file_version_id}',
    'name' => 'Remove file version',
    'description' => 'Execute official Box API operation `delete_files_id_versions_id`.

Endpoint: DELETE /files/{file_id}/versions/{file_version_id}.',
    'type' => 'write',
    'tag' => 'File versions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'file_version_id',
        'param' => 'file_version_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the file version.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  29 =>
  [
    'operation' => 'put_files_id_versions_id',
    'slug' => 'box_put_files_id_versions_id',
    'class' => 'BoxPutFilesIdVersionsId',
    'method' => 'PUT',
    'path' => '/files/{file_id}/versions/{file_version_id}',
    'name' => 'Restore file version',
    'description' => 'Execute official Box API operation `put_files_id_versions_id`.

Endpoint: PUT /files/{file_id}/versions/{file_version_id}.',
    'type' => 'write',
    'tag' => 'File versions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'file_version_id',
        'param' => 'file_version_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the file version.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  30 =>
  [
    'operation' => 'post_files_id_versions_current',
    'slug' => 'box_post_files_id_versions_current',
    'class' => 'BoxPostFilesIdVersionsCurrent',
    'method' => 'POST',
    'path' => '/files/{file_id}/versions/current',
    'name' => 'Promote file version',
    'description' => 'Execute official Box API operation `post_files_id_versions_current`.

Endpoint: POST /files/{file_id}/versions/current.',
    'type' => 'write',
    'tag' => 'File versions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  31 =>
  [
    'operation' => 'get_files_id_metadata',
    'slug' => 'box_get_files_id_metadata',
    'class' => 'BoxGetFilesIdMetadata',
    'method' => 'GET',
    'path' => '/files/{file_id}/metadata',
    'name' => 'List metadata instances on file',
    'description' => 'Execute official Box API operation `get_files_id_metadata`.

Endpoint: GET /files/{file_id}/metadata.',
    'type' => 'read',
    'tag' => 'Metadata instances (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Taxonomy field values are returned in `API view` by default, meaning the value is represented with a taxonomy node identifier. To retrieve the `Hydrated view`, where taxonomy va...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  32 =>
  [
    'operation' => 'get_files_id_metadata_enterprise_securityClassification-6VMVochwUWo',
    'slug' => 'box_get_files_id_metadata_enterprise_security_classification_6_vmvochw_uwo',
    'class' => 'BoxGetFilesIdMetadataEnterpriseSecurityClassification6VMVochwUWo',
    'method' => 'GET',
    'path' => '/files/{file_id}/metadata/enterprise/securityClassification-6VMVochwUWo',
    'name' => 'Get classification on file',
    'description' => 'Execute official Box API operation `get_files_id_metadata_enterprise_securityClassification-6VMVochwUWo`.

Endpoint: GET /files/{file_id}/metadata/enterprise/securityClassification-6VMVochwUWo.',
    'type' => 'read',
    'tag' => 'Classifications on files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  33 =>
  [
    'operation' => 'post_files_id_metadata_enterprise_securityClassification-6VMVochwUWo',
    'slug' => 'box_post_files_id_metadata_enterprise_security_classification_6_vmvochw_uwo',
    'class' => 'BoxPostFilesIdMetadataEnterpriseSecurityClassification6VMVochwUWo',
    'method' => 'POST',
    'path' => '/files/{file_id}/metadata/enterprise/securityClassification-6VMVochwUWo',
    'name' => 'Add classification to file',
    'description' => 'Execute official Box API operation `post_files_id_metadata_enterprise_securityClassification-6VMVochwUWo`.

Endpoint: POST /files/{file_id}/metadata/enterprise/securityClassification-6VMVochwUWo.',
    'type' => 'write',
    'tag' => 'Classifications on files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  34 =>
  [
    'operation' => 'put_files_id_metadata_enterprise_securityClassification-6VMVochwUWo',
    'slug' => 'box_put_files_id_metadata_enterprise_security_classification_6_vmvochw_uwo',
    'class' => 'BoxPutFilesIdMetadataEnterpriseSecurityClassification6VMVochwUWo',
    'method' => 'PUT',
    'path' => '/files/{file_id}/metadata/enterprise/securityClassification-6VMVochwUWo',
    'name' => 'Update classification on file',
    'description' => 'Execute official Box API operation `put_files_id_metadata_enterprise_securityClassification-6VMVochwUWo`.

Endpoint: PUT /files/{file_id}/metadata/enterprise/securityClassification-6VMVochwUWo.',
    'type' => 'write',
    'tag' => 'Classifications on files',
    'base' => 'api',
    'body_content_type' => 'application/json-patch+json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  35 =>
  [
    'operation' => 'delete_files_id_metadata_enterprise_securityClassification-6VMVochwUWo',
    'slug' => 'box_delete_files_id_metadata_enterprise_security_classification_6_vmvochw_uwo',
    'class' => 'BoxDeleteFilesIdMetadataEnterpriseSecurityClassification6VMVochwUWo',
    'method' => 'DELETE',
    'path' => '/files/{file_id}/metadata/enterprise/securityClassification-6VMVochwUWo',
    'name' => 'Remove classification from file',
    'description' => 'Execute official Box API operation `delete_files_id_metadata_enterprise_securityClassification-6VMVochwUWo`.

Endpoint: DELETE /files/{file_id}/metadata/enterprise/securityClassification-6VMVochwUWo.',
    'type' => 'write',
    'tag' => 'Classifications on files',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  36 =>
  [
    'operation' => 'get_files_id_metadata_id_id',
    'slug' => 'box_get_files_id_metadata_id_id',
    'class' => 'BoxGetFilesIdMetadataIdId',
    'method' => 'GET',
    'path' => '/files/{file_id}/metadata/{scope}/{template_key}',
    'name' => 'Get metadata instance on file',
    'description' => 'Execute official Box API operation `get_files_id_metadata_id_id`.

Endpoint: GET /files/{file_id}/metadata/{scope}/{template_key}.',
    'type' => 'read',
    'tag' => 'Metadata instances (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      2 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
      3 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Taxonomy field values are returned in `API view` by default, meaning the value is represented with a taxonomy node identifier. To retrieve the `Hydrated view`, where taxonomy va...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  37 =>
  [
    'operation' => 'post_files_id_metadata_id_id',
    'slug' => 'box_post_files_id_metadata_id_id',
    'class' => 'BoxPostFilesIdMetadataIdId',
    'method' => 'POST',
    'path' => '/files/{file_id}/metadata/{scope}/{template_key}',
    'name' => 'Create metadata instance on file',
    'description' => 'Execute official Box API operation `post_files_id_metadata_id_id`.

Endpoint: POST /files/{file_id}/metadata/{scope}/{template_key}.',
    'type' => 'write',
    'tag' => 'Metadata instances (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      2 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  38 =>
  [
    'operation' => 'put_files_id_metadata_id_id',
    'slug' => 'box_put_files_id_metadata_id_id',
    'class' => 'BoxPutFilesIdMetadataIdId',
    'method' => 'PUT',
    'path' => '/files/{file_id}/metadata/{scope}/{template_key}',
    'name' => 'Update metadata instance on file',
    'description' => 'Execute official Box API operation `put_files_id_metadata_id_id`.

Endpoint: PUT /files/{file_id}/metadata/{scope}/{template_key}.',
    'type' => 'write',
    'tag' => 'Metadata instances (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json-patch+json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      2 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  39 =>
  [
    'operation' => 'delete_files_id_metadata_id_id',
    'slug' => 'box_delete_files_id_metadata_id_id',
    'class' => 'BoxDeleteFilesIdMetadataIdId',
    'method' => 'DELETE',
    'path' => '/files/{file_id}/metadata/{scope}/{template_key}',
    'name' => 'Remove metadata instance from file',
    'description' => 'Execute official Box API operation `delete_files_id_metadata_id_id`.

Endpoint: DELETE /files/{file_id}/metadata/{scope}/{template_key}.',
    'type' => 'write',
    'tag' => 'Metadata instances (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      2 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  40 =>
  [
    'operation' => 'get_files_id_metadata_global_boxSkillsCards',
    'slug' => 'box_get_files_id_metadata_global_box_skills_cards',
    'class' => 'BoxGetFilesIdMetadataGlobalBoxSkillsCards',
    'method' => 'GET',
    'path' => '/files/{file_id}/metadata/global/boxSkillsCards',
    'name' => 'List Box Skill cards on file',
    'description' => 'Execute official Box API operation `get_files_id_metadata_global_boxSkillsCards`.

Endpoint: GET /files/{file_id}/metadata/global/boxSkillsCards.',
    'type' => 'read',
    'tag' => 'Skills',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  41 =>
  [
    'operation' => 'post_files_id_metadata_global_boxSkillsCards',
    'slug' => 'box_post_files_id_metadata_global_box_skills_cards',
    'class' => 'BoxPostFilesIdMetadataGlobalBoxSkillsCards',
    'method' => 'POST',
    'path' => '/files/{file_id}/metadata/global/boxSkillsCards',
    'name' => 'Create Box Skill cards on file',
    'description' => 'Execute official Box API operation `post_files_id_metadata_global_boxSkillsCards`.

Endpoint: POST /files/{file_id}/metadata/global/boxSkillsCards.',
    'type' => 'write',
    'tag' => 'Skills',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  42 =>
  [
    'operation' => 'put_files_id_metadata_global_boxSkillsCards',
    'slug' => 'box_put_files_id_metadata_global_box_skills_cards',
    'class' => 'BoxPutFilesIdMetadataGlobalBoxSkillsCards',
    'method' => 'PUT',
    'path' => '/files/{file_id}/metadata/global/boxSkillsCards',
    'name' => 'Update Box Skill cards on file',
    'description' => 'Execute official Box API operation `put_files_id_metadata_global_boxSkillsCards`.

Endpoint: PUT /files/{file_id}/metadata/global/boxSkillsCards.',
    'type' => 'write',
    'tag' => 'Skills',
    'base' => 'api',
    'body_content_type' => 'application/json-patch+json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  43 =>
  [
    'operation' => 'delete_files_id_metadata_global_boxSkillsCards',
    'slug' => 'box_delete_files_id_metadata_global_box_skills_cards',
    'class' => 'BoxDeleteFilesIdMetadataGlobalBoxSkillsCards',
    'method' => 'DELETE',
    'path' => '/files/{file_id}/metadata/global/boxSkillsCards',
    'name' => 'Remove Box Skill cards from file',
    'description' => 'Execute official Box API operation `delete_files_id_metadata_global_boxSkillsCards`.

Endpoint: DELETE /files/{file_id}/metadata/global/boxSkillsCards.',
    'type' => 'write',
    'tag' => 'Skills',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  44 =>
  [
    'operation' => 'get_files_id_watermark',
    'slug' => 'box_get_files_id_watermark',
    'class' => 'BoxGetFilesIdWatermark',
    'method' => 'GET',
    'path' => '/files/{file_id}/watermark',
    'name' => 'Get watermark on file',
    'description' => 'Execute official Box API operation `get_files_id_watermark`.

Endpoint: GET /files/{file_id}/watermark.',
    'type' => 'read',
    'tag' => 'Watermarks (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  45 =>
  [
    'operation' => 'put_files_id_watermark',
    'slug' => 'box_put_files_id_watermark',
    'class' => 'BoxPutFilesIdWatermark',
    'method' => 'PUT',
    'path' => '/files/{file_id}/watermark',
    'name' => 'Apply watermark to file',
    'description' => 'Execute official Box API operation `put_files_id_watermark`.

Endpoint: PUT /files/{file_id}/watermark.',
    'type' => 'write',
    'tag' => 'Watermarks (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  46 =>
  [
    'operation' => 'delete_files_id_watermark',
    'slug' => 'box_delete_files_id_watermark',
    'class' => 'BoxDeleteFilesIdWatermark',
    'method' => 'DELETE',
    'path' => '/files/{file_id}/watermark',
    'name' => 'Remove watermark from file',
    'description' => 'Execute official Box API operation `delete_files_id_watermark`.

Endpoint: DELETE /files/{file_id}/watermark.',
    'type' => 'write',
    'tag' => 'Watermarks (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  47 =>
  [
    'operation' => 'get_file_requests_id',
    'slug' => 'box_get_file_requests_id',
    'class' => 'BoxGetFileRequestsId',
    'method' => 'GET',
    'path' => '/file_requests/{file_request_id}',
    'name' => 'Get file request',
    'description' => 'Execute official Box API operation `get_file_requests_id`.

Endpoint: GET /file_requests/{file_request_id}.',
    'type' => 'read',
    'tag' => 'File requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_request_id',
        'param' => 'file_request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a file request. The ID for any file request can be determined by visiting a file request builder in the web application and copying the ID f...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  48 =>
  [
    'operation' => 'put_file_requests_id',
    'slug' => 'box_put_file_requests_id',
    'class' => 'BoxPutFileRequestsId',
    'method' => 'PUT',
    'path' => '/file_requests/{file_request_id}',
    'name' => 'Update file request',
    'description' => 'Execute official Box API operation `put_file_requests_id`.

Endpoint: PUT /file_requests/{file_request_id}.',
    'type' => 'write',
    'tag' => 'File requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_request_id',
        'param' => 'file_request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a file request. The ID for any file request can be determined by visiting a file request builder in the web application and copying the ID f...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  49 =>
  [
    'operation' => 'delete_file_requests_id',
    'slug' => 'box_delete_file_requests_id',
    'class' => 'BoxDeleteFileRequestsId',
    'method' => 'DELETE',
    'path' => '/file_requests/{file_request_id}',
    'name' => 'Delete file request',
    'description' => 'Execute official Box API operation `delete_file_requests_id`.

Endpoint: DELETE /file_requests/{file_request_id}.',
    'type' => 'write',
    'tag' => 'File requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_request_id',
        'param' => 'file_request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a file request. The ID for any file request can be determined by visiting a file request builder in the web application and copying the ID f...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  50 =>
  [
    'operation' => 'post_file_requests_id_copy',
    'slug' => 'box_post_file_requests_id_copy',
    'class' => 'BoxPostFileRequestsIdCopy',
    'method' => 'POST',
    'path' => '/file_requests/{file_request_id}/copy',
    'name' => 'Copy file request',
    'description' => 'Execute official Box API operation `post_file_requests_id_copy`.

Endpoint: POST /file_requests/{file_request_id}/copy.',
    'type' => 'write',
    'tag' => 'File requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_request_id',
        'param' => 'file_request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a file request. The ID for any file request can be determined by visiting a file request builder in the web application and copying the ID f...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  51 =>
  [
    'operation' => 'get_folders_id',
    'slug' => 'box_get_folders_id',
    'class' => 'BoxGetFoldersId',
    'method' => 'GET',
    'path' => '/folders/{folder_id}',
    'name' => 'Get folder information',
    'description' => 'Execute official Box API operation `get_folders_id`.

Endpoint: GET /folders/{folder_id}.',
    'type' => 'read',
    'tag' => 'Folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'sort',
        'param' => 'sort',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the **second** attribute by which items are sorted. The folder type affects the way the items are sorted: * **Standard folder**: Items are always sorted by their `type`...',
      ],
      3 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction to sort results in. This can be either in alphabetical ascending (`ASC`) or descending (`DESC`) order.',
      ],
      4 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Offset-based pagination is not guaranteed to work reliably for high offset values and may fail for large datasets. In thos...',
      ],
      5 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  52 =>
  [
    'operation' => 'post_folders_id',
    'slug' => 'box_post_folders_id',
    'class' => 'BoxPostFoldersId',
    'method' => 'POST',
    'path' => '/folders/{folder_id}',
    'name' => 'Restore folder',
    'description' => 'Execute official Box API operation `post_folders_id`.

Endpoint: POST /folders/{folder_id}.',
    'type' => 'write',
    'tag' => 'Trashed folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  53 =>
  [
    'operation' => 'put_folders_id',
    'slug' => 'box_put_folders_id',
    'class' => 'BoxPutFoldersId',
    'method' => 'PUT',
    'path' => '/folders/{folder_id}',
    'name' => 'Update folder',
    'description' => 'Execute official Box API operation `put_folders_id`.

Endpoint: PUT /folders/{folder_id}.',
    'type' => 'write',
    'tag' => 'Folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  54 =>
  [
    'operation' => 'delete_folders_id',
    'slug' => 'box_delete_folders_id',
    'class' => 'BoxDeleteFoldersId',
    'method' => 'DELETE',
    'path' => '/folders/{folder_id}',
    'name' => 'Delete folder',
    'description' => 'Execute official Box API operation `delete_folders_id`.

Endpoint: DELETE /folders/{folder_id}.',
    'type' => 'write',
    'tag' => 'Folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'recursive',
        'param' => 'recursive',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Delete a folder that is not empty by recursively deleting the folder and all of its content.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  55 =>
  [
    'operation' => 'get_folders_id_app_item_associations',
    'slug' => 'box_get_folders_id_app_item_associations',
    'class' => 'BoxGetFoldersIdAppItemAssociations',
    'method' => 'GET',
    'path' => '/folders/{folder_id}/app_item_associations',
    'name' => 'List folder app item associations',
    'description' => 'Execute official Box API operation `get_folders_id_app_item_associations`.

Endpoint: GET /folders/{folder_id}/app_item_associations.',
    'type' => 'read',
    'tag' => 'App item associations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      3 =>
      [
        'name' => 'application_type',
        'param' => 'application_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If given, returns only app items for this application type.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  56 =>
  [
    'operation' => 'get_folders_id_items',
    'slug' => 'box_get_folders_id_items',
    'class' => 'BoxGetFoldersIdItems',
    'method' => 'GET',
    'path' => '/folders/{folder_id}/items',
    'name' => 'List items in folder',
    'description' => 'Execute official Box API operation `get_folders_id_items`.

Endpoint: GET /folders/{folder_id}/items.',
    'type' => 'read',
    'tag' => 'Folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'usemarker',
        'param' => 'usemarker',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Specifies whether to use marker-based pagination instead of offset-based pagination. Only one pagination method can be used at a time. By setting this value to true, the API wil...',
      ],
      3 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      4 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Offset-based pagination is not guaranteed to work reliably for high offset values and may fail for large datasets. In thos...',
      ],
      5 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      6 =>
      [
        'name' => 'sort',
        'param' => 'sort',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the **second** attribute by which items are sorted. The folder type affects the way the items are sorted: * **Standard folder**: Items are always sorted by their `type`...',
      ],
      7 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction to sort results in. This can be either in alphabetical ascending (`ASC`) or descending (`DESC`) order.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  57 =>
  [
    'operation' => 'post_folders',
    'slug' => 'box_post_folders',
    'class' => 'BoxPostFolders',
    'method' => 'POST',
    'path' => '/folders',
    'name' => 'Create folder',
    'description' => 'Execute official Box API operation `post_folders`.

Endpoint: POST /folders.',
    'type' => 'write',
    'tag' => 'Folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  58 =>
  [
    'operation' => 'post_folders_id_copy',
    'slug' => 'box_post_folders_id_copy',
    'class' => 'BoxPostFoldersIdCopy',
    'method' => 'POST',
    'path' => '/folders/{folder_id}/copy',
    'name' => 'Copy folder',
    'description' => 'Execute official Box API operation `post_folders_id_copy`.

Endpoint: POST /folders/{folder_id}/copy.',
    'type' => 'write',
    'tag' => 'Folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the folder to copy. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For example,...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  59 =>
  [
    'operation' => 'get_folders_id_collaborations',
    'slug' => 'box_get_folders_id_collaborations',
    'class' => 'BoxGetFoldersIdCollaborations',
    'method' => 'GET',
    'path' => '/folders/{folder_id}/collaborations',
    'name' => 'List folder collaborations',
    'description' => 'Execute official Box API operation `get_folders_id_collaborations`.

Endpoint: GET /folders/{folder_id}/collaborations.',
    'type' => 'read',
    'tag' => 'Collaborations (List)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  60 =>
  [
    'operation' => 'get_folders_id_trash',
    'slug' => 'box_get_folders_id_trash',
    'class' => 'BoxGetFoldersIdTrash',
    'method' => 'GET',
    'path' => '/folders/{folder_id}/trash',
    'name' => 'Get trashed folder',
    'description' => 'Execute official Box API operation `get_folders_id_trash`.

Endpoint: GET /folders/{folder_id}/trash.',
    'type' => 'read',
    'tag' => 'Trashed folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  61 =>
  [
    'operation' => 'delete_folders_id_trash',
    'slug' => 'box_delete_folders_id_trash',
    'class' => 'BoxDeleteFoldersIdTrash',
    'method' => 'DELETE',
    'path' => '/folders/{folder_id}/trash',
    'name' => 'Permanently remove folder',
    'description' => 'Execute official Box API operation `delete_folders_id_trash`.

Endpoint: DELETE /folders/{folder_id}/trash.',
    'type' => 'write',
    'tag' => 'Trashed folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  62 =>
  [
    'operation' => 'get_folders_id_metadata',
    'slug' => 'box_get_folders_id_metadata',
    'class' => 'BoxGetFoldersIdMetadata',
    'method' => 'GET',
    'path' => '/folders/{folder_id}/metadata',
    'name' => 'List metadata instances on folder',
    'description' => 'Execute official Box API operation `get_folders_id_metadata`.

Endpoint: GET /folders/{folder_id}/metadata.',
    'type' => 'read',
    'tag' => 'Metadata instances (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Taxonomy field values are returned in `API view` by default, meaning the value is represented with a taxonomy node identifier. To retrieve the `Hydrated view`, where taxonomy va...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  63 =>
  [
    'operation' => 'get_folders_id_metadata_enterprise_securityClassification-6VMVochwUWo',
    'slug' => 'box_get_folders_id_metadata_enterprise_security_classification_6_vmvochw_uwo',
    'class' => 'BoxGetFoldersIdMetadataEnterpriseSecurityClassification6VMVochwUWo',
    'method' => 'GET',
    'path' => '/folders/{folder_id}/metadata/enterprise/securityClassification-6VMVochwUWo',
    'name' => 'Get classification on folder',
    'description' => 'Execute official Box API operation `get_folders_id_metadata_enterprise_securityClassification-6VMVochwUWo`.

Endpoint: GET /folders/{folder_id}/metadata/enterprise/securityClassification-6VMVochwUWo.',
    'type' => 'read',
    'tag' => 'Classifications on folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  64 =>
  [
    'operation' => 'post_folders_id_metadata_enterprise_securityClassification-6VMVochwUWo',
    'slug' => 'box_post_folders_id_metadata_enterprise_security_classification_6_vmvochw_uwo',
    'class' => 'BoxPostFoldersIdMetadataEnterpriseSecurityClassification6VMVochwUWo',
    'method' => 'POST',
    'path' => '/folders/{folder_id}/metadata/enterprise/securityClassification-6VMVochwUWo',
    'name' => 'Add classification to folder',
    'description' => 'Execute official Box API operation `post_folders_id_metadata_enterprise_securityClassification-6VMVochwUWo`.

Endpoint: POST /folders/{folder_id}/metadata/enterprise/securityClassification-6VMVochwUWo.',
    'type' => 'write',
    'tag' => 'Classifications on folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  65 =>
  [
    'operation' => 'put_folders_id_metadata_enterprise_securityClassification-6VMVochwUWo',
    'slug' => 'box_put_folders_id_metadata_enterprise_security_classification_6_vmvochw_uwo',
    'class' => 'BoxPutFoldersIdMetadataEnterpriseSecurityClassification6VMVochwUWo',
    'method' => 'PUT',
    'path' => '/folders/{folder_id}/metadata/enterprise/securityClassification-6VMVochwUWo',
    'name' => 'Update classification on folder',
    'description' => 'Execute official Box API operation `put_folders_id_metadata_enterprise_securityClassification-6VMVochwUWo`.

Endpoint: PUT /folders/{folder_id}/metadata/enterprise/securityClassification-6VMVochwUWo.',
    'type' => 'write',
    'tag' => 'Classifications on folders',
    'base' => 'api',
    'body_content_type' => 'application/json-patch+json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  66 =>
  [
    'operation' => 'delete_folders_id_metadata_enterprise_securityClassification-6VMVochwUWo',
    'slug' => 'box_delete_folders_id_metadata_enterprise_security_classification_6_vmvochw_uwo',
    'class' => 'BoxDeleteFoldersIdMetadataEnterpriseSecurityClassification6VMVochwUWo',
    'method' => 'DELETE',
    'path' => '/folders/{folder_id}/metadata/enterprise/securityClassification-6VMVochwUWo',
    'name' => 'Remove classification from folder',
    'description' => 'Execute official Box API operation `delete_folders_id_metadata_enterprise_securityClassification-6VMVochwUWo`.

Endpoint: DELETE /folders/{folder_id}/metadata/enterprise/securityClassification-6VMVochwUWo.',
    'type' => 'write',
    'tag' => 'Classifications on folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  67 =>
  [
    'operation' => 'get_folders_id_metadata_id_id',
    'slug' => 'box_get_folders_id_metadata_id_id',
    'class' => 'BoxGetFoldersIdMetadataIdId',
    'method' => 'GET',
    'path' => '/folders/{folder_id}/metadata/{scope}/{template_key}',
    'name' => 'Get metadata instance on folder',
    'description' => 'Execute official Box API operation `get_folders_id_metadata_id_id`.

Endpoint: GET /folders/{folder_id}/metadata/{scope}/{template_key}.',
    'type' => 'read',
    'tag' => 'Metadata instances (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      2 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  68 =>
  [
    'operation' => 'post_folders_id_metadata_id_id',
    'slug' => 'box_post_folders_id_metadata_id_id',
    'class' => 'BoxPostFoldersIdMetadataIdId',
    'method' => 'POST',
    'path' => '/folders/{folder_id}/metadata/{scope}/{template_key}',
    'name' => 'Create metadata instance on folder',
    'description' => 'Execute official Box API operation `post_folders_id_metadata_id_id`.

Endpoint: POST /folders/{folder_id}/metadata/{scope}/{template_key}.',
    'type' => 'write',
    'tag' => 'Metadata instances (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      2 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  69 =>
  [
    'operation' => 'put_folders_id_metadata_id_id',
    'slug' => 'box_put_folders_id_metadata_id_id',
    'class' => 'BoxPutFoldersIdMetadataIdId',
    'method' => 'PUT',
    'path' => '/folders/{folder_id}/metadata/{scope}/{template_key}',
    'name' => 'Update metadata instance on folder',
    'description' => 'Execute official Box API operation `put_folders_id_metadata_id_id`.

Endpoint: PUT /folders/{folder_id}/metadata/{scope}/{template_key}.',
    'type' => 'write',
    'tag' => 'Metadata instances (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json-patch+json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      2 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  70 =>
  [
    'operation' => 'delete_folders_id_metadata_id_id',
    'slug' => 'box_delete_folders_id_metadata_id_id',
    'class' => 'BoxDeleteFoldersIdMetadataIdId',
    'method' => 'DELETE',
    'path' => '/folders/{folder_id}/metadata/{scope}/{template_key}',
    'name' => 'Remove metadata instance from folder',
    'description' => 'Execute official Box API operation `delete_folders_id_metadata_id_id`.

Endpoint: DELETE /folders/{folder_id}/metadata/{scope}/{template_key}.',
    'type' => 'write',
    'tag' => 'Metadata instances (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      2 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  71 =>
  [
    'operation' => 'get_folders_trash_items',
    'slug' => 'box_get_folders_trash_items',
    'class' => 'BoxGetFoldersTrashItems',
    'method' => 'GET',
    'path' => '/folders/trash/items',
    'name' => 'List trashed items',
    'description' => 'Execute official Box API operation `get_folders_trash_items`.

Endpoint: GET /folders/trash/items.',
    'type' => 'read',
    'tag' => 'Trashed items',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
      3 =>
      [
        'name' => 'usemarker',
        'param' => 'usemarker',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Specifies whether to use marker-based pagination instead of offset-based pagination. Only one pagination method can be used at a time. By setting this value to true, the API wil...',
      ],
      4 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      5 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction to sort results in. This can be either in alphabetical ascending (`ASC`) or descending (`DESC`) order.',
      ],
      6 =>
      [
        'name' => 'sort',
        'param' => 'sort',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the **second** attribute by which items are sorted. Items are always sorted by their `type` first, with folders listed before files, and files listed before web links. T...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  72 =>
  [
    'operation' => 'get_folders_id_watermark',
    'slug' => 'box_get_folders_id_watermark',
    'class' => 'BoxGetFoldersIdWatermark',
    'method' => 'GET',
    'path' => '/folders/{folder_id}/watermark',
    'name' => 'Get watermark for folder',
    'description' => 'Execute official Box API operation `get_folders_id_watermark`.

Endpoint: GET /folders/{folder_id}/watermark.',
    'type' => 'read',
    'tag' => 'Watermarks (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  73 =>
  [
    'operation' => 'put_folders_id_watermark',
    'slug' => 'box_put_folders_id_watermark',
    'class' => 'BoxPutFoldersIdWatermark',
    'method' => 'PUT',
    'path' => '/folders/{folder_id}/watermark',
    'name' => 'Apply watermark to folder',
    'description' => 'Execute official Box API operation `put_folders_id_watermark`.

Endpoint: PUT /folders/{folder_id}/watermark.',
    'type' => 'write',
    'tag' => 'Watermarks (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  74 =>
  [
    'operation' => 'delete_folders_id_watermark',
    'slug' => 'box_delete_folders_id_watermark',
    'class' => 'BoxDeleteFoldersIdWatermark',
    'method' => 'DELETE',
    'path' => '/folders/{folder_id}/watermark',
    'name' => 'Remove watermark from folder',
    'description' => 'Execute official Box API operation `delete_folders_id_watermark`.

Endpoint: DELETE /folders/{folder_id}/watermark.',
    'type' => 'write',
    'tag' => 'Watermarks (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  75 =>
  [
    'operation' => 'get_folder_locks',
    'slug' => 'box_get_folder_locks',
    'class' => 'BoxGetFolderLocks',
    'method' => 'GET',
    'path' => '/folder_locks',
    'name' => 'List folder locks',
    'description' => 'Execute official Box API operation `get_folder_locks`.

Endpoint: GET /folder_locks.',
    'type' => 'read',
    'tag' => 'Folder Locks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  76 =>
  [
    'operation' => 'post_folder_locks',
    'slug' => 'box_post_folder_locks',
    'class' => 'BoxPostFolderLocks',
    'method' => 'POST',
    'path' => '/folder_locks',
    'name' => 'Create folder lock',
    'description' => 'Execute official Box API operation `post_folder_locks`.

Endpoint: POST /folder_locks.',
    'type' => 'write',
    'tag' => 'Folder Locks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  77 =>
  [
    'operation' => 'delete_folder_locks_id',
    'slug' => 'box_delete_folder_locks_id',
    'class' => 'BoxDeleteFolderLocksId',
    'method' => 'DELETE',
    'path' => '/folder_locks/{folder_lock_id}',
    'name' => 'Delete folder lock',
    'description' => 'Execute official Box API operation `delete_folder_locks_id`.

Endpoint: DELETE /folder_locks/{folder_lock_id}.',
    'type' => 'write',
    'tag' => 'Folder Locks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_lock_id',
        'param' => 'folder_lock_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the folder lock.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  78 =>
  [
    'operation' => 'get_metadata_templates',
    'slug' => 'box_get_metadata_templates',
    'class' => 'BoxGetMetadataTemplates',
    'method' => 'GET',
    'path' => '/metadata_templates',
    'name' => 'Find metadata template by instance ID',
    'description' => 'Execute official Box API operation `get_metadata_templates`.

Endpoint: GET /metadata_templates.',
    'type' => 'read',
    'tag' => 'Metadata templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'metadata_instance_id',
        'param' => 'metadata_instance_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of an instance of the metadata template to find.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  79 =>
  [
    'operation' => 'get_metadata_templates_enterprise_securityClassification-6VMVochwUWo_schema',
    'slug' => 'box_get_metadata_templates_enterprise_security_classification_6_vmvochw_uwo_schema',
    'class' => 'BoxGetMetadataTemplatesEnterpriseSecurityClassification6VMVochwUWoSchema',
    'method' => 'GET',
    'path' => '/metadata_templates/enterprise/securityClassification-6VMVochwUWo/schema',
    'name' => 'List all classifications',
    'description' => 'Execute official Box API operation `get_metadata_templates_enterprise_securityClassification-6VMVochwUWo_schema`.

Endpoint: GET /metadata_templates/enterprise/securityClassification-6VMVochwUWo/schema.',
    'type' => 'read',
    'tag' => 'Classifications',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  80 =>
  [
    'operation' => 'put_metadata_templates_enterprise_securityClassification-6VMVochwUWo_schema#add',
    'slug' => 'box_put_metadata_templates_enterprise_security_classification_6_vmvochw_uwo_schema_add',
    'class' => 'BoxPutMetadataTemplatesEnterpriseSecurityClassification6VMVochwUWoSchemaAdd',
    'method' => 'PUT',
    'path' => '/metadata_templates/enterprise/securityClassification-6VMVochwUWo/schema#add',
    'name' => 'Add classification',
    'description' => 'Execute official Box API operation `put_metadata_templates_enterprise_securityClassification-6VMVochwUWo_schema#add`.

Endpoint: PUT /metadata_templates/enterprise/securityClassification-6VMVochwUWo/schema#add.',
    'type' => 'write',
    'tag' => 'Classifications',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  81 =>
  [
    'operation' => 'put_metadata_templates_enterprise_securityClassification-6VMVochwUWo_schema#update',
    'slug' => 'box_put_metadata_templates_enterprise_security_classification_6_vmvochw_uwo_schema_update',
    'class' => 'BoxPutMetadataTemplatesEnterpriseSecurityClassification6VMVochwUWoSchemaUpdate',
    'method' => 'PUT',
    'path' => '/metadata_templates/enterprise/securityClassification-6VMVochwUWo/schema#update',
    'name' => 'Update classification',
    'description' => 'Execute official Box API operation `put_metadata_templates_enterprise_securityClassification-6VMVochwUWo_schema#update`.

Endpoint: PUT /metadata_templates/enterprise/securityClassification-6VMVochwUWo/schema#update.',
    'type' => 'write',
    'tag' => 'Classifications',
    'base' => 'api',
    'body_content_type' => 'application/json-patch+json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  82 =>
  [
    'operation' => 'get_metadata_templates_id_id_schema',
    'slug' => 'box_get_metadata_templates_id_id_schema',
    'class' => 'BoxGetMetadataTemplatesIdIdSchema',
    'method' => 'GET',
    'path' => '/metadata_templates/{scope}/{template_key}/schema',
    'name' => 'Get metadata template by name',
    'description' => 'Execute official Box API operation `get_metadata_templates_id_id_schema`.

Endpoint: GET /metadata_templates/{scope}/{template_key}/schema.',
    'type' => 'read',
    'tag' => 'Metadata templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      1 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  83 =>
  [
    'operation' => 'put_metadata_templates_id_id_schema',
    'slug' => 'box_put_metadata_templates_id_id_schema',
    'class' => 'BoxPutMetadataTemplatesIdIdSchema',
    'method' => 'PUT',
    'path' => '/metadata_templates/{scope}/{template_key}/schema',
    'name' => 'Update metadata template',
    'description' => 'Execute official Box API operation `put_metadata_templates_id_id_schema`.

Endpoint: PUT /metadata_templates/{scope}/{template_key}/schema.',
    'type' => 'write',
    'tag' => 'Metadata templates',
    'base' => 'api',
    'body_content_type' => 'application/json-patch+json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      1 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  84 =>
  [
    'operation' => 'delete_metadata_templates_id_id_schema',
    'slug' => 'box_delete_metadata_templates_id_id_schema',
    'class' => 'BoxDeleteMetadataTemplatesIdIdSchema',
    'method' => 'DELETE',
    'path' => '/metadata_templates/{scope}/{template_key}/schema',
    'name' => 'Remove metadata template',
    'description' => 'Execute official Box API operation `delete_metadata_templates_id_id_schema`.

Endpoint: DELETE /metadata_templates/{scope}/{template_key}/schema.',
    'type' => 'write',
    'tag' => 'Metadata templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The scope of the metadata template.',
      ],
      1 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  85 =>
  [
    'operation' => 'get_metadata_templates_id',
    'slug' => 'box_get_metadata_templates_id',
    'class' => 'BoxGetMetadataTemplatesId',
    'method' => 'GET',
    'path' => '/metadata_templates/{template_id}',
    'name' => 'Get metadata template by ID',
    'description' => 'Execute official Box API operation `get_metadata_templates_id`.

Endpoint: GET /metadata_templates/{template_id}.',
    'type' => 'read',
    'tag' => 'Metadata templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'template_id',
        'param' => 'template_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the template.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  86 =>
  [
    'operation' => 'get_metadata_templates_global',
    'slug' => 'box_get_metadata_templates_global',
    'class' => 'BoxGetMetadataTemplatesGlobal',
    'method' => 'GET',
    'path' => '/metadata_templates/global',
    'name' => 'List all global metadata templates',
    'description' => 'Execute official Box API operation `get_metadata_templates_global`.

Endpoint: GET /metadata_templates/global.',
    'type' => 'read',
    'tag' => 'Metadata templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  87 =>
  [
    'operation' => 'get_metadata_templates_enterprise',
    'slug' => 'box_get_metadata_templates_enterprise',
    'class' => 'BoxGetMetadataTemplatesEnterprise',
    'method' => 'GET',
    'path' => '/metadata_templates/enterprise',
    'name' => 'List all metadata templates for enterprise',
    'description' => 'Execute official Box API operation `get_metadata_templates_enterprise`.

Endpoint: GET /metadata_templates/enterprise.',
    'type' => 'read',
    'tag' => 'Metadata templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  88 =>
  [
    'operation' => 'post_metadata_templates_schema',
    'slug' => 'box_post_metadata_templates_schema',
    'class' => 'BoxPostMetadataTemplatesSchema',
    'method' => 'POST',
    'path' => '/metadata_templates/schema',
    'name' => 'Create metadata template',
    'description' => 'Execute official Box API operation `post_metadata_templates_schema`.

Endpoint: POST /metadata_templates/schema.',
    'type' => 'write',
    'tag' => 'Metadata templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  89 =>
  [
    'operation' => 'post_metadata_templates_schema#classifications',
    'slug' => 'box_post_metadata_templates_schema_classifications',
    'class' => 'BoxPostMetadataTemplatesSchemaClassifications',
    'method' => 'POST',
    'path' => '/metadata_templates/schema#classifications',
    'name' => 'Add initial classifications',
    'description' => 'Execute official Box API operation `post_metadata_templates_schema#classifications`.

Endpoint: POST /metadata_templates/schema#classifications.',
    'type' => 'write',
    'tag' => 'Classifications',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  90 =>
  [
    'operation' => 'get_metadata_cascade_policies',
    'slug' => 'box_get_metadata_cascade_policies',
    'class' => 'BoxGetMetadataCascadePolicies',
    'method' => 'GET',
    'path' => '/metadata_cascade_policies',
    'name' => 'List metadata cascade policies',
    'description' => 'Execute official Box API operation `get_metadata_cascade_policies`.

Endpoint: GET /metadata_cascade_policies.',
    'type' => 'read',
    'tag' => 'Metadata cascade policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Specifies which folder to return policies for. This can not be used on the root folder with ID `0`.',
      ],
      1 =>
      [
        'name' => 'owner_enterprise_id',
        'param' => 'owner_enterprise_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The ID of the enterprise ID for which to find metadata cascade policies. If not specified, it defaults to the current enterprise.',
      ],
      2 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  91 =>
  [
    'operation' => 'post_metadata_cascade_policies',
    'slug' => 'box_post_metadata_cascade_policies',
    'class' => 'BoxPostMetadataCascadePolicies',
    'method' => 'POST',
    'path' => '/metadata_cascade_policies',
    'name' => 'Create metadata cascade policy',
    'description' => 'Execute official Box API operation `post_metadata_cascade_policies`.

Endpoint: POST /metadata_cascade_policies.',
    'type' => 'write',
    'tag' => 'Metadata cascade policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  92 =>
  [
    'operation' => 'get_metadata_cascade_policies_id',
    'slug' => 'box_get_metadata_cascade_policies_id',
    'class' => 'BoxGetMetadataCascadePoliciesId',
    'method' => 'GET',
    'path' => '/metadata_cascade_policies/{metadata_cascade_policy_id}',
    'name' => 'Get metadata cascade policy',
    'description' => 'Execute official Box API operation `get_metadata_cascade_policies_id`.

Endpoint: GET /metadata_cascade_policies/{metadata_cascade_policy_id}.',
    'type' => 'read',
    'tag' => 'Metadata cascade policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'metadata_cascade_policy_id',
        'param' => 'metadata_cascade_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the metadata cascade policy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  93 =>
  [
    'operation' => 'delete_metadata_cascade_policies_id',
    'slug' => 'box_delete_metadata_cascade_policies_id',
    'class' => 'BoxDeleteMetadataCascadePoliciesId',
    'method' => 'DELETE',
    'path' => '/metadata_cascade_policies/{metadata_cascade_policy_id}',
    'name' => 'Remove metadata cascade policy',
    'description' => 'Execute official Box API operation `delete_metadata_cascade_policies_id`.

Endpoint: DELETE /metadata_cascade_policies/{metadata_cascade_policy_id}.',
    'type' => 'write',
    'tag' => 'Metadata cascade policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'metadata_cascade_policy_id',
        'param' => 'metadata_cascade_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the metadata cascade policy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  94 =>
  [
    'operation' => 'post_metadata_cascade_policies_id_apply',
    'slug' => 'box_post_metadata_cascade_policies_id_apply',
    'class' => 'BoxPostMetadataCascadePoliciesIdApply',
    'method' => 'POST',
    'path' => '/metadata_cascade_policies/{metadata_cascade_policy_id}/apply',
    'name' => 'Force-apply metadata cascade policy to folder',
    'description' => 'Execute official Box API operation `post_metadata_cascade_policies_id_apply`.

Endpoint: POST /metadata_cascade_policies/{metadata_cascade_policy_id}/apply.',
    'type' => 'write',
    'tag' => 'Metadata cascade policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'metadata_cascade_policy_id',
        'param' => 'metadata_cascade_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the cascade policy to force-apply.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  95 =>
  [
    'operation' => 'post_metadata_queries_execute_read',
    'slug' => 'box_post_metadata_queries_execute_read',
    'class' => 'BoxPostMetadataQueriesExecuteRead',
    'method' => 'POST',
    'path' => '/metadata_queries/execute_read',
    'name' => 'Query files/folders by metadata',
    'description' => 'Execute official Box API operation `post_metadata_queries_execute_read`.

Endpoint: POST /metadata_queries/execute_read.',
    'type' => 'write',
    'tag' => 'Search',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  96 =>
  [
    'operation' => 'get_comments_id',
    'slug' => 'box_get_comments_id',
    'class' => 'BoxGetCommentsId',
    'method' => 'GET',
    'path' => '/comments/{comment_id}',
    'name' => 'Get comment',
    'description' => 'Execute official Box API operation `get_comments_id`.

Endpoint: GET /comments/{comment_id}.',
    'type' => 'read',
    'tag' => 'Comments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'comment_id',
        'param' => 'comment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the comment.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  97 =>
  [
    'operation' => 'put_comments_id',
    'slug' => 'box_put_comments_id',
    'class' => 'BoxPutCommentsId',
    'method' => 'PUT',
    'path' => '/comments/{comment_id}',
    'name' => 'Update comment',
    'description' => 'Execute official Box API operation `put_comments_id`.

Endpoint: PUT /comments/{comment_id}.',
    'type' => 'write',
    'tag' => 'Comments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'comment_id',
        'param' => 'comment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the comment.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  98 =>
  [
    'operation' => 'delete_comments_id',
    'slug' => 'box_delete_comments_id',
    'class' => 'BoxDeleteCommentsId',
    'method' => 'DELETE',
    'path' => '/comments/{comment_id}',
    'name' => 'Remove comment',
    'description' => 'Execute official Box API operation `delete_comments_id`.

Endpoint: DELETE /comments/{comment_id}.',
    'type' => 'write',
    'tag' => 'Comments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'comment_id',
        'param' => 'comment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the comment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  99 =>
  [
    'operation' => 'post_comments',
    'slug' => 'box_post_comments',
    'class' => 'BoxPostComments',
    'method' => 'POST',
    'path' => '/comments',
    'name' => 'Create comment',
    'description' => 'Execute official Box API operation `post_comments`.

Endpoint: POST /comments.',
    'type' => 'write',
    'tag' => 'Comments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  100 =>
  [
    'operation' => 'get_collaborations_id',
    'slug' => 'box_get_collaborations_id',
    'class' => 'BoxGetCollaborationsId',
    'method' => 'GET',
    'path' => '/collaborations/{collaboration_id}',
    'name' => 'Get collaboration',
    'description' => 'Execute official Box API operation `get_collaborations_id`.

Endpoint: GET /collaborations/{collaboration_id}.',
    'type' => 'read',
    'tag' => 'Collaborations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collaboration_id',
        'param' => 'collaboration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the collaboration.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  101 =>
  [
    'operation' => 'put_collaborations_id',
    'slug' => 'box_put_collaborations_id',
    'class' => 'BoxPutCollaborationsId',
    'method' => 'PUT',
    'path' => '/collaborations/{collaboration_id}',
    'name' => 'Update collaboration',
    'description' => 'Execute official Box API operation `put_collaborations_id`.

Endpoint: PUT /collaborations/{collaboration_id}.',
    'type' => 'write',
    'tag' => 'Collaborations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collaboration_id',
        'param' => 'collaboration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the collaboration.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  102 =>
  [
    'operation' => 'delete_collaborations_id',
    'slug' => 'box_delete_collaborations_id',
    'class' => 'BoxDeleteCollaborationsId',
    'method' => 'DELETE',
    'path' => '/collaborations/{collaboration_id}',
    'name' => 'Remove collaboration',
    'description' => 'Execute official Box API operation `delete_collaborations_id`.

Endpoint: DELETE /collaborations/{collaboration_id}.',
    'type' => 'write',
    'tag' => 'Collaborations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collaboration_id',
        'param' => 'collaboration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the collaboration.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  103 =>
  [
    'operation' => 'get_collaborations',
    'slug' => 'box_get_collaborations',
    'class' => 'BoxGetCollaborations',
    'method' => 'GET',
    'path' => '/collaborations',
    'name' => 'List pending collaborations',
    'description' => 'Execute official Box API operation `get_collaborations`.

Endpoint: GET /collaborations.',
    'type' => 'read',
    'tag' => 'Collaborations (List)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The status of the collaborations to retrieve.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  104 =>
  [
    'operation' => 'post_collaborations',
    'slug' => 'box_post_collaborations',
    'class' => 'BoxPostCollaborations',
    'method' => 'POST',
    'path' => '/collaborations',
    'name' => 'Create collaboration',
    'description' => 'Execute official Box API operation `post_collaborations`.

Endpoint: POST /collaborations.',
    'type' => 'write',
    'tag' => 'Collaborations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'notify',
        'param' => 'notify',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines if users should receive email notification for the action performed.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  105 =>
  [
    'operation' => 'get_search',
    'slug' => 'box_get_search',
    'class' => 'BoxGetSearch',
    'method' => 'GET',
    'path' => '/search',
    'name' => 'Search for content',
    'description' => 'Execute official Box API operation `get_search`.

Endpoint: GET /search.',
    'type' => 'read',
    'tag' => 'Search',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'query',
        'param' => 'query',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The string to search for. This query is matched against item names, descriptions, text content of files, and various other fields of the different item types. This parameter sup...',
      ],
      1 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits the search results to either the files that the user has access to, or to files available to the entire enterprise. The scope defaults to `user_content`, which limits the...',
      ],
      2 =>
      [
        'name' => 'file_extensions',
        'param' => 'file_extensions',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any files that match any of the provided file extensions. This list is a comma-separated list of file extensions without the dots.',
      ],
      3 =>
      [
        'name' => 'created_at_range',
        'param' => 'created_at_range',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any items created within a given date range. Date ranges are defined as comma separated RFC3339 timestamps. If the start date is omitted (`,2014-05-...',
      ],
      4 =>
      [
        'name' => 'updated_at_range',
        'param' => 'updated_at_range',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any items updated within a given date range. Date ranges are defined as comma separated RFC3339 timestamps. If the start date is omitted (`,2014-05-...',
      ],
      5 =>
      [
        'name' => 'size_range',
        'param' => 'size_range',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any items with a size within a given file size range. This applied to files and folders. Size ranges are defined as comma separated list of a lower...',
      ],
      6 =>
      [
        'name' => 'owner_user_ids',
        'param' => 'owner_user_ids',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any items that are owned by the given list of owners, defined as a list of comma separated user IDs. The items still need to be owned or shared with...',
      ],
      7 =>
      [
        'name' => 'recent_updater_user_ids',
        'param' => 'recent_updater_user_ids',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any items that have been updated by the given list of users, defined as a list of comma separated user IDs. The items still need to be owned or shar...',
      ],
      8 =>
      [
        'name' => 'ancestor_folder_ids',
        'param' => 'ancestor_folder_ids',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to items within the given list of folders, defined as a comma separated lists of folder IDs. Search results will also include items within any subfolde...',
      ],
      9 =>
      [
        'name' => 'content_types',
        'param' => 'content_types',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any items that match the search query for a specific part of the file, for example the file description. Content types are defined as a comma separa...',
      ],
      10 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits the search results to any items of this type. This parameter only takes one value. By default the API returns items that match any of these types. * `file` - Limits the s...',
      ],
      11 =>
      [
        'name' => 'trash_content',
        'param' => 'trash_content',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if the search should look in the trash for items. By default, this API only returns search results for items not currently in the trash (`non_trashed_only`). * `trash...',
      ],
      12 =>
      [
        'name' => 'mdfilters',
        'param' => 'mdfilters',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any items for which the metadata matches the provided filter. This parameter is a list that specifies exactly **one** metadata template used to filt...',
      ],
      13 =>
      [
        'name' => 'sort',
        'param' => 'sort',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the order in which search results are returned. This API defaults to returning items by relevance unless this parameter is explicitly specified. * `relevance` (default)...',
      ],
      14 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the direction in which search results are ordered. This API defaults to returning items in descending (`DESC`) order unless this parameter is explicitly specified. When...',
      ],
      15 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Defines the maximum number of items to return as part of a page of results.',
      ],
      16 =>
      [
        'name' => 'include_recent_shared_links',
        'param' => 'include_recent_shared_links',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Defines whether the search results should include any items that the user recently accessed through a shared link. When this parameter has been set to true, the format of the re...',
      ],
      17 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      18 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
      19 =>
      [
        'name' => 'deleted_user_ids',
        'param' => 'deleted_user_ids',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to items that were deleted by the given list of users, defined as a list of comma separated user IDs. The `trash_content` parameter needs to be set to...',
      ],
      20 =>
      [
        'name' => 'deleted_at_range',
        'param' => 'deleted_at_range',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Limits the search results to any items deleted within a given date range. Date ranges are defined as comma separated RFC3339 timestamps. If the start date is omitted (`2014-05-1...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  106 =>
  [
    'operation' => 'post_tasks',
    'slug' => 'box_post_tasks',
    'class' => 'BoxPostTasks',
    'method' => 'POST',
    'path' => '/tasks',
    'name' => 'Create task',
    'description' => 'Execute official Box API operation `post_tasks`.

Endpoint: POST /tasks.',
    'type' => 'write',
    'tag' => 'Tasks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  107 =>
  [
    'operation' => 'get_tasks_id',
    'slug' => 'box_get_tasks_id',
    'class' => 'BoxGetTasksId',
    'method' => 'GET',
    'path' => '/tasks/{task_id}',
    'name' => 'Get task',
    'description' => 'Execute official Box API operation `get_tasks_id`.

Endpoint: GET /tasks/{task_id}.',
    'type' => 'read',
    'tag' => 'Tasks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'task_id',
        'param' => 'task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the task.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  108 =>
  [
    'operation' => 'put_tasks_id',
    'slug' => 'box_put_tasks_id',
    'class' => 'BoxPutTasksId',
    'method' => 'PUT',
    'path' => '/tasks/{task_id}',
    'name' => 'Update task',
    'description' => 'Execute official Box API operation `put_tasks_id`.

Endpoint: PUT /tasks/{task_id}.',
    'type' => 'write',
    'tag' => 'Tasks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'task_id',
        'param' => 'task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the task.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  109 =>
  [
    'operation' => 'delete_tasks_id',
    'slug' => 'box_delete_tasks_id',
    'class' => 'BoxDeleteTasksId',
    'method' => 'DELETE',
    'path' => '/tasks/{task_id}',
    'name' => 'Remove task',
    'description' => 'Execute official Box API operation `delete_tasks_id`.

Endpoint: DELETE /tasks/{task_id}.',
    'type' => 'write',
    'tag' => 'Tasks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'task_id',
        'param' => 'task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the task.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  110 =>
  [
    'operation' => 'get_tasks_id_assignments',
    'slug' => 'box_get_tasks_id_assignments',
    'class' => 'BoxGetTasksIdAssignments',
    'method' => 'GET',
    'path' => '/tasks/{task_id}/assignments',
    'name' => 'List task assignments',
    'description' => 'Execute official Box API operation `get_tasks_id_assignments`.

Endpoint: GET /tasks/{task_id}/assignments.',
    'type' => 'read',
    'tag' => 'Task assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'task_id',
        'param' => 'task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the task.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  111 =>
  [
    'operation' => 'post_task_assignments',
    'slug' => 'box_post_task_assignments',
    'class' => 'BoxPostTaskAssignments',
    'method' => 'POST',
    'path' => '/task_assignments',
    'name' => 'Assign task',
    'description' => 'Execute official Box API operation `post_task_assignments`.

Endpoint: POST /task_assignments.',
    'type' => 'write',
    'tag' => 'Task assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  112 =>
  [
    'operation' => 'get_task_assignments_id',
    'slug' => 'box_get_task_assignments_id',
    'class' => 'BoxGetTaskAssignmentsId',
    'method' => 'GET',
    'path' => '/task_assignments/{task_assignment_id}',
    'name' => 'Get task assignment',
    'description' => 'Execute official Box API operation `get_task_assignments_id`.

Endpoint: GET /task_assignments/{task_assignment_id}.',
    'type' => 'read',
    'tag' => 'Task assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'task_assignment_id',
        'param' => 'task_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the task assignment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  113 =>
  [
    'operation' => 'put_task_assignments_id',
    'slug' => 'box_put_task_assignments_id',
    'class' => 'BoxPutTaskAssignmentsId',
    'method' => 'PUT',
    'path' => '/task_assignments/{task_assignment_id}',
    'name' => 'Update task assignment',
    'description' => 'Execute official Box API operation `put_task_assignments_id`.

Endpoint: PUT /task_assignments/{task_assignment_id}.',
    'type' => 'write',
    'tag' => 'Task assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'task_assignment_id',
        'param' => 'task_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the task assignment.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  114 =>
  [
    'operation' => 'delete_task_assignments_id',
    'slug' => 'box_delete_task_assignments_id',
    'class' => 'BoxDeleteTaskAssignmentsId',
    'method' => 'DELETE',
    'path' => '/task_assignments/{task_assignment_id}',
    'name' => 'Unassign task',
    'description' => 'Execute official Box API operation `delete_task_assignments_id`.

Endpoint: DELETE /task_assignments/{task_assignment_id}.',
    'type' => 'write',
    'tag' => 'Task assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'task_assignment_id',
        'param' => 'task_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the task assignment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  115 =>
  [
    'operation' => 'get_shared_items',
    'slug' => 'box_get_shared_items',
    'class' => 'BoxGetSharedItems',
    'method' => 'GET',
    'path' => '/shared_items',
    'name' => 'Find file for shared link',
    'description' => 'Execute official Box API operation `get_shared_items`.

Endpoint: GET /shared_items.',
    'type' => 'read',
    'tag' => 'Shared links (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  116 =>
  [
    'operation' => 'get_files_id#get_shared_link',
    'slug' => 'box_get_files_id_get_shared_link',
    'class' => 'BoxGetFilesIdGetSharedLink',
    'method' => 'GET',
    'path' => '/files/{file_id}#get_shared_link',
    'name' => 'Get shared link for file',
    'description' => 'Execute official Box API operation `get_files_id#get_shared_link`.

Endpoint: GET /files/{file_id}#get_shared_link.',
    'type' => 'read',
    'tag' => 'Shared links (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  117 =>
  [
    'operation' => 'put_files_id#add_shared_link',
    'slug' => 'box_put_files_id_add_shared_link',
    'class' => 'BoxPutFilesIdAddSharedLink',
    'method' => 'PUT',
    'path' => '/files/{file_id}#add_shared_link',
    'name' => 'Add shared link to file',
    'description' => 'Execute official Box API operation `put_files_id#add_shared_link`.

Endpoint: PUT /files/{file_id}#add_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  118 =>
  [
    'operation' => 'put_files_id#update_shared_link',
    'slug' => 'box_put_files_id_update_shared_link',
    'class' => 'BoxPutFilesIdUpdateSharedLink',
    'method' => 'PUT',
    'path' => '/files/{file_id}#update_shared_link',
    'name' => 'Update shared link on file',
    'description' => 'Execute official Box API operation `put_files_id#update_shared_link`.

Endpoint: PUT /files/{file_id}#update_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  119 =>
  [
    'operation' => 'put_files_id#remove_shared_link',
    'slug' => 'box_put_files_id_remove_shared_link',
    'class' => 'BoxPutFilesIdRemoveSharedLink',
    'method' => 'PUT',
    'path' => '/files/{file_id}#remove_shared_link',
    'name' => 'Remove shared link from file',
    'description' => 'Execute official Box API operation `put_files_id#remove_shared_link`.

Endpoint: PUT /files/{file_id}#remove_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Files)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represents a file. The ID for any file can be determined by visiting a file in the web application and copying the ID from the URL. For example, for t...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  120 =>
  [
    'operation' => 'get_shared_items#folders',
    'slug' => 'box_get_shared_items_folders',
    'class' => 'BoxGetSharedItemsFolders',
    'method' => 'GET',
    'path' => '/shared_items#folders',
    'name' => 'Find folder for shared link',
    'description' => 'Execute official Box API operation `get_shared_items#folders`.

Endpoint: GET /shared_items#folders.',
    'type' => 'read',
    'tag' => 'Shared links (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  121 =>
  [
    'operation' => 'get_folders_id#get_shared_link',
    'slug' => 'box_get_folders_id_get_shared_link',
    'class' => 'BoxGetFoldersIdGetSharedLink',
    'method' => 'GET',
    'path' => '/folders/{folder_id}#get_shared_link',
    'name' => 'Get shared link for folder',
    'description' => 'Execute official Box API operation `get_folders_id#get_shared_link`.

Endpoint: GET /folders/{folder_id}#get_shared_link.',
    'type' => 'read',
    'tag' => 'Shared links (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  122 =>
  [
    'operation' => 'put_folders_id#add_shared_link',
    'slug' => 'box_put_folders_id_add_shared_link',
    'class' => 'BoxPutFoldersIdAddSharedLink',
    'method' => 'PUT',
    'path' => '/folders/{folder_id}#add_shared_link',
    'name' => 'Add shared link to folder',
    'description' => 'Execute official Box API operation `put_folders_id#add_shared_link`.

Endpoint: PUT /folders/{folder_id}#add_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  123 =>
  [
    'operation' => 'put_folders_id#update_shared_link',
    'slug' => 'box_put_folders_id_update_shared_link',
    'class' => 'BoxPutFoldersIdUpdateSharedLink',
    'method' => 'PUT',
    'path' => '/folders/{folder_id}#update_shared_link',
    'name' => 'Update shared link on folder',
    'description' => 'Execute official Box API operation `put_folders_id#update_shared_link`.

Endpoint: PUT /folders/{folder_id}#update_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  124 =>
  [
    'operation' => 'put_folders_id#remove_shared_link',
    'slug' => 'box_put_folders_id_remove_shared_link',
    'class' => 'BoxPutFoldersIdRemoveSharedLink',
    'method' => 'PUT',
    'path' => '/folders/{folder_id}#remove_shared_link',
    'name' => 'Remove shared link from folder',
    'description' => 'Execute official Box API operation `put_folders_id#remove_shared_link`.

Endpoint: PUT /folders/{folder_id}#remove_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Folders)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  125 =>
  [
    'operation' => 'post_web_links',
    'slug' => 'box_post_web_links',
    'class' => 'BoxPostWebLinks',
    'method' => 'POST',
    'path' => '/web_links',
    'name' => 'Create web link',
    'description' => 'Execute official Box API operation `post_web_links`.

Endpoint: POST /web_links.',
    'type' => 'write',
    'tag' => 'Web links',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  126 =>
  [
    'operation' => 'get_web_links_id',
    'slug' => 'box_get_web_links_id',
    'class' => 'BoxGetWebLinksId',
    'method' => 'GET',
    'path' => '/web_links/{web_link_id}',
    'name' => 'Get web link',
    'description' => 'Execute official Box API operation `get_web_links_id`.

Endpoint: GET /web_links/{web_link_id}.',
    'type' => 'read',
    'tag' => 'Web links',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  127 =>
  [
    'operation' => 'post_web_links_id',
    'slug' => 'box_post_web_links_id',
    'class' => 'BoxPostWebLinksId',
    'method' => 'POST',
    'path' => '/web_links/{web_link_id}',
    'name' => 'Restore web link',
    'description' => 'Execute official Box API operation `post_web_links_id`.

Endpoint: POST /web_links/{web_link_id}.',
    'type' => 'write',
    'tag' => 'Trashed web links',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  128 =>
  [
    'operation' => 'put_web_links_id',
    'slug' => 'box_put_web_links_id',
    'class' => 'BoxPutWebLinksId',
    'method' => 'PUT',
    'path' => '/web_links/{web_link_id}',
    'name' => 'Update web link',
    'description' => 'Execute official Box API operation `put_web_links_id`.

Endpoint: PUT /web_links/{web_link_id}.',
    'type' => 'write',
    'tag' => 'Web links',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  129 =>
  [
    'operation' => 'delete_web_links_id',
    'slug' => 'box_delete_web_links_id',
    'class' => 'BoxDeleteWebLinksId',
    'method' => 'DELETE',
    'path' => '/web_links/{web_link_id}',
    'name' => 'Remove web link',
    'description' => 'Execute official Box API operation `delete_web_links_id`.

Endpoint: DELETE /web_links/{web_link_id}.',
    'type' => 'write',
    'tag' => 'Web links',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  130 =>
  [
    'operation' => 'get_web_links_id_trash',
    'slug' => 'box_get_web_links_id_trash',
    'class' => 'BoxGetWebLinksIdTrash',
    'method' => 'GET',
    'path' => '/web_links/{web_link_id}/trash',
    'name' => 'Get trashed web link',
    'description' => 'Execute official Box API operation `get_web_links_id_trash`.

Endpoint: GET /web_links/{web_link_id}/trash.',
    'type' => 'read',
    'tag' => 'Trashed web links',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  131 =>
  [
    'operation' => 'delete_web_links_id_trash',
    'slug' => 'box_delete_web_links_id_trash',
    'class' => 'BoxDeleteWebLinksIdTrash',
    'method' => 'DELETE',
    'path' => '/web_links/{web_link_id}/trash',
    'name' => 'Permanently remove web link',
    'description' => 'Execute official Box API operation `delete_web_links_id_trash`.

Endpoint: DELETE /web_links/{web_link_id}/trash.',
    'type' => 'write',
    'tag' => 'Trashed web links',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  132 =>
  [
    'operation' => 'get_shared_items#web_links',
    'slug' => 'box_get_shared_items_web_links',
    'class' => 'BoxGetSharedItemsWebLinks',
    'method' => 'GET',
    'path' => '/shared_items#web_links',
    'name' => 'Find web link for shared link',
    'description' => 'Execute official Box API operation `get_shared_items#web_links`.

Endpoint: GET /shared_items#web_links.',
    'type' => 'read',
    'tag' => 'Shared links (Web Links)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  133 =>
  [
    'operation' => 'get_web_links_id#get_shared_link',
    'slug' => 'box_get_web_links_id_get_shared_link',
    'class' => 'BoxGetWebLinksIdGetSharedLink',
    'method' => 'GET',
    'path' => '/web_links/{web_link_id}#get_shared_link',
    'name' => 'Get shared link for web link',
    'description' => 'Execute official Box API operation `get_web_links_id#get_shared_link`.

Endpoint: GET /web_links/{web_link_id}#get_shared_link.',
    'type' => 'read',
    'tag' => 'Shared links (Web Links)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  134 =>
  [
    'operation' => 'put_web_links_id#add_shared_link',
    'slug' => 'box_put_web_links_id_add_shared_link',
    'class' => 'BoxPutWebLinksIdAddSharedLink',
    'method' => 'PUT',
    'path' => '/web_links/{web_link_id}#add_shared_link',
    'name' => 'Add shared link to web link',
    'description' => 'Execute official Box API operation `put_web_links_id#add_shared_link`.

Endpoint: PUT /web_links/{web_link_id}#add_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Web Links)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  135 =>
  [
    'operation' => 'put_web_links_id#update_shared_link',
    'slug' => 'box_put_web_links_id_update_shared_link',
    'class' => 'BoxPutWebLinksIdUpdateSharedLink',
    'method' => 'PUT',
    'path' => '/web_links/{web_link_id}#update_shared_link',
    'name' => 'Update shared link on web link',
    'description' => 'Execute official Box API operation `put_web_links_id#update_shared_link`.

Endpoint: PUT /web_links/{web_link_id}#update_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Web Links)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  136 =>
  [
    'operation' => 'put_web_links_id#remove_shared_link',
    'slug' => 'box_put_web_links_id_remove_shared_link',
    'class' => 'BoxPutWebLinksIdRemoveSharedLink',
    'method' => 'PUT',
    'path' => '/web_links/{web_link_id}#remove_shared_link',
    'name' => 'Remove shared link from web link',
    'description' => 'Execute official Box API operation `put_web_links_id#remove_shared_link`.

Endpoint: PUT /web_links/{web_link_id}#remove_shared_link.',
    'type' => 'write',
    'tag' => 'Shared links (Web Links)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'web_link_id',
        'param' => 'web_link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the web link.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Explicitly request the `shared_link` fields to be returned for this item.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  137 =>
  [
    'operation' => 'get_shared_items#app_items',
    'slug' => 'box_get_shared_items_app_items',
    'class' => 'BoxGetSharedItemsAppItems',
    'method' => 'GET',
    'path' => '/shared_items#app_items',
    'name' => 'Find app item for shared link',
    'description' => 'Execute official Box API operation `get_shared_items#app_items`.

Endpoint: GET /shared_items#app_items.',
    'type' => 'read',
    'tag' => 'Shared links (App Items)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  138 =>
  [
    'operation' => 'get_users',
    'slug' => 'box_get_users',
    'class' => 'BoxGetUsers',
    'method' => 'GET',
    'path' => '/users',
    'name' => 'List enterprise users',
    'description' => 'Execute official Box API operation `get_users`.

Endpoint: GET /users.',
    'type' => 'read',
    'tag' => 'Users',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'filter_term',
        'param' => 'filter_term',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits the results to only users who\'s `name` or `login` start with the search term. For externally managed users, the search term needs to completely match the in order to find...',
      ],
      1 =>
      [
        'name' => 'user_type',
        'param' => 'user_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits the results to the kind of user specified. * `all` returns every kind of user for whom the `login` or `name` partially matches the `filter_term`. It will only return an e...',
      ],
      2 =>
      [
        'name' => 'external_app_user_id',
        'param' => 'external_app_user_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits the results to app users with the given `external_app_user_id` value. When creating an app user, an `external_app_user_id` value can be set. This value can then be used i...',
      ],
      3 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      4 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
      5 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      6 =>
      [
        'name' => 'usemarker',
        'param' => 'usemarker',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Specifies whether to use marker-based pagination instead of offset-based pagination. Only one pagination method can be used at a time. By setting this value to true, the API wil...',
      ],
      7 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  139 =>
  [
    'operation' => 'post_users',
    'slug' => 'box_post_users',
    'class' => 'BoxPostUsers',
    'method' => 'POST',
    'path' => '/users',
    'name' => 'Create user',
    'description' => 'Execute official Box API operation `post_users`.

Endpoint: POST /users.',
    'type' => 'write',
    'tag' => 'Users',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  140 =>
  [
    'operation' => 'get_users_me',
    'slug' => 'box_get_users_me',
    'class' => 'BoxGetUsersMe',
    'method' => 'GET',
    'path' => '/users/me',
    'name' => 'Get current user',
    'description' => 'Execute official Box API operation `get_users_me`.

Endpoint: GET /users/me.',
    'type' => 'read',
    'tag' => 'Users',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  141 =>
  [
    'operation' => 'post_users_terminate_sessions',
    'slug' => 'box_post_users_terminate_sessions',
    'class' => 'BoxPostUsersTerminateSessions',
    'method' => 'POST',
    'path' => '/users/terminate_sessions',
    'name' => 'Create jobs to terminate users session',
    'description' => 'Execute official Box API operation `post_users_terminate_sessions`.

Endpoint: POST /users/terminate_sessions.',
    'type' => 'write',
    'tag' => 'Session termination',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  142 =>
  [
    'operation' => 'get_users_id',
    'slug' => 'box_get_users_id',
    'class' => 'BoxGetUsersId',
    'method' => 'GET',
    'path' => '/users/{user_id}',
    'name' => 'Get user',
    'description' => 'Execute official Box API operation `get_users_id`.

Endpoint: GET /users/{user_id}.',
    'type' => 'read',
    'tag' => 'Users',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  143 =>
  [
    'operation' => 'put_users_id',
    'slug' => 'box_put_users_id',
    'class' => 'BoxPutUsersId',
    'method' => 'PUT',
    'path' => '/users/{user_id}',
    'name' => 'Update user',
    'description' => 'Execute official Box API operation `put_users_id`.

Endpoint: PUT /users/{user_id}.',
    'type' => 'write',
    'tag' => 'Users',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  144 =>
  [
    'operation' => 'delete_users_id',
    'slug' => 'box_delete_users_id',
    'class' => 'BoxDeleteUsersId',
    'method' => 'DELETE',
    'path' => '/users/{user_id}',
    'name' => 'Delete user',
    'description' => 'Execute official Box API operation `delete_users_id`.

Endpoint: DELETE /users/{user_id}.',
    'type' => 'write',
    'tag' => 'Users',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
      1 =>
      [
        'name' => 'notify',
        'param' => 'notify',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether the user will receive email notification of the deletion.',
      ],
      2 =>
      [
        'name' => 'force',
        'param' => 'force',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Specifies whether to delete the user even if they still own files.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  145 =>
  [
    'operation' => 'get_users_id_avatar',
    'slug' => 'box_get_users_id_avatar',
    'class' => 'BoxGetUsersIdAvatar',
    'method' => 'GET',
    'path' => '/users/{user_id}/avatar',
    'name' => 'Get user avatar',
    'description' => 'Execute official Box API operation `get_users_id_avatar`.

Endpoint: GET /users/{user_id}/avatar.',
    'type' => 'read',
    'tag' => 'User avatars',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  146 =>
  [
    'operation' => 'post_users_id_avatar',
    'slug' => 'box_post_users_id_avatar',
    'class' => 'BoxPostUsersIdAvatar',
    'method' => 'POST',
    'path' => '/users/{user_id}/avatar',
    'name' => 'Add or update user avatar',
    'description' => 'Execute official Box API operation `post_users_id_avatar`.

Endpoint: POST /users/{user_id}/avatar.',
    'type' => 'write',
    'tag' => 'User avatars',
    'base' => 'api',
    'body_content_type' => 'multipart/form-data',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  147 =>
  [
    'operation' => 'delete_users_id_avatar',
    'slug' => 'box_delete_users_id_avatar',
    'class' => 'BoxDeleteUsersIdAvatar',
    'method' => 'DELETE',
    'path' => '/users/{user_id}/avatar',
    'name' => 'Delete user avatar',
    'description' => 'Execute official Box API operation `delete_users_id_avatar`.

Endpoint: DELETE /users/{user_id}/avatar.',
    'type' => 'write',
    'tag' => 'User avatars',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  148 =>
  [
    'operation' => 'put_users_id_folders_0',
    'slug' => 'box_put_users_id_folders_0',
    'class' => 'BoxPutUsersIdFolders0',
    'method' => 'PUT',
    'path' => '/users/{user_id}/folders/0',
    'name' => 'Transfer owned folders',
    'description' => 'Execute official Box API operation `put_users_id_folders_0`.

Endpoint: PUT /users/{user_id}/folders/0.',
    'type' => 'write',
    'tag' => 'Transfer folders',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'notify',
        'param' => 'notify',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines if users should receive email notification for the action performed.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  149 =>
  [
    'operation' => 'get_users_id_email_aliases',
    'slug' => 'box_get_users_id_email_aliases',
    'class' => 'BoxGetUsersIdEmailAliases',
    'method' => 'GET',
    'path' => '/users/{user_id}/email_aliases',
    'name' => 'List user\'s email aliases',
    'description' => 'Execute official Box API operation `get_users_id_email_aliases`.

Endpoint: GET /users/{user_id}/email_aliases.',
    'type' => 'read',
    'tag' => 'Email aliases',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  150 =>
  [
    'operation' => 'post_users_id_email_aliases',
    'slug' => 'box_post_users_id_email_aliases',
    'class' => 'BoxPostUsersIdEmailAliases',
    'method' => 'POST',
    'path' => '/users/{user_id}/email_aliases',
    'name' => 'Create email alias',
    'description' => 'Execute official Box API operation `post_users_id_email_aliases`.

Endpoint: POST /users/{user_id}/email_aliases.',
    'type' => 'write',
    'tag' => 'Email aliases',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  151 =>
  [
    'operation' => 'delete_users_id_email_aliases_id',
    'slug' => 'box_delete_users_id_email_aliases_id',
    'class' => 'BoxDeleteUsersIdEmailAliasesId',
    'method' => 'DELETE',
    'path' => '/users/{user_id}/email_aliases/{email_alias_id}',
    'name' => 'Remove email alias',
    'description' => 'Execute official Box API operation `delete_users_id_email_aliases_id`.

Endpoint: DELETE /users/{user_id}/email_aliases/{email_alias_id}.',
    'type' => 'write',
    'tag' => 'Email aliases',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
      1 =>
      [
        'name' => 'email_alias_id',
        'param' => 'email_alias_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the email alias.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  152 =>
  [
    'operation' => 'get_users_id_memberships',
    'slug' => 'box_get_users_id_memberships',
    'class' => 'BoxGetUsersIdMemberships',
    'method' => 'GET',
    'path' => '/users/{user_id}/memberships',
    'name' => 'List user\'s groups',
    'description' => 'Execute official Box API operation `get_users_id_memberships`.

Endpoint: GET /users/{user_id}/memberships.',
    'type' => 'read',
    'tag' => 'Group memberships',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  153 =>
  [
    'operation' => 'post_invites',
    'slug' => 'box_post_invites',
    'class' => 'BoxPostInvites',
    'method' => 'POST',
    'path' => '/invites',
    'name' => 'Create user invite',
    'description' => 'Execute official Box API operation `post_invites`.

Endpoint: POST /invites.',
    'type' => 'write',
    'tag' => 'Invites',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  154 =>
  [
    'operation' => 'get_invites_id',
    'slug' => 'box_get_invites_id',
    'class' => 'BoxGetInvitesId',
    'method' => 'GET',
    'path' => '/invites/{invite_id}',
    'name' => 'Get user invite status',
    'description' => 'Execute official Box API operation `get_invites_id`.

Endpoint: GET /invites/{invite_id}.',
    'type' => 'read',
    'tag' => 'Invites',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'invite_id',
        'param' => 'invite_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of an invite.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  155 =>
  [
    'operation' => 'get_groups',
    'slug' => 'box_get_groups',
    'class' => 'BoxGetGroups',
    'method' => 'GET',
    'path' => '/groups',
    'name' => 'List groups for enterprise',
    'description' => 'Execute official Box API operation `get_groups`.

Endpoint: GET /groups.',
    'type' => 'read',
    'tag' => 'Groups',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'filter_term',
        'param' => 'filter_term',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits the results to only groups whose `name` starts with the search term.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  156 =>
  [
    'operation' => 'post_groups',
    'slug' => 'box_post_groups',
    'class' => 'BoxPostGroups',
    'method' => 'POST',
    'path' => '/groups',
    'name' => 'Create group',
    'description' => 'Execute official Box API operation `post_groups`.

Endpoint: POST /groups.',
    'type' => 'write',
    'tag' => 'Groups',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  157 =>
  [
    'operation' => 'post_groups_terminate_sessions',
    'slug' => 'box_post_groups_terminate_sessions',
    'class' => 'BoxPostGroupsTerminateSessions',
    'method' => 'POST',
    'path' => '/groups/terminate_sessions',
    'name' => 'Create jobs to terminate user group session',
    'description' => 'Execute official Box API operation `post_groups_terminate_sessions`.

Endpoint: POST /groups/terminate_sessions.',
    'type' => 'write',
    'tag' => 'Session termination',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  158 =>
  [
    'operation' => 'get_groups_id',
    'slug' => 'box_get_groups_id',
    'class' => 'BoxGetGroupsId',
    'method' => 'GET',
    'path' => '/groups/{group_id}',
    'name' => 'Get group',
    'description' => 'Execute official Box API operation `get_groups_id`.

Endpoint: GET /groups/{group_id}.',
    'type' => 'read',
    'tag' => 'Groups',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'group_id',
        'param' => 'group_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  159 =>
  [
    'operation' => 'put_groups_id',
    'slug' => 'box_put_groups_id',
    'class' => 'BoxPutGroupsId',
    'method' => 'PUT',
    'path' => '/groups/{group_id}',
    'name' => 'Update group',
    'description' => 'Execute official Box API operation `put_groups_id`.

Endpoint: PUT /groups/{group_id}.',
    'type' => 'write',
    'tag' => 'Groups',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'group_id',
        'param' => 'group_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  160 =>
  [
    'operation' => 'delete_groups_id',
    'slug' => 'box_delete_groups_id',
    'class' => 'BoxDeleteGroupsId',
    'method' => 'DELETE',
    'path' => '/groups/{group_id}',
    'name' => 'Remove group',
    'description' => 'Execute official Box API operation `delete_groups_id`.

Endpoint: DELETE /groups/{group_id}.',
    'type' => 'write',
    'tag' => 'Groups',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'group_id',
        'param' => 'group_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  161 =>
  [
    'operation' => 'get_groups_id_memberships',
    'slug' => 'box_get_groups_id_memberships',
    'class' => 'BoxGetGroupsIdMemberships',
    'method' => 'GET',
    'path' => '/groups/{group_id}/memberships',
    'name' => 'List members of group',
    'description' => 'Execute official Box API operation `get_groups_id_memberships`.

Endpoint: GET /groups/{group_id}/memberships.',
    'type' => 'read',
    'tag' => 'Group memberships',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'group_id',
        'param' => 'group_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  162 =>
  [
    'operation' => 'get_groups_id_collaborations',
    'slug' => 'box_get_groups_id_collaborations',
    'class' => 'BoxGetGroupsIdCollaborations',
    'method' => 'GET',
    'path' => '/groups/{group_id}/collaborations',
    'name' => 'List group collaborations',
    'description' => 'Execute official Box API operation `get_groups_id_collaborations`.

Endpoint: GET /groups/{group_id}/collaborations.',
    'type' => 'read',
    'tag' => 'Collaborations (List)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'group_id',
        'param' => 'group_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  163 =>
  [
    'operation' => 'post_group_memberships',
    'slug' => 'box_post_group_memberships',
    'class' => 'BoxPostGroupMemberships',
    'method' => 'POST',
    'path' => '/group_memberships',
    'name' => 'Add user to group',
    'description' => 'Execute official Box API operation `post_group_memberships`.

Endpoint: POST /group_memberships.',
    'type' => 'write',
    'tag' => 'Group memberships',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  164 =>
  [
    'operation' => 'get_group_memberships_id',
    'slug' => 'box_get_group_memberships_id',
    'class' => 'BoxGetGroupMembershipsId',
    'method' => 'GET',
    'path' => '/group_memberships/{group_membership_id}',
    'name' => 'Get group membership',
    'description' => 'Execute official Box API operation `get_group_memberships_id`.

Endpoint: GET /group_memberships/{group_membership_id}.',
    'type' => 'read',
    'tag' => 'Group memberships',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'group_membership_id',
        'param' => 'group_membership_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group membership.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  165 =>
  [
    'operation' => 'put_group_memberships_id',
    'slug' => 'box_put_group_memberships_id',
    'class' => 'BoxPutGroupMembershipsId',
    'method' => 'PUT',
    'path' => '/group_memberships/{group_membership_id}',
    'name' => 'Update group membership',
    'description' => 'Execute official Box API operation `put_group_memberships_id`.

Endpoint: PUT /group_memberships/{group_membership_id}.',
    'type' => 'write',
    'tag' => 'Group memberships',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'group_membership_id',
        'param' => 'group_membership_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group membership.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  166 =>
  [
    'operation' => 'delete_group_memberships_id',
    'slug' => 'box_delete_group_memberships_id',
    'class' => 'BoxDeleteGroupMembershipsId',
    'method' => 'DELETE',
    'path' => '/group_memberships/{group_membership_id}',
    'name' => 'Remove user from group',
    'description' => 'Execute official Box API operation `delete_group_memberships_id`.

Endpoint: DELETE /group_memberships/{group_membership_id}.',
    'type' => 'write',
    'tag' => 'Group memberships',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'group_membership_id',
        'param' => 'group_membership_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group membership.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  167 =>
  [
    'operation' => 'get_webhooks',
    'slug' => 'box_get_webhooks',
    'class' => 'BoxGetWebhooks',
    'method' => 'GET',
    'path' => '/webhooks',
    'name' => 'List all webhooks',
    'description' => 'Execute official Box API operation `get_webhooks`.

Endpoint: GET /webhooks.',
    'type' => 'read',
    'tag' => 'Webhooks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  168 =>
  [
    'operation' => 'post_webhooks',
    'slug' => 'box_post_webhooks',
    'class' => 'BoxPostWebhooks',
    'method' => 'POST',
    'path' => '/webhooks',
    'name' => 'Create webhook',
    'description' => 'Execute official Box API operation `post_webhooks`.

Endpoint: POST /webhooks.',
    'type' => 'write',
    'tag' => 'Webhooks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  169 =>
  [
    'operation' => 'get_webhooks_id',
    'slug' => 'box_get_webhooks_id',
    'class' => 'BoxGetWebhooksId',
    'method' => 'GET',
    'path' => '/webhooks/{webhook_id}',
    'name' => 'Get webhook',
    'description' => 'Execute official Box API operation `get_webhooks_id`.

Endpoint: GET /webhooks/{webhook_id}.',
    'type' => 'read',
    'tag' => 'Webhooks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'webhook_id',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the webhook.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  170 =>
  [
    'operation' => 'put_webhooks_id',
    'slug' => 'box_put_webhooks_id',
    'class' => 'BoxPutWebhooksId',
    'method' => 'PUT',
    'path' => '/webhooks/{webhook_id}',
    'name' => 'Update webhook',
    'description' => 'Execute official Box API operation `put_webhooks_id`.

Endpoint: PUT /webhooks/{webhook_id}.',
    'type' => 'write',
    'tag' => 'Webhooks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'webhook_id',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the webhook.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  171 =>
  [
    'operation' => 'delete_webhooks_id',
    'slug' => 'box_delete_webhooks_id',
    'class' => 'BoxDeleteWebhooksId',
    'method' => 'DELETE',
    'path' => '/webhooks/{webhook_id}',
    'name' => 'Remove webhook',
    'description' => 'Execute official Box API operation `delete_webhooks_id`.

Endpoint: DELETE /webhooks/{webhook_id}.',
    'type' => 'write',
    'tag' => 'Webhooks',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'webhook_id',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the webhook.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  172 =>
  [
    'operation' => 'put_skill_invocations_id',
    'slug' => 'box_put_skill_invocations_id',
    'class' => 'BoxPutSkillInvocationsId',
    'method' => 'PUT',
    'path' => '/skill_invocations/{skill_id}',
    'name' => 'Update all Box Skill cards on file',
    'description' => 'Execute official Box API operation `put_skill_invocations_id`.

Endpoint: PUT /skill_invocations/{skill_id}.',
    'type' => 'write',
    'tag' => 'Skills',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'skill_id',
        'param' => 'skill_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the skill to apply this metadata for.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  173 =>
  [
    'operation' => 'get_events',
    'slug' => 'box_get_events',
    'class' => 'BoxGetEvents',
    'method' => 'GET',
    'path' => '/events',
    'name' => 'List user and enterprise events',
    'description' => 'Execute official Box API operation `get_events`.

Endpoint: GET /events.',
    'type' => 'read',
    'tag' => 'Events',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'stream_type',
        'param' => 'stream_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the type of events that are returned * `all` returns everything for a user and is the default * `changes` returns events that may cause file tree changes such as file up...',
      ],
      1 =>
      [
        'name' => 'stream_position',
        'param' => 'stream_position',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The location in the event stream to start receiving events from. * `now` will return an empty list events and the latest stream position for initialization. * `0` or `null` will...',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Limits the number of events returned. Note: Sometimes, the events less than the limit requested can be returned even when there may be more events remaining. This is primarily d...',
      ],
      3 =>
      [
        'name' => 'event_type',
        'param' => 'event_type',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of events to filter by. This can only be used when requesting the events with a `stream_type` of `admin_logs` or `adming_logs_streaming`. For any other `s...',
      ],
      4 =>
      [
        'name' => 'created_after',
        'param' => 'created_after',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The lower bound date and time to return events for. This can only be used when requesting the events with a `stream_type` of `admin_logs`. For any other `stream_type` this value...',
      ],
      5 =>
      [
        'name' => 'created_before',
        'param' => 'created_before',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The upper bound date and time to return events for. This can only be used when requesting the events with a `stream_type` of `admin_logs`. For any other `stream_type` this value...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  174 =>
  [
    'operation' => 'get_collections',
    'slug' => 'box_get_collections',
    'class' => 'BoxGetCollections',
    'method' => 'GET',
    'path' => '/collections',
    'name' => 'List all collections',
    'description' => 'Execute official Box API operation `get_collections`.

Endpoint: GET /collections.',
    'type' => 'read',
    'tag' => 'Collections',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  175 =>
  [
    'operation' => 'get_collections_id_items',
    'slug' => 'box_get_collections_id_items',
    'class' => 'BoxGetCollectionsIdItems',
    'method' => 'GET',
    'path' => '/collections/{collection_id}/items',
    'name' => 'List collection items',
    'description' => 'Execute official Box API operation `get_collections_id_items`.

Endpoint: GET /collections/{collection_id}/items.',
    'type' => 'read',
    'tag' => 'Collections',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collection_id',
        'param' => 'collection_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the collection.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The offset of the item at which to begin the response. Queries with offset parameter value exceeding 10000 will be rejected with a 400 response.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  176 =>
  [
    'operation' => 'get_collections_id',
    'slug' => 'box_get_collections_id',
    'class' => 'BoxGetCollectionsId',
    'method' => 'GET',
    'path' => '/collections/{collection_id}',
    'name' => 'Get collection by ID',
    'description' => 'Execute official Box API operation `get_collections_id`.

Endpoint: GET /collections/{collection_id}.',
    'type' => 'read',
    'tag' => 'Collections',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collection_id',
        'param' => 'collection_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the collection.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  177 =>
  [
    'operation' => 'get_recent_items',
    'slug' => 'box_get_recent_items',
    'class' => 'BoxGetRecentItems',
    'method' => 'GET',
    'path' => '/recent_items',
    'name' => 'List recently accessed items',
    'description' => 'Execute official Box API operation `get_recent_items`.

Endpoint: GET /recent_items.',
    'type' => 'read',
    'tag' => 'Recent items',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  178 =>
  [
    'operation' => 'get_retention_policies',
    'slug' => 'box_get_retention_policies',
    'class' => 'BoxGetRetentionPolicies',
    'method' => 'GET',
    'path' => '/retention_policies',
    'name' => 'List retention policies',
    'description' => 'Execute official Box API operation `get_retention_policies`.

Endpoint: GET /retention_policies.',
    'type' => 'read',
    'tag' => 'Retention policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'policy_name',
        'param' => 'policy_name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by a case sensitive prefix of the name of retention policies.',
      ],
      1 =>
      [
        'name' => 'policy_type',
        'param' => 'policy_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by the type of retention policy.',
      ],
      2 =>
      [
        'name' => 'created_by_user_id',
        'param' => 'created_by_user_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by the ID of the user who created policy.',
      ],
      3 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      5 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  179 =>
  [
    'operation' => 'post_retention_policies',
    'slug' => 'box_post_retention_policies',
    'class' => 'BoxPostRetentionPolicies',
    'method' => 'POST',
    'path' => '/retention_policies',
    'name' => 'Create retention policy',
    'description' => 'Execute official Box API operation `post_retention_policies`.

Endpoint: POST /retention_policies.',
    'type' => 'write',
    'tag' => 'Retention policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  180 =>
  [
    'operation' => 'get_retention_policies_id',
    'slug' => 'box_get_retention_policies_id',
    'class' => 'BoxGetRetentionPoliciesId',
    'method' => 'GET',
    'path' => '/retention_policies/{retention_policy_id}',
    'name' => 'Get retention policy',
    'description' => 'Execute official Box API operation `get_retention_policies_id`.

Endpoint: GET /retention_policies/{retention_policy_id}.',
    'type' => 'read',
    'tag' => 'Retention policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'retention_policy_id',
        'param' => 'retention_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the retention policy.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  181 =>
  [
    'operation' => 'put_retention_policies_id',
    'slug' => 'box_put_retention_policies_id',
    'class' => 'BoxPutRetentionPoliciesId',
    'method' => 'PUT',
    'path' => '/retention_policies/{retention_policy_id}',
    'name' => 'Update retention policy',
    'description' => 'Execute official Box API operation `put_retention_policies_id`.

Endpoint: PUT /retention_policies/{retention_policy_id}.',
    'type' => 'write',
    'tag' => 'Retention policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'retention_policy_id',
        'param' => 'retention_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the retention policy.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  182 =>
  [
    'operation' => 'delete_retention_policies_id',
    'slug' => 'box_delete_retention_policies_id',
    'class' => 'BoxDeleteRetentionPoliciesId',
    'method' => 'DELETE',
    'path' => '/retention_policies/{retention_policy_id}',
    'name' => 'Delete retention policy',
    'description' => 'Execute official Box API operation `delete_retention_policies_id`.

Endpoint: DELETE /retention_policies/{retention_policy_id}.',
    'type' => 'write',
    'tag' => 'Retention policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'retention_policy_id',
        'param' => 'retention_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the retention policy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  183 =>
  [
    'operation' => 'get_retention_policies_id_assignments',
    'slug' => 'box_get_retention_policies_id_assignments',
    'class' => 'BoxGetRetentionPoliciesIdAssignments',
    'method' => 'GET',
    'path' => '/retention_policies/{retention_policy_id}/assignments',
    'name' => 'List retention policy assignments',
    'description' => 'Execute official Box API operation `get_retention_policies_id_assignments`.

Endpoint: GET /retention_policies/{retention_policy_id}/assignments.',
    'type' => 'read',
    'tag' => 'Retention policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'retention_policy_id',
        'param' => 'retention_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the retention policy.',
      ],
      1 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the retention policy assignment to retrieve.',
      ],
      2 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      3 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination.',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  184 =>
  [
    'operation' => 'post_retention_policy_assignments',
    'slug' => 'box_post_retention_policy_assignments',
    'class' => 'BoxPostRetentionPolicyAssignments',
    'method' => 'POST',
    'path' => '/retention_policy_assignments',
    'name' => 'Assign retention policy',
    'description' => 'Execute official Box API operation `post_retention_policy_assignments`.

Endpoint: POST /retention_policy_assignments.',
    'type' => 'write',
    'tag' => 'Retention policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  185 =>
  [
    'operation' => 'get_retention_policy_assignments_id',
    'slug' => 'box_get_retention_policy_assignments_id',
    'class' => 'BoxGetRetentionPolicyAssignmentsId',
    'method' => 'GET',
    'path' => '/retention_policy_assignments/{retention_policy_assignment_id}',
    'name' => 'Get retention policy assignment',
    'description' => 'Execute official Box API operation `get_retention_policy_assignments_id`.

Endpoint: GET /retention_policy_assignments/{retention_policy_assignment_id}.',
    'type' => 'read',
    'tag' => 'Retention policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'retention_policy_assignment_id',
        'param' => 'retention_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the retention policy assignment.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  186 =>
  [
    'operation' => 'delete_retention_policy_assignments_id',
    'slug' => 'box_delete_retention_policy_assignments_id',
    'class' => 'BoxDeleteRetentionPolicyAssignmentsId',
    'method' => 'DELETE',
    'path' => '/retention_policy_assignments/{retention_policy_assignment_id}',
    'name' => 'Remove retention policy assignment',
    'description' => 'Execute official Box API operation `delete_retention_policy_assignments_id`.

Endpoint: DELETE /retention_policy_assignments/{retention_policy_assignment_id}.',
    'type' => 'write',
    'tag' => 'Retention policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'retention_policy_assignment_id',
        'param' => 'retention_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the retention policy assignment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  187 =>
  [
    'operation' => 'get_retention_policy_assignments_id_files_under_retention',
    'slug' => 'box_get_retention_policy_assignments_id_files_under_retention',
    'class' => 'BoxGetRetentionPolicyAssignmentsIdFilesUnderRetention',
    'method' => 'GET',
    'path' => '/retention_policy_assignments/{retention_policy_assignment_id}/files_under_retention',
    'name' => 'Get files under retention',
    'description' => 'Execute official Box API operation `get_retention_policy_assignments_id_files_under_retention`.

Endpoint: GET /retention_policy_assignments/{retention_policy_assignment_id}/files_under_retention.',
    'type' => 'read',
    'tag' => 'Retention policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'retention_policy_assignment_id',
        'param' => 'retention_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the retention policy assignment.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  188 =>
  [
    'operation' => 'get_retention_policy_assignments_id_file_versions_under_retention',
    'slug' => 'box_get_retention_policy_assignments_id_file_versions_under_retention',
    'class' => 'BoxGetRetentionPolicyAssignmentsIdFileVersionsUnderRetention',
    'method' => 'GET',
    'path' => '/retention_policy_assignments/{retention_policy_assignment_id}/file_versions_under_retention',
    'name' => 'Get file versions under retention',
    'description' => 'Execute official Box API operation `get_retention_policy_assignments_id_file_versions_under_retention`.

Endpoint: GET /retention_policy_assignments/{retention_policy_assignment_id}/file_versions_under_retention.',
    'type' => 'read',
    'tag' => 'Retention policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'retention_policy_assignment_id',
        'param' => 'retention_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the retention policy assignment.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  189 =>
  [
    'operation' => 'get_legal_hold_policies',
    'slug' => 'box_get_legal_hold_policies',
    'class' => 'BoxGetLegalHoldPolicies',
    'method' => 'GET',
    'path' => '/legal_hold_policies',
    'name' => 'List all legal hold policies',
    'description' => 'Execute official Box API operation `get_legal_hold_policies`.

Endpoint: GET /legal_hold_policies.',
    'type' => 'read',
    'tag' => 'Legal hold policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'policy_name',
        'param' => 'policy_name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits results to policies for which the names start with this search term. This is a case-insensitive prefix.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      2 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  190 =>
  [
    'operation' => 'post_legal_hold_policies',
    'slug' => 'box_post_legal_hold_policies',
    'class' => 'BoxPostLegalHoldPolicies',
    'method' => 'POST',
    'path' => '/legal_hold_policies',
    'name' => 'Create legal hold policy',
    'description' => 'Execute official Box API operation `post_legal_hold_policies`.

Endpoint: POST /legal_hold_policies.',
    'type' => 'write',
    'tag' => 'Legal hold policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  191 =>
  [
    'operation' => 'get_legal_hold_policies_id',
    'slug' => 'box_get_legal_hold_policies_id',
    'class' => 'BoxGetLegalHoldPoliciesId',
    'method' => 'GET',
    'path' => '/legal_hold_policies/{legal_hold_policy_id}',
    'name' => 'Get legal hold policy',
    'description' => 'Execute official Box API operation `get_legal_hold_policies_id`.

Endpoint: GET /legal_hold_policies/{legal_hold_policy_id}.',
    'type' => 'read',
    'tag' => 'Legal hold policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'legal_hold_policy_id',
        'param' => 'legal_hold_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  192 =>
  [
    'operation' => 'put_legal_hold_policies_id',
    'slug' => 'box_put_legal_hold_policies_id',
    'class' => 'BoxPutLegalHoldPoliciesId',
    'method' => 'PUT',
    'path' => '/legal_hold_policies/{legal_hold_policy_id}',
    'name' => 'Update legal hold policy',
    'description' => 'Execute official Box API operation `put_legal_hold_policies_id`.

Endpoint: PUT /legal_hold_policies/{legal_hold_policy_id}.',
    'type' => 'write',
    'tag' => 'Legal hold policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'legal_hold_policy_id',
        'param' => 'legal_hold_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  193 =>
  [
    'operation' => 'delete_legal_hold_policies_id',
    'slug' => 'box_delete_legal_hold_policies_id',
    'class' => 'BoxDeleteLegalHoldPoliciesId',
    'method' => 'DELETE',
    'path' => '/legal_hold_policies/{legal_hold_policy_id}',
    'name' => 'Remove legal hold policy',
    'description' => 'Execute official Box API operation `delete_legal_hold_policies_id`.

Endpoint: DELETE /legal_hold_policies/{legal_hold_policy_id}.',
    'type' => 'write',
    'tag' => 'Legal hold policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'legal_hold_policy_id',
        'param' => 'legal_hold_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  194 =>
  [
    'operation' => 'get_legal_hold_policy_assignments',
    'slug' => 'box_get_legal_hold_policy_assignments',
    'class' => 'BoxGetLegalHoldPolicyAssignments',
    'method' => 'GET',
    'path' => '/legal_hold_policy_assignments',
    'name' => 'List legal hold policy assignments',
    'description' => 'Execute official Box API operation `get_legal_hold_policy_assignments`.

Endpoint: GET /legal_hold_policy_assignments.',
    'type' => 'read',
    'tag' => 'Legal hold policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'policy_id',
        'param' => 'policy_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy.',
      ],
      1 =>
      [
        'name' => 'assign_to_type',
        'param' => 'assign_to_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters the results by the type of item the policy was applied to.',
      ],
      2 =>
      [
        'name' => 'assign_to_id',
        'param' => 'assign_to_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters the results by the ID of item the policy was applied to.',
      ],
      3 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      5 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  195 =>
  [
    'operation' => 'post_legal_hold_policy_assignments',
    'slug' => 'box_post_legal_hold_policy_assignments',
    'class' => 'BoxPostLegalHoldPolicyAssignments',
    'method' => 'POST',
    'path' => '/legal_hold_policy_assignments',
    'name' => 'Assign legal hold policy',
    'description' => 'Execute official Box API operation `post_legal_hold_policy_assignments`.

Endpoint: POST /legal_hold_policy_assignments.',
    'type' => 'write',
    'tag' => 'Legal hold policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  196 =>
  [
    'operation' => 'get_legal_hold_policy_assignments_id',
    'slug' => 'box_get_legal_hold_policy_assignments_id',
    'class' => 'BoxGetLegalHoldPolicyAssignmentsId',
    'method' => 'GET',
    'path' => '/legal_hold_policy_assignments/{legal_hold_policy_assignment_id}',
    'name' => 'Get legal hold policy assignment',
    'description' => 'Execute official Box API operation `get_legal_hold_policy_assignments_id`.

Endpoint: GET /legal_hold_policy_assignments/{legal_hold_policy_assignment_id}.',
    'type' => 'read',
    'tag' => 'Legal hold policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'legal_hold_policy_assignment_id',
        'param' => 'legal_hold_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy assignment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  197 =>
  [
    'operation' => 'delete_legal_hold_policy_assignments_id',
    'slug' => 'box_delete_legal_hold_policy_assignments_id',
    'class' => 'BoxDeleteLegalHoldPolicyAssignmentsId',
    'method' => 'DELETE',
    'path' => '/legal_hold_policy_assignments/{legal_hold_policy_assignment_id}',
    'name' => 'Unassign legal hold policy',
    'description' => 'Execute official Box API operation `delete_legal_hold_policy_assignments_id`.

Endpoint: DELETE /legal_hold_policy_assignments/{legal_hold_policy_assignment_id}.',
    'type' => 'write',
    'tag' => 'Legal hold policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'legal_hold_policy_assignment_id',
        'param' => 'legal_hold_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy assignment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  198 =>
  [
    'operation' => 'get_legal_hold_policy_assignments_id_files_on_hold',
    'slug' => 'box_get_legal_hold_policy_assignments_id_files_on_hold',
    'class' => 'BoxGetLegalHoldPolicyAssignmentsIdFilesOnHold',
    'method' => 'GET',
    'path' => '/legal_hold_policy_assignments/{legal_hold_policy_assignment_id}/files_on_hold',
    'name' => 'List files with current file versions for legal hold policy assignment',
    'description' => 'Execute official Box API operation `get_legal_hold_policy_assignments_id_files_on_hold`.

Endpoint: GET /legal_hold_policy_assignments/{legal_hold_policy_assignment_id}/files_on_hold.',
    'type' => 'read',
    'tag' => 'Legal hold policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'legal_hold_policy_assignment_id',
        'param' => 'legal_hold_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy assignment.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  199 =>
  [
    'operation' => 'get_file_version_retentions',
    'slug' => 'box_get_file_version_retentions',
    'class' => 'BoxGetFileVersionRetentions',
    'method' => 'GET',
    'path' => '/file_version_retentions',
    'name' => 'List file version retentions',
    'description' => 'Execute official Box API operation `get_file_version_retentions`.

Endpoint: GET /file_version_retentions.',
    'type' => 'read',
    'tag' => 'File version retentions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_id',
        'param' => 'file_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by files with this ID.',
      ],
      1 =>
      [
        'name' => 'file_version_id',
        'param' => 'file_version_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by file versions with this ID.',
      ],
      2 =>
      [
        'name' => 'policy_id',
        'param' => 'policy_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by the retention policy with this ID.',
      ],
      3 =>
      [
        'name' => 'disposition_action',
        'param' => 'disposition_action',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by the retention policy with this disposition action.',
      ],
      4 =>
      [
        'name' => 'disposition_before',
        'param' => 'disposition_before',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by files that will have their disposition come into effect before this date.',
      ],
      5 =>
      [
        'name' => 'disposition_after',
        'param' => 'disposition_after',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters results by files that will have their disposition come into effect after this date.',
      ],
      6 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      7 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  200 =>
  [
    'operation' => 'get_legal_hold_policy_assignments_id_file_versions_on_hold',
    'slug' => 'box_get_legal_hold_policy_assignments_id_file_versions_on_hold',
    'class' => 'BoxGetLegalHoldPolicyAssignmentsIdFileVersionsOnHold',
    'method' => 'GET',
    'path' => '/legal_hold_policy_assignments/{legal_hold_policy_assignment_id}/file_versions_on_hold',
    'name' => 'List previous file versions for legal hold policy assignment',
    'description' => 'Execute official Box API operation `get_legal_hold_policy_assignments_id_file_versions_on_hold`.

Endpoint: GET /legal_hold_policy_assignments/{legal_hold_policy_assignment_id}/file_versions_on_hold.',
    'type' => 'read',
    'tag' => 'Legal hold policy assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'legal_hold_policy_assignment_id',
        'param' => 'legal_hold_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy assignment.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  201 =>
  [
    'operation' => 'get_file_version_retentions_id',
    'slug' => 'box_get_file_version_retentions_id',
    'class' => 'BoxGetFileVersionRetentionsId',
    'method' => 'GET',
    'path' => '/file_version_retentions/{file_version_retention_id}',
    'name' => 'Get retention on file',
    'description' => 'Execute official Box API operation `get_file_version_retentions_id`.

Endpoint: GET /file_version_retentions/{file_version_retention_id}.',
    'type' => 'read',
    'tag' => 'File version retentions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_version_retention_id',
        'param' => 'file_version_retention_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the file version retention.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  202 =>
  [
    'operation' => 'get_file_version_legal_holds_id',
    'slug' => 'box_get_file_version_legal_holds_id',
    'class' => 'BoxGetFileVersionLegalHoldsId',
    'method' => 'GET',
    'path' => '/file_version_legal_holds/{file_version_legal_hold_id}',
    'name' => 'Get file version legal hold',
    'description' => 'Execute official Box API operation `get_file_version_legal_holds_id`.

Endpoint: GET /file_version_legal_holds/{file_version_legal_hold_id}.',
    'type' => 'read',
    'tag' => 'File version legal holds',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'file_version_legal_hold_id',
        'param' => 'file_version_legal_hold_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the file version legal hold.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  203 =>
  [
    'operation' => 'get_file_version_legal_holds',
    'slug' => 'box_get_file_version_legal_holds',
    'class' => 'BoxGetFileVersionLegalHolds',
    'method' => 'GET',
    'path' => '/file_version_legal_holds',
    'name' => 'List file version legal holds',
    'description' => 'Execute official Box API operation `get_file_version_legal_holds`.

Endpoint: GET /file_version_legal_holds.',
    'type' => 'read',
    'tag' => 'File version legal holds',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'policy_id',
        'param' => 'policy_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the legal hold policy to get the file version legal holds for.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  204 =>
  [
    'operation' => 'get_shield_information_barriers_id',
    'slug' => 'box_get_shield_information_barriers_id',
    'class' => 'BoxGetShieldInformationBarriersId',
    'method' => 'GET',
    'path' => '/shield_information_barriers/{shield_information_barrier_id}',
    'name' => 'Get shield information barrier with specified ID',
    'description' => 'Execute official Box API operation `get_shield_information_barriers_id`.

Endpoint: GET /shield_information_barriers/{shield_information_barrier_id}.',
    'type' => 'read',
    'tag' => 'Shield information barriers',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_id',
        'param' => 'shield_information_barrier_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  205 =>
  [
    'operation' => 'post_shield_information_barriers_change_status',
    'slug' => 'box_post_shield_information_barriers_change_status',
    'class' => 'BoxPostShieldInformationBarriersChangeStatus',
    'method' => 'POST',
    'path' => '/shield_information_barriers/change_status',
    'name' => 'Add changed status of shield information barrier with specified ID',
    'description' => 'Execute official Box API operation `post_shield_information_barriers_change_status`.

Endpoint: POST /shield_information_barriers/change_status.',
    'type' => 'write',
    'tag' => 'Shield information barriers',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  206 =>
  [
    'operation' => 'get_shield_information_barriers',
    'slug' => 'box_get_shield_information_barriers',
    'class' => 'BoxGetShieldInformationBarriers',
    'method' => 'GET',
    'path' => '/shield_information_barriers',
    'name' => 'List shield information barriers',
    'description' => 'Execute official Box API operation `get_shield_information_barriers`.

Endpoint: GET /shield_information_barriers.',
    'type' => 'read',
    'tag' => 'Shield information barriers',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  207 =>
  [
    'operation' => 'post_shield_information_barriers',
    'slug' => 'box_post_shield_information_barriers',
    'class' => 'BoxPostShieldInformationBarriers',
    'method' => 'POST',
    'path' => '/shield_information_barriers',
    'name' => 'Create shield information barrier',
    'description' => 'Execute official Box API operation `post_shield_information_barriers`.

Endpoint: POST /shield_information_barriers.',
    'type' => 'write',
    'tag' => 'Shield information barriers',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  208 =>
  [
    'operation' => 'get_shield_information_barrier_reports',
    'slug' => 'box_get_shield_information_barrier_reports',
    'class' => 'BoxGetShieldInformationBarrierReports',
    'method' => 'GET',
    'path' => '/shield_information_barrier_reports',
    'name' => 'List shield information barrier reports',
    'description' => 'Execute official Box API operation `get_shield_information_barrier_reports`.

Endpoint: GET /shield_information_barrier_reports.',
    'type' => 'read',
    'tag' => 'Shield information barrier reports',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_id',
        'param' => 'shield_information_barrier_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  209 =>
  [
    'operation' => 'post_shield_information_barrier_reports',
    'slug' => 'box_post_shield_information_barrier_reports',
    'class' => 'BoxPostShieldInformationBarrierReports',
    'method' => 'POST',
    'path' => '/shield_information_barrier_reports',
    'name' => 'Create shield information barrier report',
    'description' => 'Execute official Box API operation `post_shield_information_barrier_reports`.

Endpoint: POST /shield_information_barrier_reports.',
    'type' => 'write',
    'tag' => 'Shield information barrier reports',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  210 =>
  [
    'operation' => 'get_shield_information_barrier_reports_id',
    'slug' => 'box_get_shield_information_barrier_reports_id',
    'class' => 'BoxGetShieldInformationBarrierReportsId',
    'method' => 'GET',
    'path' => '/shield_information_barrier_reports/{shield_information_barrier_report_id}',
    'name' => 'Get shield information barrier report by ID',
    'description' => 'Execute official Box API operation `get_shield_information_barrier_reports_id`.

Endpoint: GET /shield_information_barrier_reports/{shield_information_barrier_report_id}.',
    'type' => 'read',
    'tag' => 'Shield information barrier reports',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_report_id',
        'param' => 'shield_information_barrier_report_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier Report.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  211 =>
  [
    'operation' => 'get_shield_information_barrier_segments_id',
    'slug' => 'box_get_shield_information_barrier_segments_id',
    'class' => 'BoxGetShieldInformationBarrierSegmentsId',
    'method' => 'GET',
    'path' => '/shield_information_barrier_segments/{shield_information_barrier_segment_id}',
    'name' => 'Get shield information barrier segment with specified ID',
    'description' => 'Execute official Box API operation `get_shield_information_barrier_segments_id`.

Endpoint: GET /shield_information_barrier_segments/{shield_information_barrier_segment_id}.',
    'type' => 'read',
    'tag' => 'Shield information barrier segments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_id',
        'param' => 'shield_information_barrier_segment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  212 =>
  [
    'operation' => 'delete_shield_information_barrier_segments_id',
    'slug' => 'box_delete_shield_information_barrier_segments_id',
    'class' => 'BoxDeleteShieldInformationBarrierSegmentsId',
    'method' => 'DELETE',
    'path' => '/shield_information_barrier_segments/{shield_information_barrier_segment_id}',
    'name' => 'Delete shield information barrier segment',
    'description' => 'Execute official Box API operation `delete_shield_information_barrier_segments_id`.

Endpoint: DELETE /shield_information_barrier_segments/{shield_information_barrier_segment_id}.',
    'type' => 'write',
    'tag' => 'Shield information barrier segments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_id',
        'param' => 'shield_information_barrier_segment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  213 =>
  [
    'operation' => 'put_shield_information_barrier_segments_id',
    'slug' => 'box_put_shield_information_barrier_segments_id',
    'class' => 'BoxPutShieldInformationBarrierSegmentsId',
    'method' => 'PUT',
    'path' => '/shield_information_barrier_segments/{shield_information_barrier_segment_id}',
    'name' => 'Update shield information barrier segment with specified ID',
    'description' => 'Execute official Box API operation `put_shield_information_barrier_segments_id`.

Endpoint: PUT /shield_information_barrier_segments/{shield_information_barrier_segment_id}.',
    'type' => 'write',
    'tag' => 'Shield information barrier segments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_id',
        'param' => 'shield_information_barrier_segment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  214 =>
  [
    'operation' => 'get_shield_information_barrier_segments',
    'slug' => 'box_get_shield_information_barrier_segments',
    'class' => 'BoxGetShieldInformationBarrierSegments',
    'method' => 'GET',
    'path' => '/shield_information_barrier_segments',
    'name' => 'List shield information barrier segments',
    'description' => 'Execute official Box API operation `get_shield_information_barrier_segments`.

Endpoint: GET /shield_information_barrier_segments.',
    'type' => 'read',
    'tag' => 'Shield information barrier segments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_id',
        'param' => 'shield_information_barrier_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  215 =>
  [
    'operation' => 'post_shield_information_barrier_segments',
    'slug' => 'box_post_shield_information_barrier_segments',
    'class' => 'BoxPostShieldInformationBarrierSegments',
    'method' => 'POST',
    'path' => '/shield_information_barrier_segments',
    'name' => 'Create shield information barrier segment',
    'description' => 'Execute official Box API operation `post_shield_information_barrier_segments`.

Endpoint: POST /shield_information_barrier_segments.',
    'type' => 'write',
    'tag' => 'Shield information barrier segments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  216 =>
  [
    'operation' => 'get_shield_information_barrier_segment_members_id',
    'slug' => 'box_get_shield_information_barrier_segment_members_id',
    'class' => 'BoxGetShieldInformationBarrierSegmentMembersId',
    'method' => 'GET',
    'path' => '/shield_information_barrier_segment_members/{shield_information_barrier_segment_member_id}',
    'name' => 'Get shield information barrier segment member by ID',
    'description' => 'Execute official Box API operation `get_shield_information_barrier_segment_members_id`.

Endpoint: GET /shield_information_barrier_segment_members/{shield_information_barrier_segment_member_id}.',
    'type' => 'read',
    'tag' => 'Shield information barrier segment members',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_member_id',
        'param' => 'shield_information_barrier_segment_member_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment Member.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  217 =>
  [
    'operation' => 'delete_shield_information_barrier_segment_members_id',
    'slug' => 'box_delete_shield_information_barrier_segment_members_id',
    'class' => 'BoxDeleteShieldInformationBarrierSegmentMembersId',
    'method' => 'DELETE',
    'path' => '/shield_information_barrier_segment_members/{shield_information_barrier_segment_member_id}',
    'name' => 'Delete shield information barrier segment member by ID',
    'description' => 'Execute official Box API operation `delete_shield_information_barrier_segment_members_id`.

Endpoint: DELETE /shield_information_barrier_segment_members/{shield_information_barrier_segment_member_id}.',
    'type' => 'write',
    'tag' => 'Shield information barrier segment members',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_member_id',
        'param' => 'shield_information_barrier_segment_member_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment Member.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  218 =>
  [
    'operation' => 'get_shield_information_barrier_segment_members',
    'slug' => 'box_get_shield_information_barrier_segment_members',
    'class' => 'BoxGetShieldInformationBarrierSegmentMembers',
    'method' => 'GET',
    'path' => '/shield_information_barrier_segment_members',
    'name' => 'List shield information barrier segment members',
    'description' => 'Execute official Box API operation `get_shield_information_barrier_segment_members`.

Endpoint: GET /shield_information_barrier_segment_members.',
    'type' => 'read',
    'tag' => 'Shield information barrier segment members',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_id',
        'param' => 'shield_information_barrier_segment_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  219 =>
  [
    'operation' => 'post_shield_information_barrier_segment_members',
    'slug' => 'box_post_shield_information_barrier_segment_members',
    'class' => 'BoxPostShieldInformationBarrierSegmentMembers',
    'method' => 'POST',
    'path' => '/shield_information_barrier_segment_members',
    'name' => 'Create shield information barrier segment member',
    'description' => 'Execute official Box API operation `post_shield_information_barrier_segment_members`.

Endpoint: POST /shield_information_barrier_segment_members.',
    'type' => 'write',
    'tag' => 'Shield information barrier segment members',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  220 =>
  [
    'operation' => 'get_shield_information_barrier_segment_restrictions_id',
    'slug' => 'box_get_shield_information_barrier_segment_restrictions_id',
    'class' => 'BoxGetShieldInformationBarrierSegmentRestrictionsId',
    'method' => 'GET',
    'path' => '/shield_information_barrier_segment_restrictions/{shield_information_barrier_segment_restriction_id}',
    'name' => 'Get shield information barrier segment restriction by ID',
    'description' => 'Execute official Box API operation `get_shield_information_barrier_segment_restrictions_id`.

Endpoint: GET /shield_information_barrier_segment_restrictions/{shield_information_barrier_segment_restriction_id}.',
    'type' => 'read',
    'tag' => 'Shield information barrier segment restrictions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_restriction_id',
        'param' => 'shield_information_barrier_segment_restriction_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment Restriction.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  221 =>
  [
    'operation' => 'delete_shield_information_barrier_segment_restrictions_id',
    'slug' => 'box_delete_shield_information_barrier_segment_restrictions_id',
    'class' => 'BoxDeleteShieldInformationBarrierSegmentRestrictionsId',
    'method' => 'DELETE',
    'path' => '/shield_information_barrier_segment_restrictions/{shield_information_barrier_segment_restriction_id}',
    'name' => 'Delete shield information barrier segment restriction by ID',
    'description' => 'Execute official Box API operation `delete_shield_information_barrier_segment_restrictions_id`.

Endpoint: DELETE /shield_information_barrier_segment_restrictions/{shield_information_barrier_segment_restriction_id}.',
    'type' => 'write',
    'tag' => 'Shield information barrier segment restrictions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_restriction_id',
        'param' => 'shield_information_barrier_segment_restriction_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment Restriction.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  222 =>
  [
    'operation' => 'get_shield_information_barrier_segment_restrictions',
    'slug' => 'box_get_shield_information_barrier_segment_restrictions',
    'class' => 'BoxGetShieldInformationBarrierSegmentRestrictions',
    'method' => 'GET',
    'path' => '/shield_information_barrier_segment_restrictions',
    'name' => 'List shield information barrier segment restrictions',
    'description' => 'Execute official Box API operation `get_shield_information_barrier_segment_restrictions`.

Endpoint: GET /shield_information_barrier_segment_restrictions.',
    'type' => 'read',
    'tag' => 'Shield information barrier segment restrictions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shield_information_barrier_segment_id',
        'param' => 'shield_information_barrier_segment_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the shield information barrier segment.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  223 =>
  [
    'operation' => 'post_shield_information_barrier_segment_restrictions',
    'slug' => 'box_post_shield_information_barrier_segment_restrictions',
    'class' => 'BoxPostShieldInformationBarrierSegmentRestrictions',
    'method' => 'POST',
    'path' => '/shield_information_barrier_segment_restrictions',
    'name' => 'Create shield information barrier segment restriction',
    'description' => 'Execute official Box API operation `post_shield_information_barrier_segment_restrictions`.

Endpoint: POST /shield_information_barrier_segment_restrictions.',
    'type' => 'write',
    'tag' => 'Shield information barrier segment restrictions',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  224 =>
  [
    'operation' => 'get_device_pinners_id',
    'slug' => 'box_get_device_pinners_id',
    'class' => 'BoxGetDevicePinnersId',
    'method' => 'GET',
    'path' => '/device_pinners/{device_pinner_id}',
    'name' => 'Get device pin',
    'description' => 'Execute official Box API operation `get_device_pinners_id`.

Endpoint: GET /device_pinners/{device_pinner_id}.',
    'type' => 'read',
    'tag' => 'Device pinners',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'device_pinner_id',
        'param' => 'device_pinner_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the device pin.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  225 =>
  [
    'operation' => 'delete_device_pinners_id',
    'slug' => 'box_delete_device_pinners_id',
    'class' => 'BoxDeleteDevicePinnersId',
    'method' => 'DELETE',
    'path' => '/device_pinners/{device_pinner_id}',
    'name' => 'Remove device pin',
    'description' => 'Execute official Box API operation `delete_device_pinners_id`.

Endpoint: DELETE /device_pinners/{device_pinner_id}.',
    'type' => 'write',
    'tag' => 'Device pinners',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'device_pinner_id',
        'param' => 'device_pinner_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the device pin.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  226 =>
  [
    'operation' => 'get_enterprises_id_device_pinners',
    'slug' => 'box_get_enterprises_id_device_pinners',
    'class' => 'BoxGetEnterprisesIdDevicePinners',
    'method' => 'GET',
    'path' => '/enterprises/{enterprise_id}/device_pinners',
    'name' => 'List enterprise device pins',
    'description' => 'Execute official Box API operation `get_enterprises_id_device_pinners`.

Endpoint: GET /enterprises/{enterprise_id}/device_pinners.',
    'type' => 'read',
    'tag' => 'Device pinners',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'enterprise_id',
        'param' => 'enterprise_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the enterprise.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction to sort results in. This can be either in alphabetical ascending (`ASC`) or descending (`DESC`) order.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  227 =>
  [
    'operation' => 'get_terms_of_services',
    'slug' => 'box_get_terms_of_services',
    'class' => 'BoxGetTermsOfServices',
    'method' => 'GET',
    'path' => '/terms_of_services',
    'name' => 'List terms of services',
    'description' => 'Execute official Box API operation `get_terms_of_services`.

Endpoint: GET /terms_of_services.',
    'type' => 'read',
    'tag' => 'Terms of service',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'tos_type',
        'param' => 'tos_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits the results to the terms of service of the given type.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  228 =>
  [
    'operation' => 'post_terms_of_services',
    'slug' => 'box_post_terms_of_services',
    'class' => 'BoxPostTermsOfServices',
    'method' => 'POST',
    'path' => '/terms_of_services',
    'name' => 'Create terms of service',
    'description' => 'Execute official Box API operation `post_terms_of_services`.

Endpoint: POST /terms_of_services.',
    'type' => 'write',
    'tag' => 'Terms of service',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  229 =>
  [
    'operation' => 'get_terms_of_services_id',
    'slug' => 'box_get_terms_of_services_id',
    'class' => 'BoxGetTermsOfServicesId',
    'method' => 'GET',
    'path' => '/terms_of_services/{terms_of_service_id}',
    'name' => 'Get terms of service',
    'description' => 'Execute official Box API operation `get_terms_of_services_id`.

Endpoint: GET /terms_of_services/{terms_of_service_id}.',
    'type' => 'read',
    'tag' => 'Terms of service',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'terms_of_service_id',
        'param' => 'terms_of_service_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the terms of service.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  230 =>
  [
    'operation' => 'put_terms_of_services_id',
    'slug' => 'box_put_terms_of_services_id',
    'class' => 'BoxPutTermsOfServicesId',
    'method' => 'PUT',
    'path' => '/terms_of_services/{terms_of_service_id}',
    'name' => 'Update terms of service',
    'description' => 'Execute official Box API operation `put_terms_of_services_id`.

Endpoint: PUT /terms_of_services/{terms_of_service_id}.',
    'type' => 'write',
    'tag' => 'Terms of service',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'terms_of_service_id',
        'param' => 'terms_of_service_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the terms of service.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  231 =>
  [
    'operation' => 'get_terms_of_service_user_statuses',
    'slug' => 'box_get_terms_of_service_user_statuses',
    'class' => 'BoxGetTermsOfServiceUserStatuses',
    'method' => 'GET',
    'path' => '/terms_of_service_user_statuses',
    'name' => 'List terms of service user statuses',
    'description' => 'Execute official Box API operation `get_terms_of_service_user_statuses`.

Endpoint: GET /terms_of_service_user_statuses.',
    'type' => 'read',
    'tag' => 'Terms of service user statuses',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'tos_id',
        'param' => 'tos_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the terms of service.',
      ],
      1 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limits results to the given user ID.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  232 =>
  [
    'operation' => 'post_terms_of_service_user_statuses',
    'slug' => 'box_post_terms_of_service_user_statuses',
    'class' => 'BoxPostTermsOfServiceUserStatuses',
    'method' => 'POST',
    'path' => '/terms_of_service_user_statuses',
    'name' => 'Create terms of service status for new user',
    'description' => 'Execute official Box API operation `post_terms_of_service_user_statuses`.

Endpoint: POST /terms_of_service_user_statuses.',
    'type' => 'write',
    'tag' => 'Terms of service user statuses',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  233 =>
  [
    'operation' => 'put_terms_of_service_user_statuses_id',
    'slug' => 'box_put_terms_of_service_user_statuses_id',
    'class' => 'BoxPutTermsOfServiceUserStatusesId',
    'method' => 'PUT',
    'path' => '/terms_of_service_user_statuses/{terms_of_service_user_status_id}',
    'name' => 'Update terms of service status for existing user',
    'description' => 'Execute official Box API operation `put_terms_of_service_user_statuses_id`.

Endpoint: PUT /terms_of_service_user_statuses/{terms_of_service_user_status_id}.',
    'type' => 'write',
    'tag' => 'Terms of service user statuses',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'terms_of_service_user_status_id',
        'param' => 'terms_of_service_user_status_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the terms of service status.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  234 =>
  [
    'operation' => 'get_collaboration_whitelist_entries',
    'slug' => 'box_get_collaboration_whitelist_entries',
    'class' => 'BoxGetCollaborationWhitelistEntries',
    'method' => 'GET',
    'path' => '/collaboration_whitelist_entries',
    'name' => 'List allowed collaboration domains',
    'description' => 'Execute official Box API operation `get_collaboration_whitelist_entries`.

Endpoint: GET /collaboration_whitelist_entries.',
    'type' => 'read',
    'tag' => 'Domain restrictions for collaborations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  235 =>
  [
    'operation' => 'post_collaboration_whitelist_entries',
    'slug' => 'box_post_collaboration_whitelist_entries',
    'class' => 'BoxPostCollaborationWhitelistEntries',
    'method' => 'POST',
    'path' => '/collaboration_whitelist_entries',
    'name' => 'Add domain to list of allowed collaboration domains',
    'description' => 'Execute official Box API operation `post_collaboration_whitelist_entries`.

Endpoint: POST /collaboration_whitelist_entries.',
    'type' => 'write',
    'tag' => 'Domain restrictions for collaborations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  236 =>
  [
    'operation' => 'get_collaboration_whitelist_entries_id',
    'slug' => 'box_get_collaboration_whitelist_entries_id',
    'class' => 'BoxGetCollaborationWhitelistEntriesId',
    'method' => 'GET',
    'path' => '/collaboration_whitelist_entries/{collaboration_whitelist_entry_id}',
    'name' => 'Get allowed collaboration domain',
    'description' => 'Execute official Box API operation `get_collaboration_whitelist_entries_id`.

Endpoint: GET /collaboration_whitelist_entries/{collaboration_whitelist_entry_id}.',
    'type' => 'read',
    'tag' => 'Domain restrictions for collaborations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collaboration_whitelist_entry_id',
        'param' => 'collaboration_whitelist_entry_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the entry in the list.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  237 =>
  [
    'operation' => 'delete_collaboration_whitelist_entries_id',
    'slug' => 'box_delete_collaboration_whitelist_entries_id',
    'class' => 'BoxDeleteCollaborationWhitelistEntriesId',
    'method' => 'DELETE',
    'path' => '/collaboration_whitelist_entries/{collaboration_whitelist_entry_id}',
    'name' => 'Remove domain from list of allowed collaboration domains',
    'description' => 'Execute official Box API operation `delete_collaboration_whitelist_entries_id`.

Endpoint: DELETE /collaboration_whitelist_entries/{collaboration_whitelist_entry_id}.',
    'type' => 'write',
    'tag' => 'Domain restrictions for collaborations',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collaboration_whitelist_entry_id',
        'param' => 'collaboration_whitelist_entry_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the entry in the list.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  238 =>
  [
    'operation' => 'get_collaboration_whitelist_exempt_targets',
    'slug' => 'box_get_collaboration_whitelist_exempt_targets',
    'class' => 'BoxGetCollaborationWhitelistExemptTargets',
    'method' => 'GET',
    'path' => '/collaboration_whitelist_exempt_targets',
    'name' => 'List users exempt from collaboration domain restrictions',
    'description' => 'Execute official Box API operation `get_collaboration_whitelist_exempt_targets`.

Endpoint: GET /collaboration_whitelist_exempt_targets.',
    'type' => 'read',
    'tag' => 'Domain restrictions (User exemptions)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  239 =>
  [
    'operation' => 'post_collaboration_whitelist_exempt_targets',
    'slug' => 'box_post_collaboration_whitelist_exempt_targets',
    'class' => 'BoxPostCollaborationWhitelistExemptTargets',
    'method' => 'POST',
    'path' => '/collaboration_whitelist_exempt_targets',
    'name' => 'Create user exemption from collaboration domain restrictions',
    'description' => 'Execute official Box API operation `post_collaboration_whitelist_exempt_targets`.

Endpoint: POST /collaboration_whitelist_exempt_targets.',
    'type' => 'write',
    'tag' => 'Domain restrictions (User exemptions)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  240 =>
  [
    'operation' => 'get_collaboration_whitelist_exempt_targets_id',
    'slug' => 'box_get_collaboration_whitelist_exempt_targets_id',
    'class' => 'BoxGetCollaborationWhitelistExemptTargetsId',
    'method' => 'GET',
    'path' => '/collaboration_whitelist_exempt_targets/{collaboration_whitelist_exempt_target_id}',
    'name' => 'Get user exempt from collaboration domain restrictions',
    'description' => 'Execute official Box API operation `get_collaboration_whitelist_exempt_targets_id`.

Endpoint: GET /collaboration_whitelist_exempt_targets/{collaboration_whitelist_exempt_target_id}.',
    'type' => 'read',
    'tag' => 'Domain restrictions (User exemptions)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collaboration_whitelist_exempt_target_id',
        'param' => 'collaboration_whitelist_exempt_target_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the exemption to the list.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  241 =>
  [
    'operation' => 'delete_collaboration_whitelist_exempt_targets_id',
    'slug' => 'box_delete_collaboration_whitelist_exempt_targets_id',
    'class' => 'BoxDeleteCollaborationWhitelistExemptTargetsId',
    'method' => 'DELETE',
    'path' => '/collaboration_whitelist_exempt_targets/{collaboration_whitelist_exempt_target_id}',
    'name' => 'Remove user from list of users exempt from domain restrictions',
    'description' => 'Execute official Box API operation `delete_collaboration_whitelist_exempt_targets_id`.

Endpoint: DELETE /collaboration_whitelist_exempt_targets/{collaboration_whitelist_exempt_target_id}.',
    'type' => 'write',
    'tag' => 'Domain restrictions (User exemptions)',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'collaboration_whitelist_exempt_target_id',
        'param' => 'collaboration_whitelist_exempt_target_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the exemption to the list.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  242 =>
  [
    'operation' => 'get_storage_policies',
    'slug' => 'box_get_storage_policies',
    'class' => 'BoxGetStoragePolicies',
    'method' => 'GET',
    'path' => '/storage_policies',
    'name' => 'List storage policies',
    'description' => 'Execute official Box API operation `get_storage_policies`.

Endpoint: GET /storage_policies.',
    'type' => 'read',
    'tag' => 'Standard and Zones Storage Policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response. Be aware that specifyi...',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  243 =>
  [
    'operation' => 'get_storage_policies_id',
    'slug' => 'box_get_storage_policies_id',
    'class' => 'BoxGetStoragePoliciesId',
    'method' => 'GET',
    'path' => '/storage_policies/{storage_policy_id}',
    'name' => 'Get storage policy',
    'description' => 'Execute official Box API operation `get_storage_policies_id`.

Endpoint: GET /storage_policies/{storage_policy_id}.',
    'type' => 'read',
    'tag' => 'Standard and Zones Storage Policies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storage_policy_id',
        'param' => 'storage_policy_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the storage policy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  244 =>
  [
    'operation' => 'get_storage_policy_assignments',
    'slug' => 'box_get_storage_policy_assignments',
    'class' => 'BoxGetStoragePolicyAssignments',
    'method' => 'GET',
    'path' => '/storage_policy_assignments',
    'name' => 'List storage policy assignments',
    'description' => 'Execute official Box API operation `get_storage_policy_assignments`.

Endpoint: GET /storage_policy_assignments.',
    'type' => 'read',
    'tag' => 'Standard and Zones Storage Policy Assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'resolved_for_type',
        'param' => 'resolved_for_type',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The target type to return assignments for.',
      ],
      2 =>
      [
        'name' => 'resolved_for_id',
        'param' => 'resolved_for_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user or enterprise to return assignments for.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  245 =>
  [
    'operation' => 'post_storage_policy_assignments',
    'slug' => 'box_post_storage_policy_assignments',
    'class' => 'BoxPostStoragePolicyAssignments',
    'method' => 'POST',
    'path' => '/storage_policy_assignments',
    'name' => 'Assign storage policy',
    'description' => 'Execute official Box API operation `post_storage_policy_assignments`.

Endpoint: POST /storage_policy_assignments.',
    'type' => 'write',
    'tag' => 'Standard and Zones Storage Policy Assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  246 =>
  [
    'operation' => 'get_storage_policy_assignments_id',
    'slug' => 'box_get_storage_policy_assignments_id',
    'class' => 'BoxGetStoragePolicyAssignmentsId',
    'method' => 'GET',
    'path' => '/storage_policy_assignments/{storage_policy_assignment_id}',
    'name' => 'Get storage policy assignment',
    'description' => 'Execute official Box API operation `get_storage_policy_assignments_id`.

Endpoint: GET /storage_policy_assignments/{storage_policy_assignment_id}.',
    'type' => 'read',
    'tag' => 'Standard and Zones Storage Policy Assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storage_policy_assignment_id',
        'param' => 'storage_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the storage policy assignment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  247 =>
  [
    'operation' => 'put_storage_policy_assignments_id',
    'slug' => 'box_put_storage_policy_assignments_id',
    'class' => 'BoxPutStoragePolicyAssignmentsId',
    'method' => 'PUT',
    'path' => '/storage_policy_assignments/{storage_policy_assignment_id}',
    'name' => 'Update storage policy assignment',
    'description' => 'Execute official Box API operation `put_storage_policy_assignments_id`.

Endpoint: PUT /storage_policy_assignments/{storage_policy_assignment_id}.',
    'type' => 'write',
    'tag' => 'Standard and Zones Storage Policy Assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storage_policy_assignment_id',
        'param' => 'storage_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the storage policy assignment.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  248 =>
  [
    'operation' => 'delete_storage_policy_assignments_id',
    'slug' => 'box_delete_storage_policy_assignments_id',
    'class' => 'BoxDeleteStoragePolicyAssignmentsId',
    'method' => 'DELETE',
    'path' => '/storage_policy_assignments/{storage_policy_assignment_id}',
    'name' => 'Unassign storage policy',
    'description' => 'Execute official Box API operation `delete_storage_policy_assignments_id`.

Endpoint: DELETE /storage_policy_assignments/{storage_policy_assignment_id}.',
    'type' => 'write',
    'tag' => 'Standard and Zones Storage Policy Assignments',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storage_policy_assignment_id',
        'param' => 'storage_policy_assignment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the storage policy assignment.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  249 =>
  [
    'operation' => 'post_zip_downloads',
    'slug' => 'box_post_zip_downloads',
    'class' => 'BoxPostZipDownloads',
    'method' => 'POST',
    'path' => '/zip_downloads',
    'name' => 'Create zip download',
    'description' => 'Execute official Box API operation `post_zip_downloads`.

Endpoint: POST /zip_downloads.',
    'type' => 'write',
    'tag' => 'Zip Downloads',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  250 =>
  [
    'operation' => 'get_zip_downloads_id_content',
    'slug' => 'box_get_zip_downloads_id_content',
    'class' => 'BoxGetZipDownloadsIdContent',
    'method' => 'GET',
    'path' => '/zip_downloads/{zip_download_id}/content',
    'name' => 'Download zip archive',
    'description' => 'Execute official Box API operation `get_zip_downloads_id_content`.

Endpoint: GET /zip_downloads/{zip_download_id}/content.',
    'type' => 'read',
    'tag' => 'Zip Downloads',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'zip_download_id',
        'param' => 'zip_download_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent this `zip` archive.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  251 =>
  [
    'operation' => 'get_zip_downloads_id_status',
    'slug' => 'box_get_zip_downloads_id_status',
    'class' => 'BoxGetZipDownloadsIdStatus',
    'method' => 'GET',
    'path' => '/zip_downloads/{zip_download_id}/status',
    'name' => 'Get zip download status',
    'description' => 'Execute official Box API operation `get_zip_downloads_id_status`.

Endpoint: GET /zip_downloads/{zip_download_id}/status.',
    'type' => 'read',
    'tag' => 'Zip Downloads',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'zip_download_id',
        'param' => 'zip_download_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent this `zip` archive.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  252 =>
  [
    'operation' => 'post_sign_requests_id_cancel',
    'slug' => 'box_post_sign_requests_id_cancel',
    'class' => 'BoxPostSignRequestsIdCancel',
    'method' => 'POST',
    'path' => '/sign_requests/{sign_request_id}/cancel',
    'name' => 'Cancel Box Sign request',
    'description' => 'Execute official Box API operation `post_sign_requests_id_cancel`.

Endpoint: POST /sign_requests/{sign_request_id}/cancel.',
    'type' => 'write',
    'tag' => 'Box Sign requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sign_request_id',
        'param' => 'sign_request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the signature request.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  253 =>
  [
    'operation' => 'post_sign_requests_id_resend',
    'slug' => 'box_post_sign_requests_id_resend',
    'class' => 'BoxPostSignRequestsIdResend',
    'method' => 'POST',
    'path' => '/sign_requests/{sign_request_id}/resend',
    'name' => 'Resend Box Sign request',
    'description' => 'Execute official Box API operation `post_sign_requests_id_resend`.

Endpoint: POST /sign_requests/{sign_request_id}/resend.',
    'type' => 'write',
    'tag' => 'Box Sign requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sign_request_id',
        'param' => 'sign_request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the signature request.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  254 =>
  [
    'operation' => 'get_sign_requests_id',
    'slug' => 'box_get_sign_requests_id',
    'class' => 'BoxGetSignRequestsId',
    'method' => 'GET',
    'path' => '/sign_requests/{sign_request_id}',
    'name' => 'Get Box Sign request by ID',
    'description' => 'Execute official Box API operation `get_sign_requests_id`.

Endpoint: GET /sign_requests/{sign_request_id}.',
    'type' => 'read',
    'tag' => 'Box Sign requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sign_request_id',
        'param' => 'sign_request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the signature request.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  255 =>
  [
    'operation' => 'get_sign_requests',
    'slug' => 'box_get_sign_requests',
    'class' => 'BoxGetSignRequests',
    'method' => 'GET',
    'path' => '/sign_requests',
    'name' => 'List Box Sign requests',
    'description' => 'Execute official Box API operation `get_sign_requests`.

Endpoint: GET /sign_requests.',
    'type' => 'read',
    'tag' => 'Box Sign requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'senders',
        'param' => 'senders',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'A list of sender emails to filter the signature requests by sender. If provided, `shared_requests` must be set to `true`.',
      ],
      3 =>
      [
        'name' => 'shared_requests',
        'param' => 'shared_requests',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If set to `true`, only includes requests that user is not an owner, but user is a collaborator. Collaborator access is determined by the user access level of the sign files of t...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  256 =>
  [
    'operation' => 'post_sign_requests',
    'slug' => 'box_post_sign_requests',
    'class' => 'BoxPostSignRequests',
    'method' => 'POST',
    'path' => '/sign_requests',
    'name' => 'Create Box Sign request',
    'description' => 'Execute official Box API operation `post_sign_requests`.

Endpoint: POST /sign_requests.',
    'type' => 'write',
    'tag' => 'Box Sign requests',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  257 =>
  [
    'operation' => 'get_workflows',
    'slug' => 'box_get_workflows',
    'class' => 'BoxGetWorkflows',
    'method' => 'GET',
    'path' => '/workflows',
    'name' => 'List workflows',
    'description' => 'Execute official Box API operation `get_workflows`.

Endpoint: GET /workflows.',
    'type' => 'read',
    'tag' => 'Workflows',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'folder_id',
        'param' => 'folder_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier that represent a folder. The ID for any folder can be determined by visiting this folder in the web application and copying the ID from the URL. For exampl...',
      ],
      1 =>
      [
        'name' => 'trigger_type',
        'param' => 'trigger_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Type of trigger to search for.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      3 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  258 =>
  [
    'operation' => 'post_workflows_id_start',
    'slug' => 'box_post_workflows_id_start',
    'class' => 'BoxPostWorkflowsIdStart',
    'method' => 'POST',
    'path' => '/workflows/{workflow_id}/start',
    'name' => 'Starts workflow based on request body',
    'description' => 'Execute official Box API operation `post_workflows_id_start`.

Endpoint: POST /workflows/{workflow_id}/start.',
    'type' => 'write',
    'tag' => 'Workflows',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'workflow_id',
        'param' => 'workflow_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the workflow.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  259 =>
  [
    'operation' => 'get_sign_templates',
    'slug' => 'box_get_sign_templates',
    'class' => 'BoxGetSignTemplates',
    'method' => 'GET',
    'path' => '/sign_templates',
    'name' => 'List Box Sign templates',
    'description' => 'Execute official Box API operation `get_sign_templates`.

Endpoint: GET /sign_templates.',
    'type' => 'read',
    'tag' => 'Box Sign templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  260 =>
  [
    'operation' => 'get_sign_templates_id',
    'slug' => 'box_get_sign_templates_id',
    'class' => 'BoxGetSignTemplatesId',
    'method' => 'GET',
    'path' => '/sign_templates/{template_id}',
    'name' => 'Get Box Sign template by ID',
    'description' => 'Execute official Box API operation `get_sign_templates_id`.

Endpoint: GET /sign_templates/{template_id}.',
    'type' => 'read',
    'tag' => 'Box Sign templates',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'template_id',
        'param' => 'template_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of a Box Sign template.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  261 =>
  [
    'operation' => 'get_integration_mappings_slack',
    'slug' => 'box_get_integration_mappings_slack',
    'class' => 'BoxGetIntegrationMappingsSlack',
    'method' => 'GET',
    'path' => '/integration_mappings/slack',
    'name' => 'List Slack integration mappings',
    'description' => 'Execute official Box API operation `get_integration_mappings_slack`.

Endpoint: GET /integration_mappings/slack.',
    'type' => 'read',
    'tag' => 'Integration mappings',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
      2 =>
      [
        'name' => 'partner_item_type',
        'param' => 'partner_item_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Mapped item type, for which the mapping should be returned.',
      ],
      3 =>
      [
        'name' => 'partner_item_id',
        'param' => 'partner_item_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'ID of the mapped item, for which the mapping should be returned.',
      ],
      4 =>
      [
        'name' => 'box_item_id',
        'param' => 'box_item_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Box item ID, for which the mappings should be returned.',
      ],
      5 =>
      [
        'name' => 'box_item_type',
        'param' => 'box_item_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Box item type, for which the mappings should be returned.',
      ],
      6 =>
      [
        'name' => 'is_manually_created',
        'param' => 'is_manually_created',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether the mapping has been manually created.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  262 =>
  [
    'operation' => 'post_integration_mappings_slack',
    'slug' => 'box_post_integration_mappings_slack',
    'class' => 'BoxPostIntegrationMappingsSlack',
    'method' => 'POST',
    'path' => '/integration_mappings/slack',
    'name' => 'Create Slack integration mapping',
    'description' => 'Execute official Box API operation `post_integration_mappings_slack`.

Endpoint: POST /integration_mappings/slack.',
    'type' => 'write',
    'tag' => 'Integration mappings',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  263 =>
  [
    'operation' => 'put_integration_mappings_slack_id',
    'slug' => 'box_put_integration_mappings_slack_id',
    'class' => 'BoxPutIntegrationMappingsSlackId',
    'method' => 'PUT',
    'path' => '/integration_mappings/slack/{integration_mapping_id}',
    'name' => 'Update Slack integration mapping',
    'description' => 'Execute official Box API operation `put_integration_mappings_slack_id`.

Endpoint: PUT /integration_mappings/slack/{integration_mapping_id}.',
    'type' => 'write',
    'tag' => 'Integration mappings',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'integration_mapping_id',
        'param' => 'integration_mapping_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'An ID of an integration mapping.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  264 =>
  [
    'operation' => 'delete_integration_mappings_slack_id',
    'slug' => 'box_delete_integration_mappings_slack_id',
    'class' => 'BoxDeleteIntegrationMappingsSlackId',
    'method' => 'DELETE',
    'path' => '/integration_mappings/slack/{integration_mapping_id}',
    'name' => 'Delete Slack integration mapping',
    'description' => 'Execute official Box API operation `delete_integration_mappings_slack_id`.

Endpoint: DELETE /integration_mappings/slack/{integration_mapping_id}.',
    'type' => 'write',
    'tag' => 'Integration mappings',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'integration_mapping_id',
        'param' => 'integration_mapping_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'An ID of an integration mapping.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  265 =>
  [
    'operation' => 'get_integration_mappings_teams',
    'slug' => 'box_get_integration_mappings_teams',
    'class' => 'BoxGetIntegrationMappingsTeams',
    'method' => 'GET',
    'path' => '/integration_mappings/teams',
    'name' => 'List Teams integration mappings',
    'description' => 'Execute official Box API operation `get_integration_mappings_teams`.

Endpoint: GET /integration_mappings/teams.',
    'type' => 'read',
    'tag' => 'Integration mappings',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'partner_item_type',
        'param' => 'partner_item_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Mapped item type, for which the mapping should be returned.',
      ],
      1 =>
      [
        'name' => 'partner_item_id',
        'param' => 'partner_item_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'ID of the mapped item, for which the mapping should be returned.',
      ],
      2 =>
      [
        'name' => 'box_item_id',
        'param' => 'box_item_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Box item ID, for which the mappings should be returned.',
      ],
      3 =>
      [
        'name' => 'box_item_type',
        'param' => 'box_item_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Box item type, for which the mappings should be returned.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  266 =>
  [
    'operation' => 'post_integration_mappings_teams',
    'slug' => 'box_post_integration_mappings_teams',
    'class' => 'BoxPostIntegrationMappingsTeams',
    'method' => 'POST',
    'path' => '/integration_mappings/teams',
    'name' => 'Create Teams integration mapping',
    'description' => 'Execute official Box API operation `post_integration_mappings_teams`.

Endpoint: POST /integration_mappings/teams.',
    'type' => 'write',
    'tag' => 'Integration mappings',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  267 =>
  [
    'operation' => 'put_integration_mappings_teams_id',
    'slug' => 'box_put_integration_mappings_teams_id',
    'class' => 'BoxPutIntegrationMappingsTeamsId',
    'method' => 'PUT',
    'path' => '/integration_mappings/teams/{integration_mapping_id}',
    'name' => 'Update Teams integration mapping',
    'description' => 'Execute official Box API operation `put_integration_mappings_teams_id`.

Endpoint: PUT /integration_mappings/teams/{integration_mapping_id}.',
    'type' => 'write',
    'tag' => 'Integration mappings',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'integration_mapping_id',
        'param' => 'integration_mapping_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'An ID of an integration mapping.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  268 =>
  [
    'operation' => 'delete_integration_mappings_teams_id',
    'slug' => 'box_delete_integration_mappings_teams_id',
    'class' => 'BoxDeleteIntegrationMappingsTeamsId',
    'method' => 'DELETE',
    'path' => '/integration_mappings/teams/{integration_mapping_id}',
    'name' => 'Delete Teams integration mapping',
    'description' => 'Execute official Box API operation `delete_integration_mappings_teams_id`.

Endpoint: DELETE /integration_mappings/teams/{integration_mapping_id}.',
    'type' => 'write',
    'tag' => 'Integration mappings',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'integration_mapping_id',
        'param' => 'integration_mapping_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'An ID of an integration mapping.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  269 =>
  [
    'operation' => 'post_ai_ask',
    'slug' => 'box_post_ai_ask',
    'class' => 'BoxPostAiAsk',
    'method' => 'POST',
    'path' => '/ai/ask',
    'name' => 'Ask question',
    'description' => 'Execute official Box API operation `post_ai_ask`.

Endpoint: POST /ai/ask.',
    'type' => 'write',
    'tag' => 'AI',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  270 =>
  [
    'operation' => 'post_ai_text_gen',
    'slug' => 'box_post_ai_text_gen',
    'class' => 'BoxPostAiTextGen',
    'method' => 'POST',
    'path' => '/ai/text_gen',
    'name' => 'Generate text',
    'description' => 'Execute official Box API operation `post_ai_text_gen`.

Endpoint: POST /ai/text_gen.',
    'type' => 'write',
    'tag' => 'AI',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  271 =>
  [
    'operation' => 'get_ai_agent_default',
    'slug' => 'box_get_ai_agent_default',
    'class' => 'BoxGetAiAgentDefault',
    'method' => 'GET',
    'path' => '/ai_agent_default',
    'name' => 'Get AI agent default configuration',
    'description' => 'Execute official Box API operation `get_ai_agent_default`.

Endpoint: GET /ai_agent_default.',
    'type' => 'read',
    'tag' => 'AI',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'mode',
        'param' => 'mode',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The mode to filter the agent config to return.',
      ],
      1 =>
      [
        'name' => 'language',
        'param' => 'language',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The ISO language code to return the agent config for. If the language is not supported the default agent config is returned.',
      ],
      2 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The model to return the default agent config for.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  272 =>
  [
    'operation' => 'post_ai_extract',
    'slug' => 'box_post_ai_extract',
    'class' => 'BoxPostAiExtract',
    'method' => 'POST',
    'path' => '/ai/extract',
    'name' => 'Extract metadata (freeform)',
    'description' => 'Execute official Box API operation `post_ai_extract`.

Endpoint: POST /ai/extract.',
    'type' => 'write',
    'tag' => 'AI',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  273 =>
  [
    'operation' => 'post_ai_extract_structured',
    'slug' => 'box_post_ai_extract_structured',
    'class' => 'BoxPostAiExtractStructured',
    'method' => 'POST',
    'path' => '/ai/extract_structured',
    'name' => 'Extract metadata (structured)',
    'description' => 'Execute official Box API operation `post_ai_extract_structured`.

Endpoint: POST /ai/extract_structured.',
    'type' => 'write',
    'tag' => 'AI',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  274 =>
  [
    'operation' => 'get_ai_agents',
    'slug' => 'box_get_ai_agents',
    'class' => 'BoxGetAiAgents',
    'method' => 'GET',
    'path' => '/ai_agents',
    'name' => 'List AI agents',
    'description' => 'Execute official Box API operation `get_ai_agents`.

Endpoint: GET /ai_agents.',
    'type' => 'read',
    'tag' => 'AI Studio',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'mode',
        'param' => 'mode',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'The mode to filter the agent config to return. Possible values are: `ask`, `text_gen`, and `extract`.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'The fields to return in the response.',
      ],
      2 =>
      [
        'name' => 'agent_state',
        'param' => 'agent_state',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'The state of the agents to return. Possible values are: `enabled`, `disabled` and `enabled_for_selected_users`.',
      ],
      3 =>
      [
        'name' => 'include_box_default',
        'param' => 'include_box_default',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether to include the Box default agents in the response.',
      ],
      4 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results.',
      ],
      5 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  275 =>
  [
    'operation' => 'post_ai_agents',
    'slug' => 'box_post_ai_agents',
    'class' => 'BoxPostAiAgents',
    'method' => 'POST',
    'path' => '/ai_agents',
    'name' => 'Create AI agent',
    'description' => 'Execute official Box API operation `post_ai_agents`.

Endpoint: POST /ai_agents.',
    'type' => 'write',
    'tag' => 'AI Studio',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  276 =>
  [
    'operation' => 'put_ai_agents_id',
    'slug' => 'box_put_ai_agents_id',
    'class' => 'BoxPutAiAgentsId',
    'method' => 'PUT',
    'path' => '/ai_agents/{agent_id}',
    'name' => 'Update AI agent',
    'description' => 'Execute official Box API operation `put_ai_agents_id`.

Endpoint: PUT /ai_agents/{agent_id}.',
    'type' => 'write',
    'tag' => 'AI Studio',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'agent_id',
        'param' => 'agent_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the agent to update.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  277 =>
  [
    'operation' => 'get_ai_agents_id',
    'slug' => 'box_get_ai_agents_id',
    'class' => 'BoxGetAiAgentsId',
    'method' => 'GET',
    'path' => '/ai_agents/{agent_id}',
    'name' => 'Get AI agent by agent ID',
    'description' => 'Execute official Box API operation `get_ai_agents_id`.

Endpoint: GET /ai_agents/{agent_id}.',
    'type' => 'read',
    'tag' => 'AI Studio',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'agent_id',
        'param' => 'agent_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The agent id to get.',
      ],
      1 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'The fields to return in the response.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  278 =>
  [
    'operation' => 'delete_ai_agents_id',
    'slug' => 'box_delete_ai_agents_id',
    'class' => 'BoxDeleteAiAgentsId',
    'method' => 'DELETE',
    'path' => '/ai_agents/{agent_id}',
    'name' => 'Delete AI agent',
    'description' => 'Execute official Box API operation `delete_ai_agents_id`.

Endpoint: DELETE /ai_agents/{agent_id}.',
    'type' => 'write',
    'tag' => 'AI Studio',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'agent_id',
        'param' => 'agent_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the agent to delete.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  279 =>
  [
    'operation' => 'post_metadata_taxonomies',
    'slug' => 'box_post_metadata_taxonomies',
    'class' => 'BoxPostMetadataTaxonomies',
    'method' => 'POST',
    'path' => '/metadata_taxonomies',
    'name' => 'Create metadata taxonomy',
    'description' => 'Execute official Box API operation `post_metadata_taxonomies`.

Endpoint: POST /metadata_taxonomies.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  280 =>
  [
    'operation' => 'get_metadata_taxonomies_id',
    'slug' => 'box_get_metadata_taxonomies_id',
    'class' => 'BoxGetMetadataTaxonomiesId',
    'method' => 'GET',
    'path' => '/metadata_taxonomies/{namespace}',
    'name' => 'Get metadata taxonomies for namespace',
    'description' => 'Execute official Box API operation `get_metadata_taxonomies_id`.

Endpoint: GET /metadata_taxonomies/{namespace}.',
    'type' => 'read',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  281 =>
  [
    'operation' => 'get_metadata_taxonomies_id_id',
    'slug' => 'box_get_metadata_taxonomies_id_id',
    'class' => 'BoxGetMetadataTaxonomiesIdId',
    'method' => 'GET',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}',
    'name' => 'Get metadata taxonomy by taxonomy key',
    'description' => 'Execute official Box API operation `get_metadata_taxonomies_id_id`.

Endpoint: GET /metadata_taxonomies/{namespace}/{taxonomy_key}.',
    'type' => 'read',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  282 =>
  [
    'operation' => 'patch_metadata_taxonomies_id_id',
    'slug' => 'box_patch_metadata_taxonomies_id_id',
    'class' => 'BoxPatchMetadataTaxonomiesIdId',
    'method' => 'PATCH',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}',
    'name' => 'Update metadata taxonomy',
    'description' => 'Execute official Box API operation `patch_metadata_taxonomies_id_id`.

Endpoint: PATCH /metadata_taxonomies/{namespace}/{taxonomy_key}.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  283 =>
  [
    'operation' => 'delete_metadata_taxonomies_id_id',
    'slug' => 'box_delete_metadata_taxonomies_id_id',
    'class' => 'BoxDeleteMetadataTaxonomiesIdId',
    'method' => 'DELETE',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}',
    'name' => 'Remove metadata taxonomy',
    'description' => 'Execute official Box API operation `delete_metadata_taxonomies_id_id`.

Endpoint: DELETE /metadata_taxonomies/{namespace}/{taxonomy_key}.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  284 =>
  [
    'operation' => 'post_metadata_taxonomies_id_id_levels',
    'slug' => 'box_post_metadata_taxonomies_id_id_levels',
    'class' => 'BoxPostMetadataTaxonomiesIdIdLevels',
    'method' => 'POST',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/levels',
    'name' => 'Create metadata taxonomy levels',
    'description' => 'Execute official Box API operation `post_metadata_taxonomies_id_id_levels`.

Endpoint: POST /metadata_taxonomies/{namespace}/{taxonomy_key}/levels.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  285 =>
  [
    'operation' => 'patch_metadata_taxonomies_id_id_levels_id',
    'slug' => 'box_patch_metadata_taxonomies_id_id_levels_id',
    'class' => 'BoxPatchMetadataTaxonomiesIdIdLevelsId',
    'method' => 'PATCH',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/levels/{level_index}',
    'name' => 'Update metadata taxonomy level',
    'description' => 'Execute official Box API operation `patch_metadata_taxonomies_id_id_levels_id`.

Endpoint: PATCH /metadata_taxonomies/{namespace}/{taxonomy_key}/levels/{level_index}.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'level_index',
        'param' => 'level_index',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The index of the metadata taxonomy level.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  286 =>
  [
    'operation' => 'post_metadata_taxonomies_id_id_levels:append',
    'slug' => 'box_post_metadata_taxonomies_id_id_levels_append',
    'class' => 'BoxPostMetadataTaxonomiesIdIdLevelsAppend',
    'method' => 'POST',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/levels:append',
    'name' => 'Add metadata taxonomy level',
    'description' => 'Execute official Box API operation `post_metadata_taxonomies_id_id_levels:append`.

Endpoint: POST /metadata_taxonomies/{namespace}/{taxonomy_key}/levels:append.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  287 =>
  [
    'operation' => 'post_metadata_taxonomies_id_id_levels:trim',
    'slug' => 'box_post_metadata_taxonomies_id_id_levels_trim',
    'class' => 'BoxPostMetadataTaxonomiesIdIdLevelsTrim',
    'method' => 'POST',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/levels:trim',
    'name' => 'Delete metadata taxonomy level',
    'description' => 'Execute official Box API operation `post_metadata_taxonomies_id_id_levels:trim`.

Endpoint: POST /metadata_taxonomies/{namespace}/{taxonomy_key}/levels:trim.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  288 =>
  [
    'operation' => 'get_metadata_taxonomies_id_id_nodes',
    'slug' => 'box_get_metadata_taxonomies_id_id_nodes',
    'class' => 'BoxGetMetadataTaxonomiesIdIdNodes',
    'method' => 'GET',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/nodes',
    'name' => 'List metadata taxonomy nodes',
    'description' => 'Execute official Box API operation `get_metadata_taxonomies_id_id_nodes`.

Endpoint: GET /metadata_taxonomies/{namespace}/{taxonomy_key}/nodes.',
    'type' => 'read',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'level',
        'param' => 'level',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Filters results by taxonomy level. Multiple values can be provided. Results include nodes that match any of the specified values.',
      ],
      3 =>
      [
        'name' => 'parent',
        'param' => 'parent',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Node identifier of a direct parent node. Multiple values can be provided. Results include nodes that match any of the specified values.',
      ],
      4 =>
      [
        'name' => 'ancestor',
        'param' => 'ancestor',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Node identifier of any ancestor node. Multiple values can be provided. Results include nodes that match any of the specified values.',
      ],
      5 =>
      [
        'name' => 'query',
        'param' => 'query',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Query text to search for the taxonomy nodes.',
      ],
      6 =>
      [
        'name' => 'include-total-result-count',
        'param' => 'include_total_result_count',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'When set to `true` this provides the total number of nodes that matched the query. The response will compute counts of up to 10,000 elements. Defaults to `false`.',
      ],
      7 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      8 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  289 =>
  [
    'operation' => 'post_metadata_taxonomies_id_id_nodes',
    'slug' => 'box_post_metadata_taxonomies_id_id_nodes',
    'class' => 'BoxPostMetadataTaxonomiesIdIdNodes',
    'method' => 'POST',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/nodes',
    'name' => 'Create metadata taxonomy node',
    'description' => 'Execute official Box API operation `post_metadata_taxonomies_id_id_nodes`.

Endpoint: POST /metadata_taxonomies/{namespace}/{taxonomy_key}/nodes.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  290 =>
  [
    'operation' => 'get_metadata_taxonomies_id_id_nodes_id',
    'slug' => 'box_get_metadata_taxonomies_id_id_nodes_id',
    'class' => 'BoxGetMetadataTaxonomiesIdIdNodesId',
    'method' => 'GET',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/nodes/{node_id}',
    'name' => 'Get metadata taxonomy node by ID',
    'description' => 'Execute official Box API operation `get_metadata_taxonomies_id_id_nodes_id`.

Endpoint: GET /metadata_taxonomies/{namespace}/{taxonomy_key}/nodes/{node_id}.',
    'type' => 'read',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'node_id',
        'param' => 'node_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the metadata taxonomy node.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  291 =>
  [
    'operation' => 'patch_metadata_taxonomies_id_id_nodes_id',
    'slug' => 'box_patch_metadata_taxonomies_id_id_nodes_id',
    'class' => 'BoxPatchMetadataTaxonomiesIdIdNodesId',
    'method' => 'PATCH',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/nodes/{node_id}',
    'name' => 'Update metadata taxonomy node',
    'description' => 'Execute official Box API operation `patch_metadata_taxonomies_id_id_nodes_id`.

Endpoint: PATCH /metadata_taxonomies/{namespace}/{taxonomy_key}/nodes/{node_id}.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'node_id',
        'param' => 'node_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the metadata taxonomy node.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Box OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  292 =>
  [
    'operation' => 'delete_metadata_taxonomies_id_id_nodes_id',
    'slug' => 'box_delete_metadata_taxonomies_id_id_nodes_id',
    'class' => 'BoxDeleteMetadataTaxonomiesIdIdNodesId',
    'method' => 'DELETE',
    'path' => '/metadata_taxonomies/{namespace}/{taxonomy_key}/nodes/{node_id}',
    'name' => 'Remove metadata taxonomy node',
    'description' => 'Execute official Box API operation `delete_metadata_taxonomies_id_id_nodes_id`.

Endpoint: DELETE /metadata_taxonomies/{namespace}/{taxonomy_key}/nodes/{node_id}.',
    'type' => 'write',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'taxonomy_key',
        'param' => 'taxonomy_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy.',
      ],
      2 =>
      [
        'name' => 'node_id',
        'param' => 'node_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the metadata taxonomy node.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
  293 =>
  [
    'operation' => 'get_metadata_templates_id_id_fields_id_options',
    'slug' => 'box_get_metadata_templates_id_id_fields_id_options',
    'class' => 'BoxGetMetadataTemplatesIdIdFieldsIdOptions',
    'method' => 'GET',
    'path' => '/metadata_templates/{namespace}/{template_key}/fields/{field_key}/options',
    'name' => 'List metadata template\'s options for taxonomy field',
    'description' => 'Execute official Box API operation `get_metadata_templates_id_id_fields_id_options`.

Endpoint: GET /metadata_templates/{namespace}/{template_key}/fields/{field_key}/options.',
    'type' => 'read',
    'tag' => 'Metadata taxonomies',
    'base' => 'api',
    'body_content_type' => 'application/json',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'namespace',
        'param' => 'namespace',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The namespace of the metadata taxonomy.',
      ],
      1 =>
      [
        'name' => 'template_key',
        'param' => 'template_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the metadata template.',
      ],
      2 =>
      [
        'name' => 'field_key',
        'param' => 'field_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The key of the metadata taxonomy field in the template.',
      ],
      3 =>
      [
        'name' => 'level',
        'param' => 'level',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Filters results by taxonomy level. Multiple values can be provided. Results include nodes that match any of the specified values.',
      ],
      4 =>
      [
        'name' => 'parent',
        'param' => 'parent',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Node identifier of a direct parent node. Multiple values can be provided. Results include nodes that match any of the specified values.',
      ],
      5 =>
      [
        'name' => 'ancestor',
        'param' => 'ancestor',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Node identifier of any ancestor node. Multiple values can be provided. Results include nodes that match any of the specified values.',
      ],
      6 =>
      [
        'name' => 'query',
        'param' => 'query',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Query text to search for the taxonomy nodes.',
      ],
      7 =>
      [
        'name' => 'include-total-result-count',
        'param' => 'include_total_result_count',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'When set to `true` this provides the total number of nodes that matched the query. The response will compute counts of up to 10,000 elements. Defaults to `false`.',
      ],
      8 =>
      [
        'name' => 'only-selectable-options',
        'param' => 'only_selectable_options',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'When set to `true`, this only returns valid selectable options for this template taxonomy field. Otherwise, it returns all taxonomy nodes, whether or not they are selectable. De...',
      ],
      9 =>
      [
        'name' => 'marker',
        'param' => 'marker',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the position marker at which to begin returning results. This is used when paginating using marker-based pagination. This requires `usemarker` to be set to `true`.',
      ],
      10 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of items to return per page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
  ],
];
    }
}
