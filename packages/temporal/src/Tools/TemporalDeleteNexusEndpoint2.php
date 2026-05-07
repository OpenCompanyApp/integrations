<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Delete nexus endpoint.
 *
 * Maps to the official Temporal endpoint delete /cluster/nexus/endpoints/{id}.
 */
class TemporalDeleteNexusEndpoint2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_delete_nexus_endpoint_2';
    protected const DESCRIPTION = 'Delete nexus endpoint

Official Temporal endpoint: DELETE /cluster/nexus/endpoints/{id}

Delete an incoming Nexus service by ID.';
    protected const PARAMETERS = array (
  'id' => array (
  'type' => 'string',
  'description' => 'Server-generated unique endpoint ID.',
  'required' => true,
),
  'version' => array (
  'type' => 'string',
  'description' => 'Data version for this endpoint. Must match current version.',
),
);
    protected const METHOD = 'delete';
    protected const PATH = '/cluster/nexus/endpoints/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
