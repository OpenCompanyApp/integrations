<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Retrospective Configuration.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_configurations/{id}.
 */
class RootlyGetRetrospectiveConfiguration extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_retrospective_configuration';
    protected const DESCRIPTION = 'Retrieves a Retrospective Configuration

Official Rootly endpoint: GET /v1/retrospective_configurations/{id}

Retrieves a specific retrospective_configuration by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: severities,groups',
    'enum' =>
    array (
      0 => 'severities',
      1 => 'groups',
      2 => 'incident_types',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_configurations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
