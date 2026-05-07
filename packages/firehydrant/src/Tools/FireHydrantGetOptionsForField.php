<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List a field's configuration options for a ticketing project.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/projects/{ticketing_project_id}/configuration_options/options_for/{field_id}.
 */
class FireHydrantGetOptionsForField extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_options_for_field';
    protected const DESCRIPTION = 'List a field\'s configuration options for a ticketing project

Official FireHydrant endpoint: GET /v1/ticketing/projects/{ticketing_project_id}/configuration_options/options_for/{field_id}

List a field\'s configuration options for a ticketing project';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'field_id parameter.',
    'required' => true,
  ),
  'ticketing_project_id' =>
  array (
    'type' => 'string',
    'description' => 'ticketing_project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/projects/{ticketing_project_id}/configuration_options/options_for/{field_id}';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
  'ticketing_project_id' => 'ticketing_project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
