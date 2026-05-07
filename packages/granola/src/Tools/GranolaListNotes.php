<?php

namespace OpenCompany\Integrations\Granola\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Granola\GranolaService;

/**
 * List accessible Granola meeting notes.
 *
 * Supports the official pagination and date filters from the Granola
 * Enterprise API.
 */
class GranolaListNotes implements Tool
{
    /**
     * @param  GranolaService  $service  The Granola API client.
     */
    public function __construct(
        private GranolaService $service,
    ) {}

    public function name(): string
    {
        return 'granola_list_notes';
    }

    public function description(): string
    {
        return 'List accessible Granola meeting notes with cursor pagination and date filters.';
    }

    public function parameters(): array
    {
        return [
            'created_before' => ['type' => 'string', 'description' => 'Return notes created before this date, such as 2026-01-27.'],
            'created_after' => ['type' => 'string', 'description' => 'Return notes created after this date, such as 2026-01-27.'],
            'updated_after' => ['type' => 'string', 'description' => 'Return notes updated after this date, such as 2026-01-27.'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a previous response.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of notes to return, from 1 to 30.'],
        ];
    }

    /**
     * List notes.
     *
     * @param  array<string, mixed>  $args  Optional date and pagination arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Granola integration is not configured.');
            }

            return ToolResult::success($this->service->listNotes($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
