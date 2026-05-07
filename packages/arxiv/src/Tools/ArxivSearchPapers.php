<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Arxiv\ArxivService;

/**
 * Search arXiv papers with the official query interface.
 *
 * Supports search_query, id_list filtering, paging, and arXiv sort options.
 */
class ArxivSearchPapers implements Tool
{
    /**
     * @param  ArxivService  $service  arXiv API client.
     */
    public function __construct(private ArxivService $service) {}

    public function name(): string
    {
        return 'arxiv_search_papers';
    }

    public function description(): string
    {
        return 'Search arXiv papers using the official Atom API.

Use arXiv query syntax such as all:electron, ti:"diffusion model", au:"Smith", cat:cs.AI, and boolean operators.';
    }

    public function parameters(): array
    {
        return [
            'search_query' => ['type' => 'string', 'required' => false, 'description' => 'arXiv search expression such as all:electron, ti:"transformer", au:"Smith", or cat:cs.AI.'],
            'id_list' => ['type' => 'array', 'required' => false, 'description' => 'Optional arXiv IDs used alone or as a filter with search_query.', 'items' => ['type' => 'string']],
            'start' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based offset of the first returned result.'],
            'max_results' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return. arXiv recommends small slices for repeated calls.'],
            'sortBy' => ['type' => 'string', 'required' => false, 'description' => 'Sort field.', 'enum' => ['relevance', 'lastUpdatedDate', 'submittedDate']],
            'sortOrder' => ['type' => 'string', 'required' => false, 'description' => 'Sort direction.', 'enum' => ['ascending', 'descending']],
        ];
    }

    /**
     * Search arXiv and return normalized Atom feed metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (($args['search_query'] ?? '') === '' && empty($args['id_list'])) {
                throw new InvalidArgumentException('Provide search_query or id_list.');
            }

            return ToolResult::success($this->service->query($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
