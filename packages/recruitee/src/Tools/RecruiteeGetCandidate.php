<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

use OpenCompany\Integrations\Recruitee\RecruiteeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RecruiteeGetCandidate implements Tool
{
    /**
     * Create a new RecruiteeGetCandidate tool instance.
     */
    public function __construct(
        private RecruiteeService $service,
    ) {}

    /**
     * Get the tool name (slug).
     */
    public function name(): string
    {
        return 'recruitee_get_candidate';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get details for a specific candidate in Recruitee. Returns the full candidate profile including contact info, resume, and application history.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The candidate ID to retrieve.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recruitee integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getCandidate((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
