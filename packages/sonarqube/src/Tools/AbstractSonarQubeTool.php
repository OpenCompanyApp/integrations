<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SonarQube\SonarQubeService;

/**
 * Shared executor for SonarQube endpoint-specific tools.
 *
 * Child classes map one official Web API action while this base handles
 * configured-state checks, parameter mapping, and error wrapping.
 */
abstract class AbstractSonarQubeTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PARAM_MAP = [];

    /**
     * @param  SonarQubeService  $service  SonarQube API client.
     */
    public function __construct(protected SonarQubeService $service) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the mapped SonarQube Web API action.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SonarQube integration is not configured.');
            }

            return ToolResult::success($this->service->request(static::METHOD, static::PATH, $this->mapped($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Convert snake_case tool arguments back to official SonarQube parameter names.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function mapped(array $args): array
    {
        $out = [];
        foreach (static::PARAM_MAP as $official => $key) {
            $required = (bool) (static::PARAMETERS[$key]['required'] ?? false);
            if (! array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
                if ($required) {
                    throw new InvalidArgumentException($key.' must be a non-empty parameter.');
                }
                continue;
            }
            $out[$official] = $args[$key];
        }

        return $out;
    }
}
