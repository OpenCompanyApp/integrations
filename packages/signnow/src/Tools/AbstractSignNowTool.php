<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SignNow\SignNowService;

/**
 * Shared helpers for SignNow tools.
 *
 * Keeps configured-service checks and argument shaping consistent.
 */
abstract class AbstractSignNowTool
{
    /**
     * @param  SignNowService  $service  SignNow API client.
     */
    public function __construct(
        protected SignNowService $service,
    ) {}

    /**
     * Ensure the integration has an access token.
     */
    protected function requireConfigured(): ?ToolResult
    {
        return $this->service->isConfigured()
            ? null
            : ToolResult::error('SignNow integration is not configured.');
    }

    /**
     * Merge a nested payload object with selected first-class arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int|string, string>  $map  Output keys or input-to-output key map.
     * @return array<string, mixed>
     */
    protected function payload(array $args, array $map = []): array
    {
        $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
        foreach ($map as $input => $output) {
            if (is_int($input)) {
                $input = $output;
            }

            if (array_key_exists($input, $args) && $args[$input] !== null && $args[$input] !== '') {
                $payload[$output] = $args[$input];
            }
        }

        return $payload;
    }
}
