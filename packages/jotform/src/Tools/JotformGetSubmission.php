<?php

namespace OpenCompany\Integrations\Jotform\Tools;

use OpenCompany\Integrations\Jotform\JotformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class JotformGetSubmission implements Tool
{
    public function __construct(
        private JotformService $service,
    ) {}

    public function name(): string
    {
        return 'jotform_get_submission';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Jotform submission, including all form answers, metadata, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'submission_id' => ['type' => 'string', 'required' => true, 'description' => 'The submission ID (e.g., "512345678901234567").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jotform integration is not configured.');
            }

            $result = $this->service->getSubmission($args['submission_id']);
            $content = $result['content'] ?? $result;

            return ToolResult::success($content);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
