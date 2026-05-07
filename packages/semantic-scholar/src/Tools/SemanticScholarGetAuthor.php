<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get one author by Semantic Scholar author ID.
 */
class SemanticScholarGetAuthor extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_author';
    protected const DESCRIPTION = 'Get details about a Semantic Scholar author.';
    protected const PATH = 'author/{author_id}';
    protected const PATH_PARAMS = ['author_id'];
    protected const PARAMETERS = [
        'author_id' => ['type' => 'string', 'required' => true, 'description' => 'Semantic Scholar author ID.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}
