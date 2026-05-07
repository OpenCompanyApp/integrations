<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Remove scheduled changes from a subscription.
 */
class ChargebeeRemoveScheduledChanges extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'POST';

    protected string $path = '/subscriptions/{id}/remove_scheduled_changes';

    protected string $toolName = 'chargebee_remove_scheduled_changes';

    protected string $toolDescription = 'Remove scheduled changes from a subscription.';
}
