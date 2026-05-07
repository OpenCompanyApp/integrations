<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vbout\VboutService;
use RuntimeException;

/**
 * Base tool for a documented VBOUT API operation.
 *
 * Concrete operation tools only declare the operation key; this class provides
 * the shared metadata, validation, and execution behavior.
 */
abstract class AbstractVboutOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  VboutService  $service  VBOUT API client.
     */
    public function __construct(
        private VboutService $service,
    ) {}

    public function name(): string
    {
        return (string) $this->definition()['slug'];
    }

    public function description(): string
    {
        return (string) $this->definition()['description'];
    }

    public function parameters(): array
    {
        $parameters = [];
        foreach ($this->definition()['parameters'] as $name => $parameter) {
            $parameters[$name] = [
                'type' => (string) ($parameter['type'] ?? 'string'),
                'required' => (bool) ($parameter['required'] ?? false),
                'description' => (string) ($parameter['description'] ?? ''),
            ];

            if (array_key_exists('default', $parameter)) {
                $parameters[$name]['default'] = $parameter['default'];
            }
        }

        return $parameters;
    }

    /**
     * Execute the documented VBOUT operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments keyed by normalized parameter name.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('VBOUT integration is not configured.');
            }

            return ToolResult::success($this->service->executeOperation(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return the operation definition for this tool.
     *
     * @return array<string, mixed>
     */
    private function definition(): array
    {
        $definition = VboutService::operations()[static::OPERATION] ?? null;
        if ($definition === null) {
            throw new RuntimeException('Unknown VBOUT operation: '.static::OPERATION);
        }

        return $definition;
    }
}