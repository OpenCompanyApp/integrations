<?php

namespace OpenCompany\Integrations\Zend\Tools;

use OpenCompany\Integrations\Zend\ZendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new email marketing campaign.
 */
class ZendCreateCampaign implements Tool
{
    public function __construct(
        private ZendService $service,
    ) {}

    public function name(): string
    {
        return 'zend_create_campaign';
    }

    public function description(): string
    {
        return 'Create a new email marketing campaign with subject, content, and target lists.';
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The campaign email subject line.'],
            'content' => ['type' => 'string', 'required' => false, 'description' => 'The HTML content of the campaign email.'],
            'list_ids' => ['type' => 'array', 'required' => false, 'description' => 'Array of subscriber list IDs to target.'],
            'from_name' => ['type' => 'string', 'required' => false, 'description' => 'The sender name for the campaign.'],
            'from_email' => ['type' => 'string', 'required' => false, 'description' => 'The sender email address for the campaign.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            if (empty($args['subject'])) {
                return ToolResult::error('subject is required.');
            }

            $result = $this->service->createCampaign($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
