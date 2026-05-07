<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetEnvironmentMetadata.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/{envName}/metadata.
 */
class PulumiEnvironmentsGetEnvironmentMetadataPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_get_environment_metadata_preview_environments';
    protected const DESCRIPTION = 'GetEnvironmentMetadata

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/{envName}/metadata

Returns metadata for a Pulumi ESC environment, including the calling user\'s effective permission level (read, open, write, admin), creation and modification timestamps, the environment\'s project, and other administrative information. This is useful for determining what actions the current user can perform on the environment before attempting those operations.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/metadata';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
