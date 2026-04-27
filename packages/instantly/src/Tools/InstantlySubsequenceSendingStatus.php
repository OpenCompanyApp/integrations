<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the sending status of a subsequence.
 */
class InstantlySubsequenceSendingStatus implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_subsequence_sending_status';
    }

    public function description(): string
    {
        return 'Get the sending status of a subsequence.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Subsequence ID'],
            'with_ai_summary' => ['type' => 'boolean', 'required' => false, 'description' => 'Include AI summary'],
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

            $params = []; if (isset($args['with_ai_summary'])) $params['with_ai_summary'] = $args['with_ai_summary']; $result = $this->service->getSubsequenceSendingStatus($args['id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
