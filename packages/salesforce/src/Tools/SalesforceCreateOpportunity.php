<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new opportunity in Salesforce.
 *
 * Supports standard opportunity fields including name, amount, stage, close date, account, and probability.
 */
class SalesforceCreateOpportunity implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_create_opportunity';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new opportunity in Salesforce.
        Supports Name, Amount, StageName, CloseDate, AccountId, and Probability.
        Returns the created opportunity ID and success status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Opportunity name.'],
            'amount' => ['type' => 'number', 'description' => 'Opportunity amount (numeric).'],
            'stage_name' => ['type' => 'string', 'required' => true, 'description' => 'Sales stage (e.g. Prospecting, Qualification, Closed Won).'],
            'close_date' => ['type' => 'string', 'required' => true, 'description' => 'Expected close date (YYYY-MM-DD).'],
            'account_id' => ['type' => 'string', 'description' => 'Salesforce Account ID to associate the opportunity with.'],
            'probability' => ['type' => 'number', 'description' => 'Win probability as a percentage (0-100).'],
        ];
    }

    /**
     * Create a new Salesforce opportunity with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, amount, stage_name, close_date, account_id, probability)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $fields = [];

            if (! empty($args['name'])) {
                $fields['Name'] = $args['name'];
            }
            if (isset($args['amount'])) {
                $fields['Amount'] = $args['amount'];
            }
            if (! empty($args['stage_name'])) {
                $fields['StageName'] = $args['stage_name'];
            }
            if (! empty($args['close_date'])) {
                $fields['CloseDate'] = $args['close_date'];
            }
            if (! empty($args['account_id'])) {
                $fields['AccountId'] = $args['account_id'];
            }
            if (isset($args['probability'])) {
                $fields['Probability'] = $args['probability'];
            }

            if (empty($fields['Name'])) {
                return ToolResult::error('name is required.');
            }
            if (empty($fields['StageName'])) {
                return ToolResult::error('stage_name is required.');
            }
            if (empty($fields['CloseDate'])) {
                return ToolResult::error('close_date is required.');
            }

            $result = $this->service->createOpportunity($fields);

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
