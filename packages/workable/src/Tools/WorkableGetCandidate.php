<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get full details for a specific Workable candidate.
 */
class WorkableGetCandidate implements Tool
{
    /**
     * Create a new WorkableGetCandidate tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'workable_get_candidate';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get full details for a specific Workable candidate by ID. Returns profile info, resume, cover letter, application stage, and activity history.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The candidate ID (e.g., "abc123def456").'],
        ];
    }

    /**
     * Execute the tool and return the candidate details.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getCandidate($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
