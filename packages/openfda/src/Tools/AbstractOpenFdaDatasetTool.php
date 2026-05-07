<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenFda\OpenFdaService;

/**
 * Shared executor for one openFDA dataset endpoint.
 *
 * Every child maps to one official dataset path and exposes openFDA's shared
 * search, count, sort, limit, skip, and api_key query contract.
 */
abstract class AbstractOpenFdaDatasetTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const ENDPOINT = '';

    /**
     * @param  OpenFdaService  $service  openFDA API client.
     */
    public function __construct(protected OpenFdaService $service) {}

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
        return [
            'search' => ['type' => 'string', 'required' => false, 'description' => 'openFDA search expression, e.g. openfda.generic_name:acetaminophen.'],
            'count' => ['type' => 'string', 'required' => false, 'description' => 'Field to aggregate counts by, often with .exact for full phrases.'],
            'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort expression such as receivedate:desc.'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum records or count buckets to return.'],
            'skip' => ['type' => 'integer', 'required' => false, 'description' => 'Number of records or buckets to skip.'],
            'api_key' => ['type' => 'string', 'required' => false, 'description' => 'Optional openFDA API key for higher daily rate limits.'],
            'extra' => ['type' => 'object', 'required' => false, 'description' => 'Additional official openFDA query parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the dataset query with shared exception handling.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $extra = isset($args['extra']) && is_array($args['extra']) ? $args['extra'] : [];
            unset($args['extra']);

            return ToolResult::success($this->service->query(static::ENDPOINT, array_merge($extra, $args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
