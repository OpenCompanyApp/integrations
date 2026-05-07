<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Guarded raw POST request for relative Miniflux API paths.
 */
class MinifluxApiPost extends AbstractMinifluxRawTool
{
    protected const NAME = 'miniflux_api_post';
    protected const DESCRIPTION = 'Call a safe relative Miniflux API POST path.';
    protected const METHOD = 'apiPost';
}
