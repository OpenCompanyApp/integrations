<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a Radar attempt.
 *
 * Maps to the official WorkOS endpoint put /radar/attempts/{id}.
 */
class WorkOSRadarStandaloneUpdateRadarAttempt extends AbstractWorkOSTool
{
    protected const NAME = 'workos_radar_standalone_update_radar_attempt';
    protected const DESCRIPTION = 'Update a Radar attempt

Official WorkOS endpoint: PUT /radar/attempts/{id}

You may optionally inform Radar that an authentication attempt or challenge was successful using this endpoint. Some Radar controls depend on tracking recent successful attempts, such as impossible travel.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/radar/attempts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
