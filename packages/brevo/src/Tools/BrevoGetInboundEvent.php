<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get an inbound parsing event.
 */
class BrevoGetInboundEvent extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_inbound_event';

    protected string $toolDescription = 'Get an inbound parsing event.';

    protected string $method = 'GET';

    protected string $path = '/inbound/events/{uuid}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'uuid' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Inbound event UUID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'uuid',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
