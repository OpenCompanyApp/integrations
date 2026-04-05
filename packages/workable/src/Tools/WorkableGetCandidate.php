<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve details for a specific Workable candidate.
 *
 * Returns full candidate profile including name, email, phone,
 * resume, cover letter, timeline, and application stage.
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
     * The tool identifier.
     */
    public function name(): string
    {
        return 'workable_get_candidate';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details for a specific candidate in Workable by their ID. Returns profile info, resume, cover letter, timeline, and current application stage.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The candidate ID. Find IDs using the list_candidates tool.'],
        ];
    }

    /**
     * Execute the get candidate request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The id parameter is required.');
            }

            $result = $this->service->getCandidate($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
