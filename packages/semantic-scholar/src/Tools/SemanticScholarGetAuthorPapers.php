<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get papers for an author.
 */
class SemanticScholarGetAuthorPapers extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_author_papers';
    protected const DESCRIPTION = 'Get details about papers by a Semantic Scholar author.';
    protected const PATH = 'author/{author_id}/papers';
    protected const PATH_PARAMS = ['author_id'];
    protected const PARAMETERS = [
        'author_id' => ['type' => 'string', 'required' => true, 'description' => 'Semantic Scholar author ID.'],
        'publicationDateOrYear' => ['type' => 'string', 'required' => false, 'description' => 'Publication date or year filter.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
