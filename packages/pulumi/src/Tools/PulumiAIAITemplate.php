<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AITemplate.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/ai/template.
 */
class PulumiAIAITemplate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_aitemplate';
    protected const DESCRIPTION = 'AITemplate

Official Pulumi Cloud endpoint: POST /api/ai/template

Generates a Pulumi template using the Pulumi AI service.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/ai/template';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
