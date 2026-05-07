<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteOrgTemplateCollection.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/templates/sources/{templateID}.
 */
class PulumiOrganizationsDeleteOrgTemplateCollection extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_org_template_collection';
    protected const DESCRIPTION = 'DeleteOrgTemplateCollection

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/templates/sources/{templateID}

Removes a template collection (source) from an organization. Templates sourced from this collection will no longer be available to organization members when creating new stacks. Returns 400 if the template ID is invalid, or 404 if the template source does not exist.';
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
);
    protected const METHOD = 'delete';
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
