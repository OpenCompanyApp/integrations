<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get multiple authors by ID.
 */
class SemanticScholarBatchGetAuthors extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_batch_get_authors';
    protected const DESCRIPTION = 'Get details for multiple Semantic Scholar authors at once using /graph/v1/author/batch.';
    protected const SERVICE_METHOD = 'graphPost';
    protected const PATH = 'author/batch';
    protected const BODY_KEY = 'payload';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'JSON body with ids array.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
