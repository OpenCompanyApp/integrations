<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an SLA.
 *
 * Maps to the official Rootly endpoint put /v1/slas/{id}.
 */
class RootlyUpdateSla extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_sla';
    protected const DESCRIPTION = 'Update an SLA

Official Rootly endpoint: PUT /v1/slas/{id}

Update a specific SLA by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/slas/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
