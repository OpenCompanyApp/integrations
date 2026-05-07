<?php

namespace OpenCompany\Integrations\Helicone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Helicone\HeliconeService;

/**
 * Shared executor for Helicone endpoint-specific tools.
 *
 * Keeps configured-state checks, request body validation, ID validation, and
 * error conversion consistent while each child maps to one API operation.
 */
abstract class AbstractHeliconeTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const SERVICE_METHOD = '';
    protected const MODE = 'body';
    protected const ID_KEY = '';

    /**
     * @param  HeliconeService  $service  Helicone API client.
     */
    public function __construct(
        protected HeliconeService $service,
    ) {}

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
     * Execute the mapped Helicone API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Helicone integration is not configured.');
            }

            $method = static::SERVICE_METHOD;

            return ToolResult::success(match (static::MODE) {
                'none' => $this->service->{$method}(),
                'id' => $this->service->{$method}($this->requireString($args, static::ID_KEY)),
                'id_body' => $this->service->{$method}($this->requireString($args, static::ID_KEY), $this->body($args)),
                default => $this->service->{$method}($this->body($args)),
            });
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Extract a required request body object.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function body(array $args): array
    {
        $body = $args['body'] ?? null;

        if (!is_array($body) || $body === []) {
            throw new \InvalidArgumentException('body must be a non-empty object matching the Helicone API request schema.');
        }

        return $body;
    }

    /**
     * Ensure a required string argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requireString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;

        if (!is_string($value) || trim($value) === '') {
            throw new \InvalidArgumentException($key . ' must be a non-empty string.');
        }

        return $value;
    }
}
