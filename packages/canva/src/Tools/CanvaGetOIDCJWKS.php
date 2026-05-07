<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * Gets the JSON Web Key Set (public keys) for OIDC.
 */
class CanvaGetOIDCJWKS extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_get_oidc_jwks';
}
