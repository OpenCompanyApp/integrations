<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListRotators.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/rotators.
 */
class PulumiEnvironmentsListRotators extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_rotators';
    protected const DESCRIPTION = 'ListRotators

Official Pulumi Cloud endpoint: GET /api/esc/rotators

Returns a list of all available Pulumi ESC secret rotators. Rotators are integrations that automatically rotate secrets in external systems via the fn::rotate function in environment definitions. Optionally filter by organization using the orgName query parameter to see only rotators available to that organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `orgName` from the official Pulumi Cloud API operation. Filter rotators available to this organization',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/rotators';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
