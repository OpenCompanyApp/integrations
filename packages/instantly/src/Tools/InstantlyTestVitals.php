<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Test account vitals (DNS, SMTP, IMAP connectivity).
 *
 * Accepts one or more account emails and returns Instantly's diagnostic results.
 */
class InstantlyTestVitals implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_test_vitals';
    }

    public function description(): string
    {
        return 'Test account vitals (DNS, SMTP, IMAP connectivity). Returns diagnostic results.';
    }

    public function parameters(): array
    {
        return [
            'accounts' => ['type' => 'array', 'required' => false, 'description' => 'Email accounts to test. If omitted, Instantly tests available accounts.', 'items' => ['type' => 'string']],
            'email' => ['type' => 'string', 'required' => false, 'description' => 'Deprecated single email shortcut. Prefer accounts.'],
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

            $accounts = $args['accounts'] ?? [];
            if (is_string($accounts)) {
                $accounts = array_filter(array_map('trim', explode(',', $accounts)));
            }
            if ($accounts === [] && isset($args['email'])) {
                $accounts = [(string) $args['email']];
            }

            $result = $this->service->testVitals($accounts);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
