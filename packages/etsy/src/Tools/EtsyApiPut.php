<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Call a documented Etsy Open API PUT endpoint.
 */
class EtsyApiPut extends AbstractEtsyTool
{
    public const NAME = 'etsy_api_put';
    public const DESCRIPTION = 'Call a documented Etsy Open API PUT endpoint relative to /v3/application.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /listings/{listing_id}/inventory.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a PUT endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPut($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
