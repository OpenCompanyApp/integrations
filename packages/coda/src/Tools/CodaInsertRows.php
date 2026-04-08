<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to insert new rows into a Coda table.
 *
 * Accepts an array of row objects, each containing a cells array with
 * column/value pairs. Returns a request ID for tracking the async operation.
 */
class CodaInsertRows implements Tool
{
    /**
     * Create a new CodaInsertRows tool instance.
     *
     * @param  CodaService  $service  The Coda API service.
     */
    public function __construct(
        private CodaService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'coda_insert_rows';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Insert one or more new rows into a Coda table. Each row should have a "cells" array with column/value pairs.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the doc.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or name of the table.'],
            'rows' => ['type' => 'array', 'required' => true, 'description' => 'Array of row objects. Each row should be {"cells": [{"column": "col-name-or-id", "value": "the-value"}]}.'],
        ];
    }

    /**
     * Execute the tool: insert rows via the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing the request ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Coda integration is not configured.');
            }

            if (empty($args['rows'])) {
                return ToolResult::error('At least one row is required.');
            }

            $result = $this->service->insertRows($args['doc_id'], $args['table_id'], $args['rows']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
