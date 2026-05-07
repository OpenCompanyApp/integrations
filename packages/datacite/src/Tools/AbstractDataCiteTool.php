<?php

namespace OpenCompany\Integrations\DataCite\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\DataCite\DataCiteService;

/**
 * Shared executor for endpoint-specific DataCite REST tools.
 *
 * Child classes define path templates and required identifiers while this class
 * expands path parameters and sends JSON:API query options.
 */
abstract class AbstractDataCiteTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const REQUIRED = [];

    /**
     * @param  DataCiteService  $service  DataCite API client.
     */
    public function __construct(protected DataCiteService $service) {}

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
        return static::PARAMETERS + [
            'query' => ['type' => 'string', 'required' => false, 'description' => 'Search query where supported.'],
            'page[number]' => ['type' => 'integer', 'required' => false, 'description' => 'JSON:API page number.'],
            'page[size]' => ['type' => 'integer', 'required' => false, 'description' => 'JSON:API page size.'],
            'page[cursor]' => ['type' => 'string', 'required' => false, 'description' => 'Cursor for cursor-based pagination.'],
            'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort expression where supported.'],
            'include' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Relationships to include where supported.', 'items' => ['type' => 'string']],
            'fields[dois]' => ['type' => 'string', 'required' => false, 'description' => 'Sparse fieldset for DOI responses.'],
            'extra' => ['type' => 'object', 'required' => false, 'description' => 'Additional official DataCite query parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the DataCite REST endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            $path = static::PATH;
            foreach (static::PATH_PARAMS as $key) {
                $this->requireValue($args, $key);
                $path = str_replace('{'.$key.'}', rawurlencode((string) $args[$key]), $path);
                unset($args[$key]);
            }

            $query = isset($args['extra']) && is_array($args['extra']) ? $args['extra'] : [];
            unset($args['extra']);

            return ToolResult::success($this->service->get($path, array_merge($query, $args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
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
