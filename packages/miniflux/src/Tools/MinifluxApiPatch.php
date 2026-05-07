<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Guarded raw PATCH request for relative Miniflux API paths.
 */
class MinifluxApiPatch extends AbstractMinifluxRawTool
{
    protected const NAME = 'miniflux_api_patch';
    protected const DESCRIPTION = 'Call a safe relative Miniflux API PATCH path.';
    protected const METHOD = 'apiPatch';
}
