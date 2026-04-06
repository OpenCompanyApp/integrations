<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontGetConversation implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_get_conversation';
    }

    public function description(): string
    {
        return 'Get details of a specific Front conversation by ID, including subject, participants, status, tags, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation ID (e.g., "cnv_123abc").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $result = $this->service->getConversation($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
