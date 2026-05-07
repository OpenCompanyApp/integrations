<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\DepsDev\DepsDevService;

/**
 * Shared executor for deps.dev tools.
 *
 * Child classes provide metadata while this base class validates required
 * arguments, dispatches service calls, and converts exceptions to tool errors.
 */
abstract class AbstractDepsDevTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  DepsDevService  $service  deps.dev API client.
     */
    public function __construct(protected DepsDevService $service) {}

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
     * Execute the deps.dev operation.
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
            'package' => $this->service->package((string) $args['system'], (string) $args['name']),
            'version' => $this->service->version((string) $args['system'], (string) $args['name'], (string) $args['version']),
            'requirements' => $this->service->requirements((string) $args['system'], (string) $args['name'], (string) $args['version']),
            'dependencies' => $this->service->dependencies((string) $args['system'], (string) $args['name'], (string) $args['version']),
            'project' => $this->service->project((string) $args['id']),
            'projectPackageVersions' => $this->service->projectPackageVersions((string) $args['id']),
            'advisory' => $this->service->advisory((string) $args['id']),
            'query' => $this->service->query($args),
            default => throw new InvalidArgumentException('Unsupported deps.dev operation.'),
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
