<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetRotatorSchema.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/rotators/{rotatorName}/schema.
 */
class PulumiEnvironmentsGetRotatorSchema extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_get_rotator_schema';
    protected const DESCRIPTION = 'GetRotatorSchema

Official Pulumi Cloud endpoint: GET /api/esc/rotators/{rotatorName}/schema

Returns the JSON schema for a Pulumi ESC secret rotator. Rotators are integrations that automatically rotate secrets in external systems via fn::rotate. The schema describes the rotator\'s input parameters, output structure, and configuration options. The rotator is identified by name in the URL path.';
    protected const PARAMETERS = array (
  'rotator_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `rotatorName` from the official Pulumi Cloud API operation. The rotator name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/rotators/{rotatorName}/schema';
    protected const PATH_PARAMS = array (
  'rotatorName' => 'rotator_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
