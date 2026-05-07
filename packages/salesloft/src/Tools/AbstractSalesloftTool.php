<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Salesloft\SalesloftService;

/**
 * Shared helpers for Salesloft tools.
 *
 * Keeps configured-service checks and argument shaping consistent.
 */
abstract class AbstractSalesloftTool
{
    /**
     * @param  SalesloftService  $service  Salesloft API client.
     */
    public function __construct(
        protected SalesloftService $service,
    ) {}

    /**
     * Ensure the integration has an access token.
     */
    protected function requireConfigured(): ?ToolResult
    {
        return $this->service->isConfigured()
            ? null
            : ToolResult::error('Salesloft integration is not configured.');
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
     * Read and validate a payload argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>|null
     */
    protected function payload(array $args): ?array
    {
        return is_array($args['payload'] ?? null) && $args['payload'] !== []
            ? $args['payload']
            : null;
    }
}
