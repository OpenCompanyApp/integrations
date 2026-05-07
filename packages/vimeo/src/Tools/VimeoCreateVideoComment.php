<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Create a comment on a Vimeo video.
 */
class VimeoCreateVideoComment extends AbstractVimeoTool
{
    public const NAME = 'vimeo_create_video_comment';
    public const DESCRIPTION = 'Create a comment on a Vimeo video.';
    public const PARAMETERS = [
        'video_id' => ['type' => 'string', 'required' => true, 'description' => 'Vimeo video ID.'],
        'text' => ['type' => 'string', 'required' => true, 'description' => 'Comment text.'],
    ];

    /**
     * Create the comment.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createVideoComment(
            $this->requiredString($args, 'video_id'),
            $this->requiredString($args, 'text')
        );
    }
}
