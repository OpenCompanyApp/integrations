<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\Integrations\Abyssale\AbyssaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AbyssaleGetGeneration implements Tool
{
    public function __construct(
        private AbyssaleService $service,
    ) {}

    public function name(): string
    {
        return 'abyssale_get_generation';
    }

    public function description(): string
    {
        return 'Get details of a specific image generation from Abyssale, including its status, output URLs, and applied modifications.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The generation UUID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Abyssale integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The generation ID is required.');
            }

            $result = $this->service->getGeneration($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
