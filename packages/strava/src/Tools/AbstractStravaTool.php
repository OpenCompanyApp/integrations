<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Strava\StravaService;

/**
 * Shared helpers for Strava tools.
 *
 * Keeps configured-service checks and argument normalization consistent.
 */
abstract class AbstractStravaTool
{
    /**
     * @param  StravaService  $service  Strava API client.
     */
    public function __construct(
        protected StravaService $service,
    ) {}

    /**
     * Ensure the integration has an access token.
     */
    protected function requireConfigured(): ?ToolResult
    {
        return $this->service->isConfigured()
            ? null
            : ToolResult::error('Strava integration is not configured.');
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
}
