<?php

namespace OpenCompany\Integrations\Airtop\Tools;

use OpenCompany\Integrations\Airtop\AirtopService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AirtopNavigate implements Tool
{
    public function __construct(
        private AirtopService $service,
    ) {}

    public function name(): string
    {
        return 'airtop_navigate';
    }

    public function description(): string
    {
        return 'Navigate a browser window to a specified URL in an Airtop session. Waits for the page to load before returning.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The session ID.'],
            'window_id' => ['type' => 'string', 'required' => true, 'description' => 'The window ID to navigate.'],
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The URL to navigate to (e.g., "https://example.com").'],
            'wait_until' => ['type' => 'string', 'description' => 'When to consider navigation complete: "load", "domcontentloaded", or "networkidle". Default is "load".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Airtop integration is not configured.');
            }

            $options = [];
            if (isset($args['wait_until'])) {
                $options['waitUntil'] = $args['wait_until'];
            }

            $result = $this->service->navigate($args['session_id'], $args['window_id'], $args['url'], $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
