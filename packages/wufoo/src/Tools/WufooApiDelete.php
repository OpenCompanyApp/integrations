<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Call a documented Wufoo API v3 DELETE endpoint.
 */
class WufooApiDelete extends AbstractWufooTool
{
    public const NAME = 'wufoo_api_delete';
    public const DESCRIPTION = 'Call a documented Wufoo API v3 DELETE endpoint relative to /api/v3.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /forms/{id}/webhooks/{webhook_id}.json.'],
        'params' => ['type' => 'object', 'description' => 'Optional request parameters.'],
    ];

    /**
     * Call a DELETE endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiDelete(
            $this->requiredString($args, 'path', 'path'),
            $this->arrayArg($args, 'params'),
        );
    }
}
