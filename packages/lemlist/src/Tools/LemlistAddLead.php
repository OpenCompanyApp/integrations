<?php

namespace OpenCompany\Integrations\Lemlist\Tools;

use OpenCompany\Integrations\Lemlist\LemlistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Add a lead to a Lemlist campaign.
 *
 * Creates a new lead and adds them to the specified campaign. Requires at minimum
 * an email address. Additional fields like firstName, lastName, companyName, and
 * custom variables can be provided.
 */
class LemlistAddLead implements Tool
{
    public function __construct(
        private LemlistService $service,
    ) {}

    public function name(): string
    {
        return 'lemlist_add_lead';
    }

    public function description(): string
    {
        return 'Add a lead to a Lemlist campaign. The lead will be queued for outreach according to the campaign schedule.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the campaign to add the lead to.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The lead\'s email address.'],
            'firstName' => ['type' => 'string', 'description' => 'The lead\'s first name.'],
            'lastName' => ['type' => 'string', 'description' => 'The lead\'s last name.'],
            'companyName' => ['type' => 'string', 'description' => 'The lead\'s company name.'],
            'phone' => ['type' => 'string', 'description' => 'The lead\'s phone number.'],
            'linkedinUrl' => ['type' => 'string', 'description' => 'The lead\'s LinkedIn profile URL.'],
            'variables' => ['type' => 'object', 'description' => 'Custom variables to use in campaign templates (key-value pairs).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemlist integration is not configured.');
            }

            if (empty($args['campaign_id'])) {
                return ToolResult::error('campaign_id is required.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            $leadData = ['email' => $args['email']];

            $optionalFields = ['firstName', 'lastName', 'companyName', 'phone', 'linkedinUrl'];
            foreach ($optionalFields as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $leadData[$field] = $args[$field];
                }
            }

            if (isset($args['variables']) && is_array($args['variables'])) {
                $leadData['variables'] = $args['variables'];
            }

            $result = $this->service->addLead($args['campaign_id'], $leadData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
