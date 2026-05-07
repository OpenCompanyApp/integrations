<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Revoke the Snyk App session of an active user.
 *
 * Maps to the official Snyk endpoint delete /self/apps/{app_id}/sessions/{session_id}.
 */
class SnykRevokeUserAppSession extends AbstractSnykTool
{
    protected const NAME = 'snyk_revoke_user_app_session';
    protected const DESCRIPTION = 'Revoke the Snyk App session of an active user

Official Snyk endpoint: DELETE /self/apps/{app_id}/sessions/{session_id}

Revoke the Snyk App session of an active user';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'app_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `app_id` from the official Snyk API operation. App ID',
  ),
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id` from the official Snyk API operation. Session ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/self/apps/{app_id}/sessions/{session_id}';
    protected const PATH_PARAMS = array (
  'app_id' => 'app_id',
  'session_id' => 'session_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
