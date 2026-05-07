<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * Returns the Json Web Key Set (public keys) of an app.
 */
class CanvaGetAppJWKS extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_get_app_jwks';
}
