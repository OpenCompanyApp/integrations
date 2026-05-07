<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Social Media Add Post tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutSocialMediaAddPost extends AbstractVboutOperationTool
{
    protected const OPERATION = 'social_media_add_post';
}