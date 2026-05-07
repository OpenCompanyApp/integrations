<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a retrospective configuration.
 *
 * Maps to the official Rootly endpoint put /v1/retrospective_configurations/{id}.
 */
class RootlyUpdateRetrospectiveConfiguration extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_retrospective_configuration';
    protected const DESCRIPTION = 'Update a retrospective configuration

Official Rootly endpoint: PUT /v1/retrospective_configurations/{id}

Update a specific retrospective configuration by id';
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
    protected const PATH = '/v1/retrospective_configurations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
