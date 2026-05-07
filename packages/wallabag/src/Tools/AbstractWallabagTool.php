<?php

namespace OpenCompany\Integrations\Wallabag\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Wallabag\WallabagService;

/**
 * Shared executor for wallabag operation tools.
 *
 * Concrete tools declare the operation key while this class exposes metadata,
 * merges payload fields, and delegates API calls to WallabagService.
 */
abstract class AbstractWallabagTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  WallabagService  $service  wallabag API client.
     */
    public function __construct(protected WallabagService $service) {}

    public function name(): string { return 'wallabag_'.static::OPERATION; }

    public function description(): string { return (string) $this->definition()[6]; }

    public function parameters(): array
    {
        $parameters = [];
        foreach ($this->definition()[3] as $field) {
            $parameters[(string) $field] = ['type' => 'string', 'required' => true, 'description' => str_replace('_', ' ', ucfirst((string) $field)).'.'];
        }

        $parameters['payload'] = ['type' => 'object', 'description' => 'Additional query, form, or JSON body fields.'];

        return $parameters;
    }

    /**
     * Execute the wallabag operation.
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
        $definition = WallabagService::operations()[static::OPERATION] ?? null;
        if ($definition === null) {
            throw new \RuntimeException('Unknown wallabag operation: '.static::OPERATION);
        }

        return $definition;
    }
}
