<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create Transformation Project.
 *
 * Maps to the official Fivetran endpoint post /v1/transformation-projects.
 */
class FivetranCreateTransformationProject extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_transformation_project';
    protected const DESCRIPTION = 'Create Transformation Project

Official Fivetran endpoint: POST /v1/transformation-projects

Creates a new transformation project.';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/transformation-projects';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
