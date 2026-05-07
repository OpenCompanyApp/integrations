<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get papers that cite a paper.
 */
class SemanticScholarGetPaperCitations extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_paper_citations';
    protected const DESCRIPTION = 'Get details about papers that cite a Semantic Scholar paper.';
    protected const PATH = 'paper/{paper_id}/citations';
    protected const PATH_PARAMS = ['paper_id'];
    protected const PARAMETERS = [
        'paper_id' => ['type' => 'string', 'required' => true, 'description' => 'Paper ID accepted by Semantic Scholar.'],
        'publicationDateOrYear' => ['type' => 'string', 'required' => false, 'description' => 'Publication date or year filter.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
