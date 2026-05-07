<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Phantombuster\PhantombusterService;

/**
 * Shared helpers for Phantombuster tools.
 *
 * Keeps configured-service checks and argument normalization consistent.
 */
abstract class AbstractPhantombusterTool
{
    /**
     * @param  PhantombusterService  $service  Phantombuster API client.
     */
    public function __construct(
        protected PhantombusterService $service,
    ) {}

    /**
     * Ensure the integration has an API key.
     */
    protected function requireConfigured(): ?ToolResult
    {
        return $this->service->isConfigured()
            ? null
            : ToolResult::error('Phantombuster integration is not configured.');
    }

    /**
     * Return only allowed non-empty arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int|string, string>  $map  Output keys or input-to-output key map.
     * @return array<string, mixed>
     */
    protected function only(array $args, array $map): array
    {
        $params = [];
        foreach ($map as $input => $output) {
            if (is_int($input)) {
                $input = $output;
            }

            if (array_key_exists($input, $args) && $args[$input] !== null && $args[$input] !== '') {
                $params[$output] = $args[$input];
            }
        }

        return $params;
    }

    /**
     * Merge a nested payload object with mapped first-class arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int|string, string>  $map  Output keys or input-to-output key map.
     * @return array<string, mixed>
     */
    protected function payload(array $args, array $map = []): array
    {
        $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];

        return array_merge($payload, $this->only($args, $map));
    }
}
