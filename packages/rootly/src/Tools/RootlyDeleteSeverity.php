<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a severity.
 *
 * Maps to the official Rootly endpoint delete /v1/severities/{id}.
 */
class RootlyDeleteSeverity extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_severity';
    protected const DESCRIPTION = 'Delete a severity

Official Rootly endpoint: DELETE /v1/severities/{id}

Delete a specific severity by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/severities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
