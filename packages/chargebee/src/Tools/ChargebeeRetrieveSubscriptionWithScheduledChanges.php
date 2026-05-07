<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a subscription including scheduled changes.
 */
class ChargebeeRetrieveSubscriptionWithScheduledChanges extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = ['limit', 'offset'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/subscriptions/{id}/retrieve_with_scheduled_changes';

    protected string $toolName = 'chargebee_retrieve_subscription_with_scheduled_changes';

    protected string $toolDescription = 'Retrieve a subscription including scheduled changes.';
}
