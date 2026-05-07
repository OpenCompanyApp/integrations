<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpsertResourceMigrationAnnotation.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/migration.
 */
class PulumiInsightsUpsertResourceMigrationAnnotation extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_upsert_resource_migration_annotation';
    protected const DESCRIPTION = 'UpsertResourceMigrationAnnotation

Official Pulumi Cloud endpoint: PUT /api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/migration

Creates or updates a migration annotation on a discovered resource. The resource is identified by its URN in the request body. At least one of note or statusOverride must be non-empty; requests with both empty are rejected with 400. The statusOverride, if provided, must be Migrated or NotApplicable.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/preview/insights/{orgName}/discovered-stacks/{projectName}/{stackName}/migration';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
