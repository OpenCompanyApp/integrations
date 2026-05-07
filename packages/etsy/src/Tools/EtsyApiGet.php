<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Call a documented Etsy Open API GET endpoint.
 */
class EtsyApiGet extends AbstractEtsyTool
{
    public const NAME = 'etsy_api_get';
    public const DESCRIPTION = 'Call a documented Etsy Open API GET endpoint relative to /v3/application.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /seller-taxonomy/nodes.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call a GET endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiGet($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'params'));
    }
}
