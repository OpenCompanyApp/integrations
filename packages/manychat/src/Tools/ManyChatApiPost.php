<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Call a documented Manychat POST endpoint.
 */
class ManyChatApiPost extends AbstractManyChatTool
{
    public const NAME = 'manychat_api_post';
    public const DESCRIPTION = 'Call a documented Manychat POST endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /fb/subscriber/addTagByName.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call the endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPost($this->requiredString($args, 'path'), $this->arrayArg($args, 'body'));
    }
}
