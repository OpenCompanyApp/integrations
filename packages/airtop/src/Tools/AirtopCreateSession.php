<?php

namespace OpenCompany\Integrations\Airtop\Tools;

use OpenCompany\Integrations\Airtop\AirtopService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AirtopCreateSession implements Tool
{
    public function __construct(
        private AirtopService $service,
    ) {}

    public function name(): string
    {
        return 'airtop_create_session';
    }

    public function description(): string
    {
        return 'Create a new cloud browser session in Airtop. A session is a container for one or more browser windows. Returns the session ID needed to create windows and interact with pages.';
    }

    public function parameters(): array
    {
        return [
            'profile' => ['type' => 'string', 'description' => 'Optional browser profile name to use for the session. Profiles can persist cookies and state across sessions.'],
            'proxy' => ['type' => 'string', 'description' => 'Optional proxy configuration for the session (e.g., "http://user:pass@host:port").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Airtop integration is not configured.');
            }

            $options = [];
            if (isset($args['profile'])) {
                $options['profile'] = $args['profile'];
            }
            if (isset($args['proxy'])) {
                $options['proxy'] = $args['proxy'];
            }

            $result = $this->service->createSession($options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
