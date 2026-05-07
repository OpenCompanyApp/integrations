<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\PostHog\PostHogOperations;
use OpenCompany\Integrations\PostHog\PostHogService;

/**
 * Base class for generated PostHog OpenAPI operation tools.
 *
 * Handles parameter declarations, configured-state checks, and execution
 * through the shared PostHog API client.
 */
abstract class AbstractPostHogOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /** @param  PostHogService  $service  PostHog HTTP API client. */
    public function __construct(protected PostHogService $service) {}
    public function name(): string { return static::TOOL_NAME; }
    public function description(): string { return (string) ($this->operation()['description'] ?? $this->operation()['name'] ?? static::TOOL_NAME); }
    public function parameters(): array { $parameters = []; foreach ($this->operation()['parameters'] ?? [] as $parameter) { $key = $parameter['argument_name'] ?? $parameter['name']; $definition = ['type' => $parameter['schema_type'] ?? 'string', 'required' => (bool) ($parameter['required'] ?? false), 'description' => $parameter['description'] ?: ucfirst(str_replace('_', ' ', (string) $key))]; if (!empty($parameter['enum'])) $definition['enum'] = $parameter['enum']; if (!empty($parameter['items'])) $definition['items'] = $parameter['items']; if (!empty($parameter['aliases'])) $definition['aliases'] = $parameter['aliases']; $parameters[$key] = $definition; } if (($this->operation()['request_body'] ?? null) !== null) $parameters['body'] = ['type' => $this->operation()['request_body']['schema_type'] ?? 'object', 'required' => (bool) ($this->operation()['request_body']['required'] ?? false), 'description' => $this->operation()['request_body']['description'] ?: 'Request body for the PostHog API operation.']; return $parameters; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { try { if (!$this->service->isConfigured()) return ToolResult::error('PostHog integration is not configured.'); return ToolResult::success($this->service->executeOperation($this->operation(), $args)); } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); } }
    /** @return array<string, mixed> */
    protected function operation(): array { $operations = PostHogOperations::all(); return $operations[static::TOOL_NAME] ?? []; }
}
