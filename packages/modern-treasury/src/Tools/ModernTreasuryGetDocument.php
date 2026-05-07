<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get document.
 *
 * Maps to the official Modern Treasury endpoint get /api/documents/{id}.
 */
class ModernTreasuryGetDocument extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_document';
    protected const DESCRIPTION = 'get document

Official Modern Treasury endpoint: GET /api/documents/{id}

Get an existing document.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/documents/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
