<?php

namespace OpenCompany\Integrations\MicrosoftPlanner\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MicrosoftPlanner\MicrosoftPlannerService;

/**
 * Shared executor for generated Microsoft Planner tools.
 *
 * Handles configured-state checks, path/query/header mapping, body validation,
 * dispatch, and error conversion for endpoint-specific operations.
 */
abstract class AbstractMicrosoftPlannerTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;

    /**
     * @param  MicrosoftPlannerService  $service  Microsoft Planner API client.
     */
    public function __construct(protected MicrosoftPlannerService $service) {}

    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped Microsoft Planner operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) { return ToolResult::error('Microsoft Planner access token is required.'); }

            return ToolResult::success($this->service->request(
                static::METHOD,
                static::PATH,
                $this->mapped($args, static::PATH_PARAMS, true),
                $this->mapped($args, static::QUERY_PARAMS),
                $this->headers($args),
                $this->body($args),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<string, string>  $map  Official parameter name to tool key map.
     * @return array<string, mixed>
     */
    private function mapped(array $args, array $map, bool $required = false): array
    {
        $out = [];
        foreach ($map as $official => $key) {
            if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
                if ($required) { throw new InvalidArgumentException($key . ' must be a non-empty parameter.'); }
                continue;
            }
            $out[$official] = $args[$key];
        }

        return $out;
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, string>
     */
    private function headers(array $args): array
    {
        $headers = [];
        if (isset($args['if_match']) && $args['if_match'] !== '') { $headers['If-Match'] = (string) $args['if_match']; }
        if (isset($args['prefer']) && $args['prefer'] !== '') { $headers['Prefer'] = (string) $args['prefer']; }

        return $headers;
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        $body = $args['body'] ?? [];
        if ($body !== [] && !is_array($body)) { throw new InvalidArgumentException('body must be an object.'); }
        if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) { throw new InvalidArgumentException('body must be a non-empty object matching the Microsoft Planner request schema.'); }

        return $body;
    }
}
