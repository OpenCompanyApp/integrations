<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Social Media Delete Post tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutSocialMediaDeletePost extends AbstractVboutOperationTool
{
    protected const OPERATION = 'social_media_delete_post';
}