<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new custom tag for organizing accounts and campaigns.
 */
class InstantlyCreateCustomTag implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_custom_tag';
    }

    public function description(): string
    {
        return 'Create a new custom tag for organizing accounts and campaigns.';
    }

    public function parameters(): array
    {
        return [
            'label' => ['type' => 'string', 'required' => true, 'description' => 'Tag label'],
            'description' => ['type' => 'string', 'required' => false, 'description' => 'Tag description'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = ['label' => $args['label']]; if (isset($args['description'])) $body['description'] = $args['description']; $result = $this->service->createCustomTag($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
