<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list candidates for a specific Workable job.
 *
 * Supports pagination via limit and offset parameters.
 */
class WorkableListCandidates implements Tool
{
    /**
     * Create a new WorkableListCandidates tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'workable_list_candidates';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List candidates for a specific Workable job. Returns paginated results with candidate names, emails, stages, and applied dates.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'shortcode' => ['type' => 'string', 'required' => true, 'description' => 'The job shortcode to list candidates for (e.g., "GROVF002").'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    /**
     * Execute the tool and return the list of candidates.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            $shortcode = $args['shortcode'] ?? '';

            if (empty($shortcode)) {
                return ToolResult::error('The "shortcode" parameter is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : null;

            $result = $this->service->listCandidates($shortcode, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
