<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new task in Salesforce.
 *
 * Supports standard task fields including subject, description, status, priority, and associations.
 */
class SalesforceCreateTask implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_create_task';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new task in Salesforce.
        Supports Subject, Description, Status, Priority, WhoId (contact/lead), WhatId (account/opportunity), and ActivityDate.
        Returns the created task ID and success status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Task subject/title.'],
            'description' => ['type' => 'string', 'description' => 'Task description or body.'],
            'status' => ['type' => 'string', 'description' => 'Task status (e.g. Not Started, In Progress, Completed).'],
            'priority' => ['type' => 'string', 'description' => 'Task priority (e.g. Normal, High, Low).'],
            'who_id' => ['type' => 'string', 'description' => 'ID of the related Contact or Lead.'],
            'what_id' => ['type' => 'string', 'description' => 'ID of the related Account, Opportunity, or other object.'],
            'activity_date' => ['type' => 'string', 'description' => 'Due date for the task (YYYY-MM-DD).'],
        ];
    }

    /**
     * Create a new Salesforce task with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (subject, description, status, priority, who_id, what_id, activity_date)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $fields = [];

            if (! empty($args['subject'])) {
                $fields['Subject'] = $args['subject'];
            }
            if (! empty($args['description'])) {
                $fields['Description'] = $args['description'];
            }
            if (! empty($args['status'])) {
                $fields['Status'] = $args['status'];
            }
            if (! empty($args['priority'])) {
                $fields['Priority'] = $args['priority'];
            }
            if (! empty($args['who_id'])) {
                $fields['WhoId'] = $args['who_id'];
            }
            if (! empty($args['what_id'])) {
                $fields['WhatId'] = $args['what_id'];
            }
            if (! empty($args['activity_date'])) {
                $fields['ActivityDate'] = $args['activity_date'];
            }

            if (empty($fields['Subject'])) {
                return ToolResult::error('subject is required.');
            }

            $result = $this->service->createTask($fields);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'success' => $result['success'] ?? true,
                'errors' => $result['errors'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
