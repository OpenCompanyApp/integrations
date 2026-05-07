<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Call a documented Etsy Open API POST endpoint.
 */
class EtsyApiPost extends AbstractEtsyTool
{
    public const NAME = 'etsy_api_post';
    public const DESCRIPTION = 'Call a documented Etsy Open API POST endpoint relative to /v3/application.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /shops/{shop_id}/listings.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a POST endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPost($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
