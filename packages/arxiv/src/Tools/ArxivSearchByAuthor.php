<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * Search arXiv papers by author name.
 */
class ArxivSearchByAuthor extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_search_by_author';
    protected const TOOL_DESCRIPTION = 'Search arXiv papers by author name using the official au field.';
    protected const PARAMETERS = [
        'author' => ['type' => 'string', 'required' => true, 'description' => 'Author name or phrase, for example Ada Lovelace.'],
        'start' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
        'max_results' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'sortBy' => ['type' => 'string', 'required' => false, 'description' => 'Sort field.', 'enum' => ['relevance', 'lastUpdatedDate', 'submittedDate']],
        'sortOrder' => ['type' => 'string', 'required' => false, 'description' => 'Sort direction.', 'enum' => ['ascending', 'descending']],
    ];

    protected function run(array $args): array
    {
        return $this->service->searchByAuthor(
            $this->required($args, 'author'),
            $this->optional($args, ['start', 'max_results', 'sortBy', 'sortOrder']),
        );
    }
}
