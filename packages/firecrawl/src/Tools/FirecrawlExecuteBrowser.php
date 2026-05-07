<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Execute code or a prompt inside a Firecrawl browser session.
 */
class FirecrawlExecuteBrowser implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_execute_browser';
    }

    public function description(): string
    {
        return 'Execute browser automation code or an AI prompt in a Firecrawl browser session.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'Browser session ID.'],
            'code' => ['type' => 'string', 'description' => 'Browser automation code to execute.'],
            'prompt' => ['type' => 'string', 'description' => 'Natural-language browser task prompt.'],
        ];
    }

    /**
     * Execute in a browser session.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            $sessionId = (string) ($args['session_id'] ?? '');
            unset($args['session_id']);

            return ToolResult::success($this->service->executeBrowser($sessionId, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
