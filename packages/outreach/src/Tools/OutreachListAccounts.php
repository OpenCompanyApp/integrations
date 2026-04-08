<?php

namespace OpenCompany\Integrations\Outreach\Tools;

use OpenCompany\Integrations\Outreach\OutreachService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OutreachListAccounts implements Tool
{
    /**
     * Create a new OutreachListAccounts tool instance.
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
        return 'outreach_list_accounts';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List accounts (organizations) in Outreach with optional pagination. Returns account details including name, domain, and company information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name.
     */
    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of accounts to return per page (default: 25, max: 100).'],
            'page_number' => ['type' => 'integer', 'description' => 'Page number to retrieve (1-based).'],
        ];
    }

    /**
     * Execute the tool — list accounts from Outreach.
     *
     * @param  array $args The tool arguments (page_size, page_number).
     * @return ToolResult The result containing account data or an error.
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

            $result = $this->service->listAccounts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
