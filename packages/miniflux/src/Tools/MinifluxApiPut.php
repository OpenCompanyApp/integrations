<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Guarded raw PUT request for relative Miniflux API paths.
 */
class MinifluxApiPut extends AbstractMinifluxRawTool
{
    protected const NAME = 'miniflux_api_put';
    protected const DESCRIPTION = 'Call a safe relative Miniflux API PUT path.';
    protected const METHOD = 'apiPut';
}
