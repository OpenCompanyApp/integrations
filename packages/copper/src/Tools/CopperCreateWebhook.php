<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Create a Copper webhook subscription.
 */
class CopperCreateWebhook extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_create_webhook';

    protected string $toolDescription = 'Create a Copper webhook subscription for entity changes.';

    protected string $method = 'POST';

    protected string $path = '/webhooks';

    /** @var list<string> */
    protected array $required = ['target', 'type', 'event'];

    /** @var list<string> */
    protected array $bodyParams = ['target', 'type', 'event', 'secret'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'target' => ['type' => 'string', 'required' => true, 'description' => 'Webhook target URL.'],
        'type' => ['type' => 'string', 'required' => true, 'description' => 'Entity type such as lead, person, company, opportunity, project, or task.'],
        'event' => ['type' => 'string', 'required' => true, 'description' => 'Event name, commonly created, updated, or deleted.'],
        'secret' => ['type' => 'string', 'description' => 'Optional shared secret for webhook verification.'],
    ];
}
