<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Request a Typefully media upload URL.
 *
 * The returned upload URL is used outside this tool before attaching media IDs to drafts.
 */
class TypefullyRequestMediaUpload implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_request_media_upload';
    }

    public function description(): string
    {
        return 'Request a presigned Typefully media upload URL for a social set.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'file_name' => ['type' => 'string', 'required' => true, 'description' => 'File name to upload.'],
            'file_type' => ['type' => 'string', 'description' => 'Optional MIME type if required by Typefully.'],
            'file_size' => ['type' => 'integer', 'description' => 'Optional file size in bytes if required by Typefully.'],
        ];
    }

    /**
     * Request a media upload URL.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $socialSetId = $args['social_set_id'] ?? '';
            unset($args['social_set_id']);

            return ToolResult::success($this->service->requestMediaUpload($socialSetId, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
