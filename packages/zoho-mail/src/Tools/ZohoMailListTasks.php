<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\Integrations\ZohoMail\ZohoMailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list tasks from a Zoho Mail account.
 *
 * Zoho Mail includes a built-in task management feature. This tool
 * retrieves tasks with optional pagination support.
 *
 * @see https://www.zoho.com/mail/help/api/gettasks.html
 */
class ZohoMailListTasks implements Tool
{
    /**
     * Create a new ZohoMailListTasks tool instance.
     *
     * @param ZohoMailService $service The Zoho Mail service for API communication
     */
    public function __construct(
        private ZohoMailService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'zohomail_list_tasks';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List tasks from Zoho Mail. Returns task details including title, status, due date, and priority.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'The Zoho Mail account ID.'],
            'start' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return (default: 20).'],
        ];
    }

    /**
     * Execute the list tasks tool.
     *
     * @param array<string, mixed> $args Tool arguments
     *
     * @return ToolResult The result containing task list or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Mail integration is not configured.');
            }

            $accountId = $args['accountId'] ?? '';
            if (empty($accountId)) {
                return ToolResult::error('accountId is required.');
            }

            $params = [];
            if (isset($args['start'])) {
                $params['start'] = (int) $args['start'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listTasks($accountId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
