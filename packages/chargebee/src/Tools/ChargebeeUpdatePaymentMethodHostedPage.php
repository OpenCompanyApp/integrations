<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Create a hosted page for updating payment method.
 */
class ChargebeeUpdatePaymentMethodHostedPage extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/hosted_pages/update_payment_method';

    protected string $toolName = 'chargebee_update_payment_method_hosted_page';

    protected string $toolDescription = 'Create a hosted page for updating payment method.';
}
