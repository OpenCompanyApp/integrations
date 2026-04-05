<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create (add) a new subscriber to a Beehiiv publication.
 */
class BeehiivCreateSubscriber implements Tool
{
    /**
     * Create a new BeehiivCreateSubscriber tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_create_subscriber';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Add a new subscriber to your Beehiiv publication by email address.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address of the new subscriber.'],
            'reactivate_existing' => ['type' => 'boolean', 'description' => 'Whether to reactivate the subscription if the email already exists. Default: false.'],
            'utm_source' => ['type' => 'string', 'description' => 'UTM source to attribute the subscription to.'],
            'utm_medium' => ['type' => 'string', 'description' => 'UTM medium to attribute the subscription to.'],
            'utm_campaign' => ['type' => 'string', 'description' => 'UTM campaign to attribute the subscription to.'],
            'referring_pub' => ['type' => 'string', 'description' => 'Referring publication ID.'],
        ];
    }

    /**
     * Execute the tool — create a subscriber in Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $data = [
                'email' => $args['email'],
            ];

            if (isset($args['reactivate_existing'])) {
                $data['reactivate_existing'] = (bool) $args['reactivate_existing'];
            }
            if (isset($args['utm_source'])) {
                $data['utm_source'] = $args['utm_source'];
            }
            if (isset($args['utm_medium'])) {
                $data['utm_medium'] = $args['utm_medium'];
            }
            if (isset($args['utm_campaign'])) {
                $data['utm_campaign'] = $args['utm_campaign'];
            }
            if (isset($args['referring_pub'])) {
                $data['referring_pub'] = $args['referring_pub'];
            }

            $result = $this->service->createSubscriber($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
