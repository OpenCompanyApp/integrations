<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get authors for a paper.
 */
class SemanticScholarGetPaperAuthors extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_paper_authors';
    protected const DESCRIPTION = 'Get details about a paper authors using /graph/v1/paper/{paper_id}/authors.';
    protected const PATH = 'paper/{paper_id}/authors';
    protected const PATH_PARAMS = ['paper_id'];
    protected const PARAMETERS = [
        'paper_id' => ['type' => 'string', 'required' => true, 'description' => 'Paper ID accepted by Semantic Scholar.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
