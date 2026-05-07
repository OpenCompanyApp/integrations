<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Guarded raw GET request for relative Miniflux API paths.
 */
class MinifluxApiGet extends AbstractMinifluxRawTool
{
    protected const NAME = 'miniflux_api_get';
    protected const DESCRIPTION = 'Call a safe relative Miniflux API GET path.';
    protected const METHOD = 'apiGet';
}
