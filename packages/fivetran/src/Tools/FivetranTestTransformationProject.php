<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Test Transformation Project.
 *
 * Maps to the official Fivetran endpoint post /v1/transformation-projects/{projectId}/test.
 */
class FivetranTestTransformationProject extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_test_transformation_project';
    protected const DESCRIPTION = 'Test Transformation Project

Official Fivetran endpoint: POST /v1/transformation-projects/{projectId}/test

Triggers tests for an existing transformation project.';
    protected const PARAMETERS = array (
  'project_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId` from the official Fivetran API operation. The unique identifier for the transformation project within the Fivetran system',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/transformation-projects/{projectId}/test';
    protected const PATH_PARAMS = array (
  'projectId' => 'project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
