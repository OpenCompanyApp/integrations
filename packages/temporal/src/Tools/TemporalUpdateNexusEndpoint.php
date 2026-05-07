<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Update nexus endpoint.
 *
 * Maps to the official Temporal endpoint post /api/v1/nexus/endpoints/{id}/update.
 */
class TemporalUpdateNexusEndpoint extends AbstractTemporalTool
{
    protected const NAME = 'temporal_update_nexus_endpoint';
    protected const DESCRIPTION = 'Update nexus endpoint

Official Temporal endpoint: POST /api/v1/nexus/endpoints/{id}/update

Optimistically update a Nexus endpoint based on provided version as obtained via the `GetNexusEndpoint` or
 `ListNexusEndpointResponse` APIs. This will fail with a status of FAILED_PRECONDITION if the version does not
 match.
 Returns the updated endpoint with its updated version. You may use this version for subsequent updates. You don\'t
 need to increment the version yourself. The server will increment the version for you after each update.';
    protected const PARAMETERS = array (
  'id' => array (
  'type' => 'string',
  'description' => 'Server-generated unique endpoint ID.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/nexus/endpoints/{id}/update';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
