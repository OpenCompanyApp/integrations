<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get multiple papers by ID.
 */
class SemanticScholarBatchGetPapers extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_batch_get_papers';
    protected const DESCRIPTION = 'Get details for multiple Semantic Scholar papers at once using /graph/v1/paper/batch.';
    protected const SERVICE_METHOD = 'graphPost';
    protected const PATH = 'paper/batch';
    protected const BODY_KEY = 'payload';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'JSON body with ids array, for example {ids: ["CorpusId:..."]}.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
