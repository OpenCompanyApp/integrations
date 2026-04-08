<?php

namespace OpenCompany\Integrations\Outreach\Tools;

use OpenCompany\Integrations\Outreach\OutreachService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OutreachListProspects implements Tool
{
    /**
     * Create a new OutreachListProspects tool instance.
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
        return 'outreach_list_prospects';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List prospects in Outreach with optional filtering, sorting, and pagination. Returns prospect records including names, emails, and company info.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name.
     */
    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of prospects to return per page (default: 25, max: 100).'],
            'page_number' => ['type' => 'integer', 'description' => 'Page number to retrieve (1-based).'],
            'sort' => ['type' => 'string', 'description' => 'Sort field and direction (e.g., "createdAt" or "-createdAt" for descending).'],
            'filter' => ['type' => 'array', 'description' => 'JSON:API filter parameters (e.g., {"email": "user@example.com"}).'],
        ];
    }

    /**
     * Execute the tool — list prospects from Outreach.
     *
     * @param  array $args The tool arguments (page_size, page_number, sort, filter).
     * @return ToolResult The result containing prospect data or an error.
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

            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }

            if (isset($args['filter'])) {
                $params['filter'] = $args['filter'];
            }

            $result = $this->service->listProspects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
