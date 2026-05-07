<?php

namespace OpenCompany\Integrations\Osv\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Osv\OsvService;

/**
 * Shared executor for OSV tools.
 *
 * Child classes provide tool metadata while this base class validates required
 * arguments, dispatches to the OSV service, and converts exceptions to errors.
 */
abstract class AbstractOsvTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  OsvService  $service  OSV API client.
     */
    public function __construct(protected OsvService $service) {}

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
     * Execute the OSV operation.
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
            'queryBatch' => $this->service->queryBatch($args['queries']),
            'vulnerability' => $this->service->vulnerability((string) $args['id']),
            'importFindings' => $this->service->importFindings((string) $args['source']),
            'determineVersion' => $this->service->determineVersion($args),
            default => throw new InvalidArgumentException('Unsupported OSV operation.'),
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
