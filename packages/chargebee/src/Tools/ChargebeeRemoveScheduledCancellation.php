<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Remove a scheduled subscription cancellation.
 */
class ChargebeeRemoveScheduledCancellation extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'POST';

    protected string $path = '/subscriptions/{id}/remove_scheduled_cancellation';

    protected string $toolName = 'chargebee_remove_scheduled_cancellation';

    protected string $toolDescription = 'Remove a scheduled subscription cancellation.';
}
