<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Arxiv\ArxivService;

/**
 * Retrieve arXiv paper metadata by one or more IDs.
 *
 * Uses the official query API's id_list parameter and returns normalized Atom
 * metadata for each matching paper.
 */
class ArxivGetPapers implements Tool
{
    /**
     * @param  ArxivService  $service  arXiv API client.
     */
    public function __construct(private ArxivService $service) {}

    public function name(): string
    {
        return 'arxiv_get_papers';
    }

    public function description(): string
    {
        return 'Retrieve arXiv paper metadata by one or more arXiv IDs.';
    }

    public function parameters(): array
    {
        return [
            'id_list' => ['type' => 'array', 'required' => true, 'description' => 'arXiv IDs such as 2103.15348 or 2103.15348v1.', 'items' => ['type' => 'string']],
        ];
    }

    /**
     * Retrieve paper metadata by arXiv ID list.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $ids = $args['id_list'] ?? [];
            if (!is_array($ids) || $ids === []) {
                throw new InvalidArgumentException('id_list must be a non-empty array of arXiv IDs.');
            }

            return ToolResult::success($this->service->getByIds($ids));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
