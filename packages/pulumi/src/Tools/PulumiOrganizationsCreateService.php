<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateService.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/services.
 */
class PulumiOrganizationsCreateService extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_service';
    protected const DESCRIPTION = 'CreateService

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/services

Creates a new service account in an organization. Service accounts provide programmatic, non-human identities for accessing Pulumi Cloud resources. They are scoped to an organization and can hold access tokens, belong to teams, and have stack permissions. The service name must be unique within the organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/services';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
