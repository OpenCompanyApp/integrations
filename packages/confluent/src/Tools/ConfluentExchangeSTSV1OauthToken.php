<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Use this operation to exchange an access token JWT issued by an external identity provider for an access token JWT issued by Confluent.This enables the use of external identities to access Confluent Cloud APIs.
 */
class ConfluentExchangeSTSV1OauthToken extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_exchange_sts_v1_oauth_token';
}
