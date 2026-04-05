<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new case in Salesforce.
 *
 * Supports standard case fields including subject, description, status, priority, origin, and associations.
 */
class SalesforceCreateCase implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_create_case';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new case in Salesforce.
        Supports Subject, Description, Status, Priority, Origin, ContactId, and AccountId.
        Returns the created case ID and success status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Case subject/title.'],
            'description' => ['type' => 'string', 'description' => 'Case description or details.'],
            'status' => ['type' => 'string', 'description' => 'Case status (e.g. New, Working, Escalated, Closed).'],
            'priority' => ['type' => 'string', 'description' => 'Case priority (e.g. Low, Medium, High, Critical).'],
            'origin' => ['type' => 'string', 'description' => 'Case origin (e.g. Web, Email, Phone).'],
            'contact_id' => ['type' => 'string', 'description' => 'ID of the related Contact.'],
            'account_id' => ['type' => 'string', 'description' => 'ID of the related Account.'],
        ];
    }

    /**
     * Create a new Salesforce case with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (subject, description, status, priority, origin, contact_id, account_id)
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
            if (! empty($args['origin'])) {
                $fields['Origin'] = $args['origin'];
            }
            if (! empty($args['contact_id'])) {
                $fields['ContactId'] = $args['contact_id'];
            }
            if (! empty($args['account_id'])) {
                $fields['AccountId'] = $args['account_id'];
            }

            if (empty($fields['Subject'])) {
                return ToolResult::error('subject is required.');
            }

            $result = $this->service->createCase($fields);

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
