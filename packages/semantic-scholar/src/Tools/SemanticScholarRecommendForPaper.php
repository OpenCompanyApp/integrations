<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get recommendations for a single paper.
 */
class SemanticScholarRecommendForPaper extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_recommend_for_paper';
    protected const DESCRIPTION = 'Get recommended papers for a single positive example paper.';
    protected const SERVICE_METHOD = 'recommendationsGet';
    protected const PATH = 'papers/forpaper/{paper_id}';
    protected const PATH_PARAMS = ['paper_id'];
    protected const PARAMETERS = [
        'paper_id' => ['type' => 'string', 'required' => true, 'description' => 'Seed paper ID.'],
        'from' => ['type' => 'string', 'required' => false, 'description' => 'Recommendation source parameter supported by the API.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum recommendations to return.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
