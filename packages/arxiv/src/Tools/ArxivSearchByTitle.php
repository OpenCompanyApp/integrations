<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * Search arXiv papers by title text.
 */
class ArxivSearchByTitle extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_search_by_title';
    protected const TOOL_DESCRIPTION = 'Search arXiv papers by title using the official ti field.';
    protected const PARAMETERS = [
        'title' => ['type' => 'string', 'required' => true, 'description' => 'Title text or phrase.'],
        'start' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
        'max_results' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'sortBy' => ['type' => 'string', 'required' => false, 'description' => 'Sort field.', 'enum' => ['relevance', 'lastUpdatedDate', 'submittedDate']],
        'sortOrder' => ['type' => 'string', 'required' => false, 'description' => 'Sort direction.', 'enum' => ['ascending', 'descending']],
    ];

    protected function run(array $args): array
    {
        return $this->service->searchByTitle(
            $this->required($args, 'title'),
            $this->optional($args, ['start', 'max_results', 'sortBy', 'sortOrder']),
        );
    }
}
