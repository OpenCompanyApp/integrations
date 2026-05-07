<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * Introspect an access token to see whether it is valid and active.
 */
class CanvaIntrospectToken extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_introspect_token';
}
