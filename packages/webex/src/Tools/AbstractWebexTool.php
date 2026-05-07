<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Webex\WebexService;

/**
 * Shared helpers for Webex tools.
 *
 * Keeps configured-service checks and argument extraction consistent.
 */
abstract class AbstractWebexTool
{
    /**
     * @param  WebexService  $service  Webex REST API client.
     */
    public function __construct(
        protected WebexService $service,
    ) {}

    /**
     * Ensure the integration has an access token.
     */
    protected function requireConfigured(): ?ToolResult
    {
        return $this->service->isConfigured()
            ? null
            : ToolResult::error('Webex integration is not configured.');
    }

    /**
     * Return only allowed non-empty arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $keys  Keys to include.
     * @return array<string, mixed>
     */
    protected function only(array $args, array $keys): array
    {
        $params = [];
        foreach ($keys as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $params[$key] = $args[$key];
            }
        }

        return $params;
    }
}
