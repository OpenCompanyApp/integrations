<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Upload a Recruitee attachment from a remote URL.
 */
class RecruiteeUploadAttachment extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_upload_attachment';
    public const DESCRIPTION = 'Upload a remote file attachment to a Recruitee offer or candidate.';
    public const PARAMETERS = [
        'attachment' => ['type' => 'object', 'required' => true, 'description' => 'Attachment object with remote_file_url and optional candidate_id or offer_id.'],
    ];

    /**
     * Upload an attachment.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->uploadAttachment($this->requiredArray($args, 'attachment', 'attachment'));
    }
}
