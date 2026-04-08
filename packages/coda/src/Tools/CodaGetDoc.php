<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Coda doc.
 */
class CodaGetDoc implements Tool
{
    /**
     * Create a new CodaGetDoc tool instance.
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
        return 'coda_get_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Get details of a specific Coda doc by its ID.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the doc to retrieve.'],
        ];
    }

    /**
     * Execute the tool: get a doc from the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing the doc details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Coda integration is not configured.');
            }

            $result = $this->service->getDoc($args['doc_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
