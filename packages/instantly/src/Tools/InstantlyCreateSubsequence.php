<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new subsequence for a campaign.
 */
class InstantlyCreateSubsequence implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_subsequence';
    }

    public function description(): string
    {
        return 'Create a new subsequence for a campaign.';
    }

    public function parameters(): array
    {
        return [
            'parent_campaign' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Subsequence name'],
            'conditions' => ['type' => 'string', 'required' => true, 'description' => 'JSON trigger conditions'],
            'subsequence_schedule' => ['type' => 'string', 'required' => true, 'description' => 'JSON schedule config'],
            'sequences' => ['type' => 'string', 'required' => true, 'description' => 'JSON sequences array'],
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

            $result = $body = ['parent_campaign' => $args['parent_campaign'], 'name' => $args['name'], 'conditions' => is_string($args['conditions']) ? json_decode($args['conditions'], true) : $args['conditions'], 'subsequence_schedule' => is_string($args['subsequence_schedule']) ? json_decode($args['subsequence_schedule'], true) : $args['subsequence_schedule'], 'sequences' => is_string($args['sequences']) ? json_decode($args['sequences'], true) : $args['sequences']]; $this->service->createSubsequence($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
