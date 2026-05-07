<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStacksAnnotation.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/annotations/{kind}.
 */
class PulumiStacksGetStacksAnnotation extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stacks_annotation';
    protected const DESCRIPTION = 'GetStacksAnnotation

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/annotations/{kind}

Retrieves an annotation for a stack, identified by the annotation kind. Annotations are structured metadata that can be attached to stacks for purposes such as compliance tracking, custom metadata, or integration data. The optional \'source\' and \'version\' query parameters allow filtering by annotation source and specific version. Returns 404 if the annotation does not exist.';
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
    'description' => 'Query parameter `version` from the official Pulumi Cloud API operation. The annotation version number, used for filtering by a specific version',
  ),
);
    protected const METHOD = 'get';
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
