<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get recommended papers from positive and negative examples.
 */
class SemanticScholarRecommendPapers extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_recommend_papers';
    protected const DESCRIPTION = 'Get recommended papers for lists of positive and negative example papers.';
    protected const SERVICE_METHOD = 'recommendationsPost';
    protected const PATH = 'papers/';
    protected const BODY_KEY = 'payload';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'JSON body with positivePaperIds and optional negativePaperIds arrays.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum recommendations to return.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
