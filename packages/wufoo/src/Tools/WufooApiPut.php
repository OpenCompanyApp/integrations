<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Call a documented Wufoo API v3 PUT endpoint.
 */
class WufooApiPut extends AbstractWufooTool
{
    public const NAME = 'wufoo_api_put';
    public const DESCRIPTION = 'Call a documented Wufoo API v3 PUT endpoint relative to /api/v3 with form-encoded body data.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /forms/{id}/webhooks.json.'],
        'body' => ['type' => 'object', 'description' => 'Form-encoded body fields.'],
    ];

    /**
     * Call a PUT endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPut(
            $this->requiredString($args, 'path', 'path'),
            $this->arrayArg($args, 'body'),
        );
    }
}
