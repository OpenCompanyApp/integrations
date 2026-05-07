<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Create nexus endpoint.
 *
 * Maps to the official Temporal endpoint post /cluster/nexus/endpoints.
 */
class TemporalCreateNexusEndpoint2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_create_nexus_endpoint_2';
    protected const DESCRIPTION = 'Create nexus endpoint

Official Temporal endpoint: POST /cluster/nexus/endpoints

Create a Nexus endpoint. This will fail if an endpoint with the same name is already registered with a status of
 ALREADY_EXISTS.
 Returns the created endpoint with its initial version. You may use this version for subsequent updates.';
    protected const PARAMETERS = array (
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/cluster/nexus/endpoints';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
