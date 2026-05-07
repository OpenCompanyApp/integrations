<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get one paper by Semantic Scholar-supported paper ID.
 */
class SemanticScholarGetPaper extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_paper';
    protected const DESCRIPTION = 'Get details about a Semantic Scholar paper by paper ID, DOI, arXiv ID, CorpusID, PubMed ID, or ACL ID.';
    protected const PATH = 'paper/{paper_id}';
    protected const PATH_PARAMS = ['paper_id'];
    protected const PARAMETERS = [
        'paper_id' => ['type' => 'string', 'required' => true, 'description' => 'Paper ID accepted by Semantic Scholar.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
