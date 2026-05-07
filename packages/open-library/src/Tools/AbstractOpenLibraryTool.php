<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenLibrary\OpenLibraryService;

/**
 * Shared executor for Open Library tools.
 *
 * Child classes provide metadata while this base class validates required
 * arguments, dispatches service calls, and converts exceptions to tool errors.
 */
abstract class AbstractOpenLibraryTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  OpenLibraryService  $service  Open Library API client.
     */
    public function __construct(protected OpenLibraryService $service) {}

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
     * Execute the Open Library operation.
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
            'searchBooks' => $this->service->searchBooks($args),
            'searchAuthors' => $this->service->searchAuthors($args),
            'work' => $this->service->work((string) $args['id']),
            'workEditions' => $this->service->workEditions((string) $args['id'], $args),
            'workRatings' => $this->service->workRatings((string) $args['id']),
            'workBookshelves' => $this->service->workBookshelves((string) $args['id']),
            'edition' => $this->service->edition((string) $args['id']),
            'isbn' => $this->service->isbn((string) $args['isbn']),
            'books' => $this->service->books($args),
            'author' => $this->service->author((string) $args['id']),
            'authorWorks' => $this->service->authorWorks((string) $args['id'], $args),
            'subject' => $this->service->subject((string) $args['subject'], $args),
            'recentChanges' => $this->service->recentChanges($args),
            'coverUrl' => $this->service->coverUrl((string) $args['type'], (string) $args['value'], (string) ($args['size'] ?? 'M')),
            default => throw new InvalidArgumentException('Unsupported Open Library operation.'),
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
