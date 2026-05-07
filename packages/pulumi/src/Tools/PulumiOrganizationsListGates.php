<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListChangeGates.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/change-gates/{orgName}.
 */
class PulumiOrganizationsListGates extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_gates';
    protected const DESCRIPTION = 'ListChangeGates

Official Pulumi Cloud endpoint: GET /api/change-gates/{orgName}

Lists change gates for an entity within the organization. Change gates define approval requirements that must be satisfied before changes can be applied to infrastructure resources. Currently supports listing gates for a single entity specified by entityType and qualifiedName query parameters.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'entity_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entityType` from the official Pulumi Cloud API operation. The entity type to filter by',
  ),
  'qualified_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `qualifiedName` from the official Pulumi Cloud API operation. The fully qualified entity name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/change-gates/{orgName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'entityType' => 'entity_type',
  'qualifiedName' => 'qualified_name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
