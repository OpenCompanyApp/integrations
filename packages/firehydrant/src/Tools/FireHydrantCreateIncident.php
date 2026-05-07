<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an incident.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents.
 */
class FireHydrantCreateIncident extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident';
    protected const DESCRIPTION = 'Create an incident

Official FireHydrant endpoint: POST /v1/incidents

Create a new incident';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
