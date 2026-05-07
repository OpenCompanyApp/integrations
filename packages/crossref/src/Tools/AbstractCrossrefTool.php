<?php

namespace OpenCompany\Integrations\Crossref\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Crossref\CrossrefService;

/**
 * Shared executor for endpoint-specific Crossref tools.
 *
 * Child classes define path templates and required identifiers while this class
 * validates arguments, expands path parameters, and sends query options.
 */
abstract class AbstractCrossrefTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const REQUIRED = [];

    /**
     * @param  CrossrefService  $service  Crossref API client.
     */
    public function __construct(protected CrossrefService $service) {}

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
            'rows' => ['type' => 'integer', 'required' => false, 'description' => 'Number of rows for list endpoints.'],
            'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Offset for list endpoints.'],
            'cursor' => ['type' => 'string', 'required' => false, 'description' => 'Cursor for deep paging.'],
            'mailto' => ['type' => 'string', 'required' => false, 'description' => 'Email address for Crossref polite pool usage.'],
            'filter' => ['type' => ['string', 'object'], 'required' => false, 'description' => 'Crossref filter string or object converted to filter:value comma syntax.'],
            'select' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to select where supported.', 'items' => ['type' => 'string']],
            'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort field where supported.'],
            'order' => ['type' => 'string', 'required' => false, 'description' => 'Sort order asc or desc.', 'enum' => ['asc', 'desc']],
            'facet' => ['type' => 'string', 'required' => false, 'description' => 'Facet expression where supported.'],
            'sample' => ['type' => 'integer', 'required' => false, 'description' => 'Random sample size where supported.'],
            'extra' => ['type' => 'object', 'required' => false, 'description' => 'Additional official Crossref query parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the Crossref endpoint.
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
