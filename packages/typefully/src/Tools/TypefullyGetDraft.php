<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\Integrations\Typefully\TypefullyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypefullyGetDraft implements Tool
{
    public function __construct(
        private TypefullyService $service,
    ) {}

    public function name(): string
    {
        return 'typefully_get_draft';
    }

    public function description(): string
    {
        return 'Get details of a specific Typefully draft by its ID. Returns full content, scheduling info, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Typefully draft ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $result = $this->service->getDraft($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
