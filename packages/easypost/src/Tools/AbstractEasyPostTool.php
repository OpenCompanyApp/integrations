<?php

namespace OpenCompany\Integrations\EasyPost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\EasyPost\EasyPostService;

/**
 * Shared executor for documented EasyPost operation tools.
 *
 * Concrete tools declare an operation key while this class exposes metadata,
 * merges payload fields, and delegates all HTTP work to EasyPostService.
 */
abstract class AbstractEasyPostTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  EasyPostService  $service  EasyPost API client.
     */
    public function __construct(protected EasyPostService $service) {}

    public function name(): string { return 'easypost_'.static::OPERATION; }

    public function description(): string { return (string) $this->definition()[5]; }

    public function parameters(): array
    {
        $parameters = [];
        foreach ($this->definition()[2] as $field) {
            $parameters[(string) $field] = ['type' => 'string', 'required' => true, 'description' => str_replace('_', ' ', ucfirst((string) $field)).'.'];
        }

        $parameters['payload'] = ['type' => 'object', 'description' => 'Additional query or JSON body fields.'];

        return $parameters;
    }

    /**
     * Execute the EasyPost operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->call(static::OPERATION, $this->payload($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build operation data from explicit payload plus top-level fields.
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
        $definition = EasyPostService::operations()[static::OPERATION] ?? null;
        if ($definition === null) {
            throw new \RuntimeException('Unknown EasyPost operation: '.static::OPERATION);
        }

        return $definition;
    }
}
