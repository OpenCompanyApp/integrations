<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Test AI reply label prediction. Returns predicted label for a given reply text.
 */
class InstantlyTestAiLabel implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_test_ai_label';
    }

    public function description(): string
    {
        return 'Test AI reply label prediction. Returns predicted label for a given reply text.';
    }

    public function parameters(): array
    {
        return [
            'reply_text' => ['type' => 'string', 'required' => true, 'description' => 'Reply text to classify'],
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

            $result = $this->service->testAiLabel($args['reply_text']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
