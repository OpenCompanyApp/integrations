<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * Search arXiv papers by category code.
 */
class ArxivSearchByCategory extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_search_by_category';
    protected const TOOL_DESCRIPTION = 'Search recent arXiv papers in a category such as cs.AI or math.AG.';
    protected const PARAMETERS = [
        'category' => ['type' => 'string', 'required' => true, 'description' => 'arXiv category code, for example cs.AI.'],
        'start' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
        'max_results' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'sortBy' => ['type' => 'string', 'required' => false, 'description' => 'Sort field.', 'enum' => ['relevance', 'lastUpdatedDate', 'submittedDate']],
        'sortOrder' => ['type' => 'string', 'required' => false, 'description' => 'Sort direction.', 'enum' => ['ascending', 'descending']],
    ];

    protected function run(array $args): array
    {
        return $this->service->searchByCategory(
            $this->required($args, 'category'),
            $this->optional($args, ['start', 'max_results', 'sortBy', 'sortOrder']),
        );
    }
}
