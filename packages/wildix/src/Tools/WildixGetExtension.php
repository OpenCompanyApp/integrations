<?php

namespace OpenCompany\Integrations\Wildix\Tools;

use OpenCompany\Integrations\Wildix\WildixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WildixGetExtension implements Tool
{
    public function __construct(
        private WildixService $service,
    ) {}

    public function name(): string
    {
        return 'wildix_get_extension';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific PBX extension by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the extension.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wildix integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getExtension($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
