<?php

namespace OpenCompany\Integrations\Pinboard\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinboard\PinboardService;

/**
 * Shared executor for Pinboard operation tools.
 *
 * Concrete tools only declare the operation key while this class exposes
 * metadata, merges payload fields, and delegates to PinboardService.
 */
abstract class AbstractPinboardTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  PinboardService  $service  Pinboard API client.
     */
    public function __construct(protected PinboardService $service) {}

    public function name(): string { return 'pinboard_'.static::OPERATION; }

    public function description(): string { return (string) $this->definition()[5]; }

    public function parameters(): array
    {
        $parameters = [];
        foreach ($this->definition()[2] as $field) {
            $parameters[(string) $field] = ['type' => 'string', 'required' => true, 'description' => str_replace('_', ' ', ucfirst((string) $field)).'.'];
        }

        $parameters['payload'] = ['type' => 'object', 'description' => 'Additional Pinboard query fields.'];

        return $parameters;
    }

    /**
     * Execute the Pinboard operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinboard integration is not configured.');
            }

            return ToolResult::success($this->service->call(static::OPERATION, $this->payload($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build query data from explicit payload plus top-level fields.
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
     * Return operation metadata.
     *
     * @return array<int, mixed>
     */
    private function definition(): array
    {
        $definition = PinboardService::operations()[static::OPERATION] ?? null;
        if ($definition === null) {
            throw new \RuntimeException('Unknown Pinboard operation: '.static::OPERATION);
        }

        return $definition;
    }
}
