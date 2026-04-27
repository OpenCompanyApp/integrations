<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Assign or unassign tags to resources (accounts or campaigns).
 */
class InstantlyToggleCustomTags implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_toggle_custom_tags';
    }

    public function description(): string
    {
        return 'Assign or unassign tags to resources (accounts or campaigns).';
    }

    public function parameters(): array
    {
        return [
            'tag_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated tag IDs'],
            'resource_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated resource IDs'],
            'resource_type' => ['type' => 'integer', 'required' => true, 'description' => 'Resource type'],
            'assign' => ['type' => 'boolean', 'required' => true, 'description' => 'true=assign, false=unassign'],
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

            $body = ['tag_ids' => array_map('trim', explode(',', $args['tag_ids'])), 'resource_ids' => array_map('trim', explode(',', $args['resource_ids'])), 'resource_type' => (int)$args['resource_type'], 'assign' => $args['assign']]; $result = $this->service->toggleCustomTags($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
