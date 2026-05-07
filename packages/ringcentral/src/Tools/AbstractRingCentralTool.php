<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RingCentral\RingCentralService;

/**
 * Shared helpers for RingCentral tools.
 *
 * Keeps required-argument validation and configured-service checks consistent.
 */
abstract class AbstractRingCentralTool
{
    /**
     * @param  RingCentralService  $service  RingCentral API client.
     */
    public function __construct(
        protected RingCentralService $service,
    ) {}

    /**
     * Ensure the integration has an access token.
     */
    protected function requireConfigured(): ?ToolResult
    {
        return $this->service->isConfigured()
            ? null
            : ToolResult::error('RingCentral integration is not configured.');
    }

    /**
     * Return only the allowed keys present in the argument array.
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
