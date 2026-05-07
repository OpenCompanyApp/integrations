<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AddCustomVCSRepository.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/console/orgs/{orgName}/integrations/custom/{integrationId}/repos.
 */
class PulumiVCSIntegrationsAddCustomVCSRepository extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_add_custom_vcsrepository';
    protected const DESCRIPTION = 'AddCustomVCSRepository

Official Pulumi Cloud endpoint: POST /api/console/orgs/{orgName}/integrations/custom/{integrationId}/repos

Adds a repository to a custom VCS integration. The repository name must be unique within the integration. Returns 409 Conflict if a repository with the same name is already configured.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integrationId` from the official Pulumi Cloud API operation. The custom VCS integration identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/custom/{integrationId}/repos';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'integrationId' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
