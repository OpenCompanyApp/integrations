<?php

namespace OpenCompany\Integrations\Featurebase\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Featurebase\FeaturebaseService;

/**
 * Shared executor for generated Featurebase endpoint tools.
 *
 * Concrete tools define an operation id while this class validates path
 * arguments, merges payload fields, and delegates to FeaturebaseService.
 */
abstract class AbstractFeaturebaseTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const OPERATION = '';
    protected const PATH_PARAMS = [];

    /**
     * @param  FeaturebaseService  $service  Featurebase API client.
     */
    public function __construct(protected FeaturebaseService $service) {}

    public function name(): string { return static::NAME; }

    public function description(): string { return static::DESCRIPTION; }

    public function parameters(): array
    {
        $parameters = [];
        foreach (static::PATH_PARAMS as $field) {
            $parameters[$this->snake((string) $field)] = ['type' => 'string', 'required' => true, 'description' => str_replace('_', ' ', ucfirst($this->snake((string) $field))).'.'];
        }

        $parameters['payload'] = ['type' => 'object', 'description' => 'Additional query or JSON body fields using Featurebase API field names.'];

        return $parameters;
    }

    /**
     * Execute the Featurebase operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Featurebase integration is not configured.');
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

    private function snake(string $value): string
    {
        return strtolower((string) preg_replace('/(?<!^)[A-Z]/', '_$0', $value));
    }
}
