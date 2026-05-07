<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an SLA.
 *
 * Maps to the official Rootly endpoint get /v1/slas/{id}.
 */
class RootlyGetSla extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_sla';
    protected const DESCRIPTION = 'Retrieves an SLA

Official Rootly endpoint: GET /v1/slas/{id}

Retrieves a specific SLA by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/slas/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
