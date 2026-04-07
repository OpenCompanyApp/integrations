<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an email (e.g., assign to a team member, update label).
 */
class InstantlyUpdateEmail implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_email';
    }

    public function description(): string
    {
        return 'Update an email (e.g., assign to a team member, update label).';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Email ID'],
            'assigned_to' => ['type' => 'string', 'required' => false, 'description' => 'User ID to assign'],
            'label' => ['type' => 'integer', 'required' => false, 'description' => 'Label value'],
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

            $result = $body = []; foreach (['assigned_to','label'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $this->service->updateEmail($args['id'], $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
