<?php

namespace OpenCompany\Integrations\AbuseIpdb\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AbuseIpdb\AbuseIpdbService;

/**
 * Shared executor for AbuseIPDB tools.
 *
 * Child classes provide metadata while this base class validates required
 * arguments, dispatches service calls, and converts exceptions to tool errors.
 */
abstract class AbstractAbuseIpdbTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  AbuseIpdbService  $service  AbuseIPDB API client.
     */
    public function __construct(protected AbuseIpdbService $service) {}

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
     * Execute the AbuseIPDB operation.
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
            'check' => $this->service->check((string) $args['ip_address'], $args),
            'reports' => $this->service->reports((string) $args['ip_address'], $args),
            'blacklist' => $this->service->blacklist($args),
            'report' => $this->service->report((string) $args['ip_address'], (array) $args['categories'], (string) ($args['comment'] ?? ''), (string) ($args['timestamp'] ?? '')),
            'checkBlock' => $this->service->checkBlock((string) $args['network'], $args),
            'bulkReport' => $this->service->bulkReport((string) $args['csv']),
            'clearAddress' => $this->service->clearAddress((string) $args['ip_address']),
            default => throw new InvalidArgumentException('Unsupported AbuseIPDB operation.'),
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
