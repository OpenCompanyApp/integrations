<?php

namespace OpenCompany\Integrations\Outreach\Tools;

use OpenCompany\Integrations\Outreach\OutreachService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OutreachListSequences implements Tool
{
    /**
     * Create a new OutreachListSequences tool instance.
     *
     * @param OutreachService $service The Outreach API service.
     */
    public function __construct(
        private OutreachService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The tool name.
     */
    public function name(): string
    {
        return 'outreach_list_sequences';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List sales sequences in Outreach with optional pagination. Returns sequence details including name, status, and creation date.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name.
     */
    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of sequences to return per page (default: 25, max: 100).'],
            'page_number' => ['type' => 'integer', 'description' => 'Page number to retrieve (1-based).'],
        ];
    }

    /**
     * Execute the tool — list sequences from Outreach.
     *
     * @param  array $args The tool arguments (page_size, page_number).
     * @return ToolResult The result containing sequence data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Outreach integration is not configured.');
            }

            $params = [];

            if (isset($args['page_size'])) {
                $params['page']['size'] = (int) $args['page_size'];
            }

            if (isset($args['page_number'])) {
                $params['page']['number'] = (int) $args['page_number'];
            }

            $result = $this->service->listSequences($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
