<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete API Keys V1.
 *
 * Maps to the official incident.io endpoint delete /v1/api_keys/{id}.
 */
class IncidentIoApiKeysV1Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_api_keys_v1_delete';
    protected const DESCRIPTION = 'Delete API Keys V1

Official incident.io endpoint: DELETE /v1/api_keys/{id}

Delete an existing API key. The calling API key does not need to hold the scopes of the key being deleted, but a team-scoped key can only delete keys belonging to its teams.

This endpoint requires a valid API key with the `api_keys_manage` role at either the account level or team level.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the API key to delete',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/api_keys/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
