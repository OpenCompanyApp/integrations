<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * Search arXiv papers with recent submissions first.
 */
class ArxivSearchRecent extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_search_recent';
    protected const TOOL_DESCRIPTION = 'Search arXiv and sort by newest submitted papers first.';
    protected const PARAMETERS = [
        'search_query' => ['type' => 'string', 'required' => true, 'description' => 'arXiv search expression such as all:agent or cat:cs.AI.'],
        'start' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
        'max_results' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->searchRecent(
            $this->required($args, 'search_query'),
            $this->optional($args, ['start', 'max_results']),
        );
    }
}
