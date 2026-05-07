<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteResourceMigrationAnnotation.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/migration.
 */
class PulumiInsightsDeleteResourceMigrationAnnotation extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_delete_resource_migration_annotation';
    protected const DESCRIPTION = 'DeleteResourceMigrationAnnotation

Official Pulumi Cloud endpoint: DELETE /api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/migration

Removes a migration annotation from a discovered resource. The resource is identified by its URN passed as a query parameter.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The discovered project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The discovered stack name',
  ),
  'resource_urn' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `resourceUrn` from the official Pulumi Cloud API operation. URN of the resource to remove the annotation from',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/migration';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
  'resourceUrn' => 'resource_urn',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
