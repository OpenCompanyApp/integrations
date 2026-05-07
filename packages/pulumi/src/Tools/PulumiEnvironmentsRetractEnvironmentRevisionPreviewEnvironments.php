<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RetractEnvironmentRevision.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/environments/{orgName}/{envName}/versions/{version}/retract.
 */
class PulumiEnvironmentsRetractEnvironmentRevisionPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_retract_environment_revision_preview_environments';
    protected const DESCRIPTION = 'RetractEnvironmentRevision

Official Pulumi Cloud endpoint: POST /api/preview/environments/{orgName}/{envName}/versions/{version}/retract

Retracts a specific revision of a Pulumi ESC environment, marking it as withdrawn. A retracted revision remains in the history but is no longer considered a valid version for use. The request body may include a reason for the retraction. The revision is identified by the version path parameter. Returns 204 on success with no response body.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. The revision version number',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/versions/{version}/retract';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
