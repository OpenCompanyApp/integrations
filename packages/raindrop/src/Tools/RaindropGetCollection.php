<?php

namespace OpenCompany\Integrations\Raindrop\Tools;

use OpenCompany\Integrations\Raindrop\RaindropService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RaindropGetCollection implements Tool
{
    public function __construct(
        private RaindropService $service,
    ) {}

    public function name(): string
    {
        return 'raindrop_get_collection';
    }

    public function description(): string
    {
        return 'Get details of a specific collection by ID, including its name, color, icon, and bookmark count.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The collection ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Raindrop.io integration is not configured.');
            }

            $result = $this->service->getCollection((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
