<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get document - nested path (legacy).
 *
 * Maps to the official Modern Treasury endpoint get /api/{documentable_type}/{documentable_id}/documents/{id}.
 */
class ModernTreasuryGetDocumentNested extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_document_nested';
    protected const DESCRIPTION = 'get document - nested path (legacy)

Official Modern Treasury endpoint: GET /api/{documentable_type}/{documentable_id}/documents/{id}

Get an existing document.';
    protected const PARAMETERS = array (
  'documentable_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `documentable_type` from the official Modern Treasury API operation.',
  ),
  'documentable_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `documentable_id` from the official Modern Treasury API operation.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/{documentable_type}/{documentable_id}/documents/{id}';
    protected const PATH_PARAMS = array (
  'documentable_type' => 'documentable_type',
  'documentable_id' => 'documentable_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
