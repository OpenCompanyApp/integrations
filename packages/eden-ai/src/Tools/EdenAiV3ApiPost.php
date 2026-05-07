<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Call an Eden AI V3 POST endpoint.
 */
class EdenAiV3ApiPost extends AbstractEdenAiTool
{
    public const NAME = 'edenai_v3_api_post';
    public const DESCRIPTION = 'Call an Eden AI V3 POST endpoint relative to /v3.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /chat/completions or /universal-ai.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a V3 POST endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->v3ApiPost($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
