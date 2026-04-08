<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Coda docs accessible to the authenticated user.
 *
 * Supports filtering by query, owner status, and pagination via limit.
 */
class CodaListDocs implements Tool
{
    /**
     * Create a new CodaListDocs tool instance.
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
        return 'coda_list_docs';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List Coda docs accessible to the authenticated user. Optionally filter by name or ownership.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query to filter docs by name.'],
            'isOwner' => ['type' => 'boolean', 'description' => 'If true, only return docs owned by the user.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of docs to return (default: 20, max: 100).'],
        ];
    }

    /**
     * Execute the tool: list docs from the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing the list of docs.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Coda integration is not configured.');
            }

            $params = [];
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }
            if (isset($args['isOwner'])) {
                $params['isOwner'] = $args['isOwner'] ? 'true' : 'false';
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listDocs($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
