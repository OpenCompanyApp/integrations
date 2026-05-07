<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Social Media Edit Post tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutSocialMediaEditPost extends AbstractVboutOperationTool
{
    protected const OPERATION = 'social_media_edit_post';
}