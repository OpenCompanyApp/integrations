<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListServices.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/services.
 */
class PulumiOrganizationsListServices extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_services';
    protected const DESCRIPTION = 'ListServices

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/services

Returns all service accounts in an organization. Service accounts provide programmatic, non-human identities for accessing Pulumi Cloud resources. They can hold access tokens, belong to teams, and have stack permissions, making them suitable for CI/CD pipelines, automation tools, and other machine-to-machine integrations.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
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
