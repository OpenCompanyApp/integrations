<?php

namespace OpenCompany\Integrations\Airtop;

/**
 * Official Airtop OpenAPI operation metadata.
 *
 * Source: https://docs.airtop.ai/openapi.json.
 */
class AirtopOperations
{
    /**
     * Return all supported Airtop API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
  0 =>
  [
    'operation' => 'list',
    'slug' => 'airtop_sessions_list',
    'class' => 'AirtopSessionsList',
    'method' => 'GET',
    'path' => '/v1/sessions',
    'name' => 'Get a list of sessions',
    'description' => 'Execute official Airtop API operation `list`.

Endpoint: GET /v1/sessions.',
    'type' => 'read',
    'tag' => 'subpackage_sessions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionIds',
        'param' => 'session_ids',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of IDs of the sessions to retrieve.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Status of the session to get.',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Offset for pagination.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Limit for pagination.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  1 =>
  [
    'operation' => 'create',
    'slug' => 'airtop_sessions_create',
    'class' => 'AirtopSessionsCreate',
    'method' => 'POST',
    'path' => '/v1/sessions',
    'name' => 'Create a session',
    'description' => 'Execute official Airtop API operation `create`.

Endpoint: POST /v1/sessions.',
    'type' => 'write',
    'tag' => 'subpackage_sessions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  2 =>
  [
    'operation' => 'get-info',
    'slug' => 'airtop_sessions_get_info',
    'class' => 'AirtopSessionsGetInfo',
    'method' => 'GET',
    'path' => '/v1/sessions/{id}',
    'name' => 'Get info for a session',
    'description' => 'Execute official Airtop API operation `get-info`.

Endpoint: GET /v1/sessions/{id}.',
    'type' => 'read',
    'tag' => 'subpackage_sessions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Id of the session to get',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  3 =>
  [
    'operation' => 'terminate',
    'slug' => 'airtop_sessions_terminate',
    'class' => 'AirtopSessionsTerminate',
    'method' => 'DELETE',
    'path' => '/v1/sessions/{id}',
    'name' => 'Ends a session',
    'description' => 'Execute official Airtop API operation `terminate`.

Endpoint: DELETE /v1/sessions/{id}.',
    'type' => 'write',
    'tag' => 'subpackage_sessions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the session to delete.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  4 =>
  [
    'operation' => 'save-profile-on-termination',
    'slug' => 'airtop_sessions_save_profile_on_termination',
    'class' => 'AirtopSessionsSaveProfileOnTermination',
    'method' => 'PUT',
    'path' => '/v1/sessions/{sessionId}/save-profile-on-termination/{profileName}',
    'name' => 'Save profile on termination',
    'description' => 'Execute official Airtop API operation `save-profile-on-termination`.

Endpoint: PUT /v1/sessions/{sessionId}/save-profile-on-termination/{profileName}.',
    'type' => 'write',
    'tag' => 'subpackage_sessions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the session.',
      ],
      1 =>
      [
        'name' => 'profileName',
        'param' => 'profile_name',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Name under which to save the profile.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  5 =>
  [
    'operation' => 'async-create-automation',
    'slug' => 'airtop_async_sessions_windows_create_automation_async_create_automation',
    'class' => 'AirtopAsyncSessionsWindowsCreateAutomationAsyncCreateAutomation',
    'method' => 'POST',
    'path' => '/v1/async/sessions/{sessionId}/windows/{windowId}/create-automation',
    'name' => 'Create an automation (async)',
    'description' => 'Execute official Airtop API operation `async-create-automation`.

Endpoint: POST /v1/async/sessions/{sessionId}/windows/{windowId}/create-automation.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  6 =>
  [
    'operation' => 'async-create-form-filler',
    'slug' => 'airtop_async_sessions_windows_create_form_filler_async_create_form_filler',
    'class' => 'AirtopAsyncSessionsWindowsCreateFormFillerAsyncCreateFormFiller',
    'method' => 'POST',
    'path' => '/v1/async/sessions/{sessionId}/windows/{windowId}/create-form-filler',
    'name' => 'Create a form filler automation (async)',
    'description' => 'Execute official Airtop API operation `async-create-form-filler`.

Endpoint: POST /v1/async/sessions/{sessionId}/windows/{windowId}/create-form-filler.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  7 =>
  [
    'operation' => 'async-execute-automation',
    'slug' => 'airtop_async_sessions_windows_execute_automation_async_execute_automation',
    'class' => 'AirtopAsyncSessionsWindowsExecuteAutomationAsyncExecuteAutomation',
    'method' => 'POST',
    'path' => '/v1/async/sessions/{sessionId}/windows/{windowId}/execute-automation',
    'name' => 'Execute an automation (async)',
    'description' => 'Execute official Airtop API operation `async-execute-automation`.

Endpoint: POST /v1/async/sessions/{sessionId}/windows/{windowId}/execute-automation.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  8 =>
  [
    'operation' => 'async-fill-form',
    'slug' => 'airtop_async_sessions_windows_fill_form_async_fill_form',
    'class' => 'AirtopAsyncSessionsWindowsFillFormAsyncFillForm',
    'method' => 'POST',
    'path' => '/v1/async/sessions/{sessionId}/windows/{windowId}/fill-form',
    'name' => 'Fill a form using a form-filler automation (async)',
    'description' => 'Execute official Airtop API operation `async-fill-form`.

Endpoint: POST /v1/async/sessions/{sessionId}/windows/{windowId}/fill-form.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  9 =>
  [
    'operation' => 'list',
    'slug' => 'airtop_sessions_windows_list',
    'class' => 'AirtopSessionsWindowsList',
    'method' => 'GET',
    'path' => '/v1/sessions/{sessionId}/windows',
    'name' => 'List windows',
    'description' => 'Execute official Airtop API operation `list`.

Endpoint: GET /v1/sessions/{sessionId}/windows.',
    'type' => 'read',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the session to list windows for.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  10 =>
  [
    'operation' => 'create',
    'slug' => 'airtop_sessions_windows_create',
    'class' => 'AirtopSessionsWindowsCreate',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows',
    'name' => 'Create window',
    'description' => 'Execute official Airtop API operation `create`.

Endpoint: POST /v1/sessions/{sessionId}/windows.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the session that owns the window.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  11 =>
  [
    'operation' => 'get-window-info',
    'slug' => 'airtop_sessions_windows_get_window_info',
    'class' => 'AirtopSessionsWindowsGetWindowInfo',
    'method' => 'GET',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}',
    'name' => 'Get window info',
    'description' => 'Execute official Airtop API operation `get-window-info`.

Endpoint: GET /v1/sessions/{sessionId}/windows/{windowId}.',
    'type' => 'read',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the session that owns the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the browser window, which can either be a normal AirTop windowId or a [CDP TargetId](https://chromedevtools.github.io/devtools-protocol/tot/Target/#type-TargetID) from a b...',
      ],
      2 =>
      [
        'name' => 'includeNavigationBar',
        'param' => 'include_navigation_bar',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Affects the live view configuration. A navigation bar is not shown in the live view of a browser by default. Set this to true to configure the returned liveViewUrl so that a nav...',
      ],
      3 =>
      [
        'name' => 'disableResize',
        'param' => 'disable_resize',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Affects the live view configuration. Set to true to configure the returned liveViewUrl so that the ability to resize the browser window from the live view is disabled (resizing...',
      ],
      4 =>
      [
        'name' => 'screenResolution',
        'param' => 'screen_resolution',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Affects the live view configuration. By default, a live view will fill the parent frame (or local window if loaded directly) when initially loaded, causing the browser window to...',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  12 =>
  [
    'operation' => 'load-url',
    'slug' => 'airtop_sessions_windows_load_url',
    'class' => 'AirtopSessionsWindowsLoadUrl',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}',
    'name' => 'Load url',
    'description' => 'Execute official Airtop API operation `load-url`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the session that owns the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Airtop window ID of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  13 =>
  [
    'operation' => 'close',
    'slug' => 'airtop_sessions_windows_close',
    'class' => 'AirtopSessionsWindowsClose',
    'method' => 'DELETE',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}',
    'name' => 'Close window',
    'description' => 'Execute official Airtop API operation `close`.

Endpoint: DELETE /v1/sessions/{sessionId}/windows/{windowId}.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the session that owns the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Airtop window ID of the browser window.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  14 =>
  [
    'operation' => 'click',
    'slug' => 'airtop_sessions_windows_click',
    'class' => 'AirtopSessionsWindowsClick',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/click',
    'name' => 'Click',
    'description' => 'Execute official Airtop API operation `click`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/click.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  15 =>
  [
    'operation' => 'create-form-filler',
    'slug' => 'airtop_sessions_windows_create_form_filler',
    'class' => 'AirtopSessionsWindowsCreateFormFiller',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/create-form-filler',
    'name' => 'Create a form-filler automation synchronously',
    'description' => 'Execute official Airtop API operation `create-form-filler`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/create-form-filler.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  16 =>
  [
    'operation' => 'file-input',
    'slug' => 'airtop_sessions_windows_file_input',
    'class' => 'AirtopSessionsWindowsFileInput',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/file-input',
    'name' => 'File Input',
    'description' => 'Execute official Airtop API operation `file-input`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/file-input.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  17 =>
  [
    'operation' => 'fill-form',
    'slug' => 'airtop_sessions_windows_fill_form',
    'class' => 'AirtopSessionsWindowsFillForm',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/fill-form',
    'name' => 'Fill a form synchronously using a form-filler automation',
    'description' => 'Execute official Airtop API operation `fill-form`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/fill-form.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  18 =>
  [
    'operation' => 'hover',
    'slug' => 'airtop_sessions_windows_hover',
    'class' => 'AirtopSessionsWindowsHover',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/hover',
    'name' => 'Hover',
    'description' => 'Execute official Airtop API operation `hover`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/hover.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  19 =>
  [
    'operation' => 'monitor',
    'slug' => 'airtop_sessions_windows_monitor',
    'class' => 'AirtopSessionsWindowsMonitor',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/monitor',
    'name' => 'Monitor for a condition',
    'description' => 'Execute official Airtop API operation `monitor`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/monitor.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  20 =>
  [
    'operation' => 'page-query',
    'slug' => 'airtop_sessions_windows_page_query',
    'class' => 'AirtopSessionsWindowsPageQuery',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/page-query',
    'name' => 'Query a page',
    'description' => 'Execute official Airtop API operation `page-query`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/page-query.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  21 =>
  [
    'operation' => 'paginated-extraction',
    'slug' => 'airtop_sessions_windows_paginated_extraction',
    'class' => 'AirtopSessionsWindowsPaginatedExtraction',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/paginated-extraction',
    'name' => 'Query a page with pagination',
    'description' => 'Execute official Airtop API operation `paginated-extraction`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/paginated-extraction.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  22 =>
  [
    'operation' => 'prompt-content',
    'slug' => 'airtop_sessions_windows_prompt_content',
    'class' => 'AirtopSessionsWindowsPromptContent',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/prompt-content',
    'name' => 'Prompt content.',
    'description' => 'Execute official Airtop API operation `prompt-content`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/prompt-content.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  23 =>
  [
    'operation' => 'scrape-content',
    'slug' => 'airtop_sessions_windows_scrape_content',
    'class' => 'AirtopSessionsWindowsScrapeContent',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/scrape-content',
    'name' => 'Scrape',
    'description' => 'Execute official Airtop API operation `scrape-content`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/scrape-content.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window to scrape.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  24 =>
  [
    'operation' => 'screenshot',
    'slug' => 'airtop_sessions_windows_screenshot',
    'class' => 'AirtopSessionsWindowsScreenshot',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/screenshot',
    'name' => 'Take a screenshot',
    'description' => 'Execute official Airtop API operation `screenshot`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/screenshot.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  25 =>
  [
    'operation' => 'scroll',
    'slug' => 'airtop_sessions_windows_scroll',
    'class' => 'AirtopSessionsWindowsScroll',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/scroll',
    'name' => 'Scroll',
    'description' => 'Execute official Airtop API operation `scroll`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/scroll.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  26 =>
  [
    'operation' => 'summarize-content',
    'slug' => 'airtop_sessions_windows_summarize_content',
    'class' => 'AirtopSessionsWindowsSummarizeContent',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/summarize-content',
    'name' => 'Summarize',
    'description' => 'Execute official Airtop API operation `summarize-content`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/summarize-content.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window to summarize.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  27 =>
  [
    'operation' => 'type',
    'slug' => 'airtop_sessions_windows_type',
    'class' => 'AirtopSessionsWindowsType',
    'method' => 'POST',
    'path' => '/v1/sessions/{sessionId}/windows/{windowId}/type',
    'name' => 'Type',
    'description' => 'Execute official Airtop API operation `type`.

Endpoint: POST /v1/sessions/{sessionId}/windows/{windowId}/type.',
    'type' => 'write',
    'tag' => 'subpackage_windows',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The session id for the window.',
      ],
      1 =>
      [
        'name' => 'windowId',
        'param' => 'window_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Airtop window id of the browser window.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  28 =>
  [
    'operation' => 'delete',
    'slug' => 'airtop_profiles_delete',
    'class' => 'AirtopProfilesDelete',
    'method' => 'DELETE',
    'path' => '/v1/profiles',
    'name' => 'Delete profiles',
    'description' => 'Execute official Airtop API operation `delete`.

Endpoint: DELETE /v1/profiles.',
    'type' => 'write',
    'tag' => 'subpackage_profiles',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'profileIds',
        'param' => 'profile_ids',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'DEPRECATED. Use profileNames.',
      ],
      1 =>
      [
        'name' => 'profileNames',
        'param' => 'profile_names',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of profile names.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  29 =>
  [
    'operation' => 'list',
    'slug' => 'airtop_automations_list',
    'class' => 'AirtopAutomationsList',
    'method' => 'GET',
    'path' => '/v1/automations',
    'name' => 'List Automations',
    'description' => 'Execute official Airtop API operation `list`.

Endpoint: GET /v1/automations.',
    'type' => 'read',
    'tag' => 'subpackage_automations',
    'parameters' =>
    [
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  30 =>
  [
    'operation' => 'update',
    'slug' => 'airtop_automations_description_update',
    'class' => 'AirtopAutomationsDescriptionUpdate',
    'method' => 'PUT',
    'path' => '/v1/automations/description',
    'name' => 'Update Automation Description',
    'description' => 'Execute official Airtop API operation `update`.

Endpoint: PUT /v1/automations/description.',
    'type' => 'write',
    'tag' => 'subpackage_automations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  31 =>
  [
    'operation' => 'get',
    'slug' => 'airtop_automations_get',
    'class' => 'AirtopAutomationsGet',
    'method' => 'GET',
    'path' => '/v1/automations/{automationId}',
    'name' => 'Get Automation',
    'description' => 'Execute official Airtop API operation `get`.

Endpoint: GET /v1/automations/{automationId}.',
    'type' => 'read',
    'tag' => 'subpackage_automations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'automationId',
        'param' => 'automation_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the automation to retrieve',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  32 =>
  [
    'operation' => 'delete',
    'slug' => 'airtop_automations_delete',
    'class' => 'AirtopAutomationsDelete',
    'method' => 'DELETE',
    'path' => '/v1/automations/{automationId}',
    'name' => 'Delete Automation',
    'description' => 'Execute official Airtop API operation `delete`.

Endpoint: DELETE /v1/automations/{automationId}.',
    'type' => 'write',
    'tag' => 'subpackage_automations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'automationId',
        'param' => 'automation_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the automation to delete',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  33 =>
  [
    'operation' => 'list',
    'slug' => 'airtop_files_list',
    'class' => 'AirtopFilesList',
    'method' => 'GET',
    'path' => '/v1/files',
    'name' => 'Get a list of files',
    'description' => 'Execute official Airtop API operation `list`.

Endpoint: GET /v1/files.',
    'type' => 'read',
    'tag' => 'subpackage_files',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionIds',
        'param' => 'session_ids',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of IDs of the sessionId of the files to retrieve.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Offset for pagination.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Limit for pagination.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  34 =>
  [
    'operation' => 'create',
    'slug' => 'airtop_files_create',
    'class' => 'AirtopFilesCreate',
    'method' => 'POST',
    'path' => '/v1/files',
    'name' => 'Create a file',
    'description' => 'Execute official Airtop API operation `create`.

Endpoint: POST /v1/files.',
    'type' => 'write',
    'tag' => 'subpackage_files',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  35 =>
  [
    'operation' => 'get',
    'slug' => 'airtop_files_get',
    'class' => 'AirtopFilesGet',
    'method' => 'GET',
    'path' => '/v1/files/{id}',
    'name' => 'Get a file',
    'description' => 'Execute official Airtop API operation `get`.

Endpoint: GET /v1/files/{id}.',
    'type' => 'read',
    'tag' => 'subpackage_files',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the file',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  36 =>
  [
    'operation' => 'delete',
    'slug' => 'airtop_files_delete',
    'class' => 'AirtopFilesDelete',
    'method' => 'DELETE',
    'path' => '/v1/files/{id}',
    'name' => 'Delete a file',
    'description' => 'Execute official Airtop API operation `delete`.

Endpoint: DELETE /v1/files/{id}.',
    'type' => 'write',
    'tag' => 'subpackage_files',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the file',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  37 =>
  [
    'operation' => 'push',
    'slug' => 'airtop_files_push',
    'class' => 'AirtopFilesPush',
    'method' => 'POST',
    'path' => '/v1/files/{id}/push',
    'name' => 'Push a file to a session',
    'description' => 'Execute official Airtop API operation `push`.

Endpoint: POST /v1/files/{id}/push.',
    'type' => 'write',
    'tag' => 'subpackage_files',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the file',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Airtop OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
  38 =>
  [
    'operation' => 'get-request-status',
    'slug' => 'airtop_requests_status_get_request_status',
    'class' => 'AirtopRequestsStatusGetRequestStatus',
    'method' => 'GET',
    'path' => '/v1/requests/{requestId}/status',
    'name' => 'Get the status of an asynchronous request',
    'description' => 'Execute official Airtop API operation `get-request-status`.

Endpoint: GET /v1/requests/{requestId}/status.',
    'type' => 'read',
    'tag' => 'subpackage_requests',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the request to check.',
      ],
    ],
    'source_url' => 'https://docs.airtop.ai/openapi.json',
  ],
];
    }
}
