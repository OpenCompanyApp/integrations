<?php

namespace OpenCompany\Integrations\Outreach\Tools;

use OpenCompany\Integrations\Outreach\OutreachService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OutreachCreateProspect implements Tool
{
    /**
     * Create a new OutreachCreateProspect tool instance.
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
        return 'outreach_create_prospect';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new prospect in Outreach. Provide first name, last name, emails, and optional company to add a contact to your prospect database.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name.
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'The prospect\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'The prospect\'s last name.'],
            'emails' => ['type' => 'array', 'description' => 'Array of email addresses for the prospect (e.g., ["user@example.com"]).'],
            'company' => ['type' => 'string', 'description' => 'The prospect\'s company name.'],
        ];
    }

    /**
     * Execute the tool — create a prospect in Outreach.
     *
     * @param  array $args The tool arguments (first_name, last_name, emails, company).
     * @return ToolResult The result containing the created prospect data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Outreach integration is not configured.');
            }

            $data = [];

            if (isset($args['first_name'])) {
                $data['firstName'] = $args['first_name'];
            }

            if (isset($args['last_name'])) {
                $data['lastName'] = $args['last_name'];
            }

            if (isset($args['emails']) && is_array($args['emails'])) {
                $data['emails'] = $args['emails'];
            }

            if (isset($args['company'])) {
                $data['company'] = $args['company'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one prospect attribute is required.');
            }

            $result = $this->service->createProspect($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
