<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\EndOfLifeDate\EndOfLifeDateService;

/**
 * Shared executor for endoflife.date tools.
 *
 * Child classes provide tool metadata while this base class validates required
 * arguments, dispatches service calls, and converts failures to tool errors.
 */
abstract class AbstractEndOfLifeDateTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  EndOfLifeDateService  $service  endoflife.date API client.
     */
    public function __construct(protected EndOfLifeDateService $service) {}

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
     * Execute the endoflife.date operation.
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
            'index' => $this->service->index(),
            'products' => $this->service->products(),
            'productsFull' => $this->service->productsFull(),
            'product' => $this->service->product((string) $args['product']),
            'productRelease' => $this->service->productRelease((string) $args['product'], (string) $args['release']),
            'latestRelease' => $this->service->latestRelease((string) $args['product']),
            'categories' => $this->service->categories(),
            'categoryProducts' => $this->service->categoryProducts((string) $args['category']),
            'tags' => $this->service->tags(),
            'tagProducts' => $this->service->tagProducts((string) $args['tag']),
            'identifierTypes' => $this->service->identifierTypes(),
            'identifiers' => $this->service->identifiers((string) $args['identifier_type']),
            default => throw new InvalidArgumentException('Unsupported endoflife.date operation.'),
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
