<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get papers referenced by a paper.
 */
class SemanticScholarGetPaperReferences extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_paper_references';
    protected const DESCRIPTION = 'Get details about papers referenced by a Semantic Scholar paper.';
    protected const PATH = 'paper/{paper_id}/references';
    protected const PATH_PARAMS = ['paper_id'];
    protected const PARAMETERS = [
        'paper_id' => ['type' => 'string', 'required' => true, 'description' => 'Paper ID accepted by Semantic Scholar.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
