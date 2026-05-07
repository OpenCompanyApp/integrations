<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RemoveCustomVCSRepository.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/console/orgs/{orgName}/integrations/custom/{integrationId}/repos.
 */
class PulumiVCSIntegrationsRemoveCustomVCSRepository extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_remove_custom_vcsrepository';
    protected const DESCRIPTION = 'RemoveCustomVCSRepository

Official Pulumi Cloud endpoint: DELETE /api/console/orgs/{orgName}/integrations/custom/{integrationId}/repos

Removes a repository from a custom VCS integration. The repository is identified by its name, as provided in the request. Returns 404 if the integration or repository is not found.';
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
    protected const METHOD = 'delete';
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
