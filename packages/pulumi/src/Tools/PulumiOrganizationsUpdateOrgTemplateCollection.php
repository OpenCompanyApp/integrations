<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateOrgTemplateCollection.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/templates/sources/{templateID}.
 */
class PulumiOrganizationsUpdateOrgTemplateCollection extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_org_template_collection';
    protected const DESCRIPTION = 'UpdateOrgTemplateCollection

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/templates/sources/{templateID}

Updates an existing template collection for an organization, allowing modification of the template source URL, name, or other configuration. Template collections define where project templates are sourced from.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'template_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `templateID` from the official Pulumi Cloud API operation. The template identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/templates/sources/{templateID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'templateID' => 'template_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
