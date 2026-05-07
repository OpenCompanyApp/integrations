<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GenerateImportCode.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/import/code/generate.
 */
class PulumiInsightsGenerateImportCode extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_generate_import_code';
    protected const DESCRIPTION = 'GenerateImportCode

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/import/code/generate

Generates Pulumi code in the specified language to import discovered resources into a Pulumi stack.';
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
    protected const PATH = '/api/preview/insights/{orgName}/import/code/generate';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
