<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Social Media Post tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutSocialMediaGetPost extends AbstractVboutOperationTool
{
    protected const OPERATION = 'social_media_get_post';
}