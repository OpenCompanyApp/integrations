<?php

namespace OpenCompany\Integrations\FirstEpss\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\FirstEpss\FirstEpssService;

/**
 * Shared executor for FIRST EPSS tools.
 *
 * Child classes provide tool metadata while this base class validates required
 * arguments, dispatches service calls, and converts exceptions to tool errors.
 */
abstract class AbstractFirstEpssTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  FirstEpssService  $service  FIRST EPSS API client.
     */
    public function __construct(protected FirstEpssService $service) {}

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
     * Execute the FIRST EPSS operation.
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
            'query' => $this->service->query($args),
            'cve' => $this->service->cve((string) $args['cve'], isset($args['date']) ? (string) $args['date'] : null),
            'batch' => $this->service->batch($args['cves'], isset($args['date']) ? (string) $args['date'] : null),
            'timeSeries' => $this->service->timeSeries((string) $args['cve'], isset($args['date']) ? (string) $args['date'] : null),
            'top' => $this->service->top((int) ($args['limit'] ?? 100), (string) ($args['by'] ?? 'epss'), isset($args['date']) ? (string) $args['date'] : null),
            'threshold' => $this->service->threshold($args),
            'historicalCsvUrl' => $this->service->historicalCsvUrl((string) $args['date']),
            default => throw new InvalidArgumentException('Unsupported FIRST EPSS operation.'),
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
