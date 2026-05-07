<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * This endpoint implements the OAuth 2.0 token endpoint, as part of the Authorization Code flow with Proof Key for Code Exchange (PKCE).
 */
class CanvaExchangeAccessToken extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_exchange_access_token';
}
