<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Call a documented Etsy Open API DELETE endpoint.
 */
class EtsyApiDelete extends AbstractEtsyTool
{
    public const NAME = 'etsy_api_delete';
    public const DESCRIPTION = 'Call a documented Etsy Open API DELETE endpoint relative to /v3/application.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /shops/{shop_id}/listings/{listing_id}.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];

    /**
     * Call a DELETE endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiDelete($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
