<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get nexus endpoint.
 *
 * Maps to the official Temporal endpoint get /api/v1/nexus/endpoints/{id}.
 */
class TemporalGetNexusEndpoint extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_nexus_endpoint';
    protected const DESCRIPTION = 'Get nexus endpoint

Official Temporal endpoint: GET /api/v1/nexus/endpoints/{id}

Get a registered Nexus endpoint by ID. The returned version can be used for optimistic updates.';
    protected const PARAMETERS = array (
  'id' => array (
  'type' => 'string',
  'description' => 'Server-generated unique endpoint ID.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/nexus/endpoints/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
