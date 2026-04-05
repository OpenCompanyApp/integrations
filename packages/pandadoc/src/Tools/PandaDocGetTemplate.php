<?php

namespace OpenCompany\Integrations\PandaDoc\Tools;

use OpenCompany\Integrations\PandaDoc\PandaDocService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PandaDocGetTemplate implements Tool
{
    public function __construct(
        private PandaDocService $service,
    ) {}

    public function name(): string
    {
        return 'pandadoc_get_template';
    }

    public function description(): string
    {
        return 'Get details of a specific PandaDoc template by ID. Returns template metadata, fields, tokens, and recipient roles.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The template UUID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PandaDoc integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Template ID is required.');
            }

            $result = $this->service->getTemplate($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
