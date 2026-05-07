<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpsertStacksAnnotations.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/stacks/{orgName}/{projectName}/{stackName}/annotations/{kind}.
 */
class PulumiStacksUpsertStacksAnnotations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_upsert_stacks_annotations';
    protected const DESCRIPTION = 'UpsertStacksAnnotations

Official Pulumi Cloud endpoint: PATCH /api/stacks/{orgName}/{projectName}/{stackName}/annotations/{kind}

Creates or updates an annotation for a stack, identified by the annotation kind. Annotations are structured metadata that can be attached to stacks. The \'version\' query parameter supports optimistic concurrency control: if provided, the update only succeeds if the current annotation version matches. Returns 409 if the annotation has changed since it was read (version conflict).';
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
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'kind' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `kind` from the official Pulumi Cloud API operation. The annotation kind',
  ),
  'source' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `source` from the official Pulumi Cloud API operation. The annotation source',
  ),
  'version' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `version` from the official Pulumi Cloud API operation. The expected annotation version for optimistic concurrency control',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/annotations/{kind}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'kind' => 'kind',
);
    protected const QUERY_PARAMS = array (
  'source' => 'source',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
