<?php

namespace OpenCompany\Integrations\OpenFigi\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenFigi\OpenFigiService;

/**
 * Shared executor for OpenFIGI tools.
 *
 * Child classes define the operation and parameter schema while this class
 * validates required arguments and converts exceptions to tool results.
 */
abstract class AbstractOpenFigiTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  OpenFigiService  $service  OpenFIGI API client.
     */
    public function __construct(protected OpenFigiService $service) {}

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
     * Execute the OpenFIGI operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            return ToolResult::success($this->dispatch($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch to the mapped service method.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>|list<mixed>
     */
    private function dispatch(array $args): array
    {
        return match (static::METHOD) {
            'mapping' => $this->service->mapping($args['jobs']),
            'mappingValues' => $this->service->mappingValues((string) $args['key']),
            'search' => $this->service->search($this->payload($args)),
            'filter' => $this->service->filter($this->payload($args)),
            'schema' => $this->service->schema(),
            default => throw new InvalidArgumentException('Unsupported OpenFIGI operation.'),
        };
    }

    /**
     * Build a POST payload from explicit payload plus top-level arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function payload(array $args): array
    {
        $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];
        unset($args['payload']);

        return array_merge($payload, $args);
    }

    /**
     * Ensure a required argument is present and non-empty.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? null;
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}
