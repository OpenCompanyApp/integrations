<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Guarded raw DELETE request for relative Miniflux API paths.
 */
class MinifluxApiDelete extends AbstractMinifluxRawTool
{
    protected const NAME = 'miniflux_api_delete';
    protected const DESCRIPTION = 'Call a safe relative Miniflux API DELETE path.';
    protected const METHOD = 'apiDelete';
}
