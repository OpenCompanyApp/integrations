<?php

namespace OpenCompany\Integrations\CisaKev\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\CisaKev\CisaKevService;

/**
 * Shared executor for CISA KEV tools.
 *
 * Child classes provide metadata while this base class validates required
 * arguments, dispatches service calls, and returns normalized tool results.
 */
abstract class AbstractCisaKevTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  CisaKevService  $service  CISA KEV feed client.
     */
    public function __construct(protected CisaKevService $service) {}

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
     * Execute the CISA KEV operation.
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
     * @return array<string, mixed>
     */
    private function dispatch(array $args): array
    {
        return match (static::METHOD) {
            'catalog' => $this->service->catalog(),
            'search' => $this->service->search($args),
            'vulnerability' => $this->service->vulnerability((string) $args['cve_id']),
            'recent' => $this->service->recent($args),
            'schema' => $this->service->schema(),
            'csv' => $this->service->csv(),
            'license' => $this->service->license(),
            default => throw new InvalidArgumentException('Unsupported CISA KEV operation.'),
        };
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
