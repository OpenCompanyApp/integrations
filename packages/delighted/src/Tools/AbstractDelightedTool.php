<?php

namespace OpenCompany\Integrations\Delighted\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Delighted\DelightedService;

/**
 * Shared executor for Delighted endpoint tools.
 *
 * Concrete tools define operation metadata while this class validates required
 * arguments, merges payload fields, and delegates API calls to DelightedService.
 */
abstract class AbstractDelightedTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const OPERATION = '';
    protected const REQUIRED = [];

    /**
     * @param  DelightedService  $service  Delighted API client.
     */
    public function __construct(protected DelightedService $service) {}

    public function name(): string { return static::NAME; }

    public function description(): string { return static::DESCRIPTION; }

    public function parameters(): array
    {
        $parameters = [];
        foreach (static::REQUIRED as $field) {
            $parameters[(string) $field] = ['type' => 'string', 'required' => true, 'description' => str_replace('_', ' ', ucfirst((string) $field)).'.'];
        }

        $parameters['payload'] = ['type' => 'object', 'description' => 'Additional query or JSON body fields for the endpoint.'];

        return $parameters;
    }

    /**
     * Execute the Delighted operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Delighted integration is not configured.');
            }

            foreach (static::REQUIRED as $field) {
                $this->requireValue($args, (string) $field);
            }

            return ToolResult::success($this->service->call(static::OPERATION, $this->payload($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build endpoint data from explicit payload plus top-level fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function payload(array $args): array
    {
        $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];
        foreach ($args as $key => $value) {
            if ($key !== 'payload') {
                $payload[$key] = $value;
            }
        }

        return $payload;
    }

    /**
     * Ensure a required value is present.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? ($args['payload'][$key] ?? null);
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}
