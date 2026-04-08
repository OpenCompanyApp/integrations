<?php

namespace OpenCompany\Integrations\Taiga\Tools;

use OpenCompany\Integrations\Taiga\TaigaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a single Taiga project.
 *
 * Returns project metadata including name, slug, description,
 * creation date, membership, issue types, statuses, and more.
 */
class TaigaGetProject implements Tool
{
    public function __construct(
        private TaigaService $service,
    ) {}

    public function name(): string
    {
        return 'taiga_get_project';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Taiga project by its ID. Returns project name, slug, description, statuses, and membership details.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Taiga project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Taiga integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getProject((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
