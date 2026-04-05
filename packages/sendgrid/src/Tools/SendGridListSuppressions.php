<?php

namespace OpenCompany\Integrations\SendGrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SendGrid\SendGridService;

/**
 * List bounce suppressions from SendGrid.
 */
class SendGridListSuppressions implements Tool
{
    /** @param SendGridService $service The SendGrid API client */
    public function __construct(
        private SendGridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_list_suppressions';
    }

    public function description(): string
    {
        return <<<'MD'
        List bounce suppressions (bounced email addresses) from SendGrid.
        Optionally filter by start and end time (Unix timestamps) and limit results.
        MD;
    }

    public function parameters(): array
    {
        return [
            'start_time' => [
                'type' => 'integer',
                'description' => 'Start time as a Unix timestamp.',
            ],
            'end_time' => [
                'type' => 'integer',
                'description' => 'End time as a Unix timestamp.',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of suppressions to return.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $result = $this->service->listSuppressions(
                startTime: $args['start_time'] ?? null,
                endTime: $args['end_time'] ?? null,
                limit: $args['limit'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
