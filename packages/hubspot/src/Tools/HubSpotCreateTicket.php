<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new ticket in HubSpot CRM.
 *
 * Supports standard ticket properties (subject, content, pipeline, pipeline stage) plus custom properties.
 */
class HubSpotCreateTicket implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_create_ticket';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new ticket in HubSpot CRM.
        Supports subject, content, hs_pipeline, hs_pipeline_stage, and any additional custom properties.
        Returns the created ticket with its HubSpot ID and properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Ticket subject / title.'],
            'content' => ['type' => 'string', 'description' => 'Ticket body content / description.'],
            'hs_pipeline' => ['type' => 'string', 'description' => 'Pipeline ID for the ticket.'],
            'hs_pipeline_stage' => ['type' => 'string', 'description' => 'Pipeline stage ID for the ticket.'],
            'properties' => ['type' => 'object', 'description' => 'Additional custom properties as key-value pairs.'],
        ];
    }

    /**
     * Create a new HubSpot ticket with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (subject, content, hs_pipeline, hs_pipeline_stage, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $subject = $args['subject'] ?? '';
            if (empty($subject)) {
                return ToolResult::error('subject is required.');
            }

            $properties = ['subject' => $subject];

            if (! empty($args['content'])) {
                $properties['content'] = $args['content'];
            }
            if (! empty($args['hs_pipeline'])) {
                $properties['hs_pipeline'] = $args['hs_pipeline'];
            }
            if (! empty($args['hs_pipeline_stage'])) {
                $properties['hs_pipeline_stage'] = $args['hs_pipeline_stage'];
            }

            if (isset($args['properties']) && is_array($args['properties'])) {
                foreach ($args['properties'] as $key => $value) {
                    $properties[$key] = $value;
                }
            }

            $result = $this->service->createTicket($properties);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'properties' => $result['properties'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
